<?php

require_once base_path('app/models/UserModel.php');

class UserController
{
    private $userModel;

    // user credentials
    private $password;
    private $email;
    private $user_name;
    // validation errors
    private $errors;

    public function __construct($db)
    {
        $this->userModel = new UserModel($db);
    }

    public function signin()
    {
        $users = $this->userModel->getUsers();

        function authenticateUser($users, $email, $password)
        {
            foreach ($users as $user) {
                // compare the emails and passwords
                if ($user['Email'] === $email) {
                    if ($password === $user['Password']) {
                        $_SESSION['user_id'] = $user['UserID'];
                        $_SESSION['email'] = $email;
                        return true; // Authentication successful
                    }
                }
            }
            dd('authentication failed.');
        }

        // do not permit the user who is authenticated to access the login in page
        if ($_SESSION['authenticated'] ?? false) {
            redirect('/profile');
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // preserve form data
            $email = $_POST['email'];
            $password = $_POST["password"];

            if (authenticateUser($users, $email, $password)) {
                $_SESSION['authenticated'] = true;
                redirect('/profile');
            } else {
                dd('incorrect email or password.');
            }
        }
    }

    public function addUser()
    {
        $password = '';
        $email = '';
        $user_name = '';
        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (isset($_POST['add_user'])) {

                $user_name = $_POST["user_name"];
                $email = $_POST["email"];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                // Validate form data
                if (empty($user_name) || empty($email) || empty($password)) {
                    $errors['general'] = "All fields are required.";
                } else {
                    // Attempt to create a new user
                    try {
                        $result = $this->userModel->addUser($user_name, $email, $password);
                        if ($result) {
                            // User creation successful, redirect to sign-in page
                            redirect('/signin');
                        } else {
                            // User creation failed
                            $errors['general'] = "Failed to create account.";
                        }
                    } catch (PDOException $e) {
                        // Handle database errors
                        if ($e->errorInfo[1] == 1062) {
                            $errors['email'] = "Email already exists. Please choose a different email.";
                        } else {
                            $errors['general'] = "Database error: " . $e->getMessage();
                        }
                    }
                }
            }
        }
        // set variables
        $this->password = $password;
        $this->email = $email;
        $this->user_name = $user_name;
        $this->errors = $errors;
    }

    public function editUser($user_id)
    {
        // get the particular user
        $user = $this->userModel->getUser($user_id);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $old_password = $_POST['old_password'];
            $new_password = $_POST['new_password'];

            // Call the UserModel method to handle user data update
            $this->userModel->editUser($user, $old_password, $new_password, $_POST);

            // Redirect to profile page
            redirect('/profile');
        }
    }

    public function removeUser($user_id)
    {
        if (isset($_POST['_method'])) {

            $result =  $this->userModel->destroyUser($user_id);

            if ($result) {
                // after deleting the user, redirect to home page and destroy the session
                session_unset();
                session_destroy();
                redirect("/");
            } else {
                dd('error');
            }
        }
    }

    // getter for variables
    public function getVariables()
    {
        return [
            'password' => $this->password,
            'email' => $this->email,
            'user_name' => $this->user_name,
            'errors' => $this->errors
        ];
    }
}
