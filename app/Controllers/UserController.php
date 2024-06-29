<?php

require_once base_path('app/models/UserModel.php');

class UserController
{
    private $userModel;

    public function __construct($db)
    {
        $this->userModel = new UserModel($db);
    }

    public function login()
    {
        if ($_SESSION['authenticated'] ?? false) {
            redirect('/profile');
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = $_POST['email'];
            $password = $_POST["password"];

            $user = $this->userModel->getUserByEmail($email);
            function authenticateUser($user, $email, $password)
            {
                // Check if the user exists and compare the emails
                if ($user && $user['email'] === $email) {
                    if ($password == $user['password']) {
                        $_SESSION['user_id'] = $user['_id'];
                        $_SESSION['email'] = $email;
                        return true; // Authentication successful
                    }
                }
                return false; // Authentication failed
            }

            // Authenticate the user
            if (authenticateUser($user, $email, $password)) {
                $_SESSION['authenticated'] = true;
                redirect('/profile');
                exit;
            } else {
                // Authentication failed
                echo 'Incorrect email or password.';
            }
        }
    }

    public function addUser()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $user_name = $_POST["user_name"];
            $email = $_POST["email"];
            $password = $_POST['password'];

            $result = $this->userModel->addUser($user_name, $email, $password);

            if ($result) {
                // User creation successful, redirect to login page
                $_SESSION['authenticated'] = true;
                redirect('/');
            } else {
                // User creation failed
                echo 'User creation failed';
            }
        }
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
}
