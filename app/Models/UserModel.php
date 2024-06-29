<?php


class UserModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getUserByEmail($email)
    {
        $user = $this->db->query('users', ['email' => $email])->toArray();
        return $user ? $user[0] : null;
    }

    public function getUsers()
    {
        $query = "SELECT * FROM users";
        $usersStatement = $this->db->query($query, []);
        return $usersStatement->fetchAll();
    }

    public function getUser($user_id)
    {
        // Query the Users collection
        $user = $this->db->query('users', ['_id' => $user_id])->toArray();
        return $user ? $user[0] : null;
    }

    public function addUser($user_name, $email, $password)
    {
        $table = "users";

        $data = [
            'Username' => $user_name,
            'Password' => $password,
            'Email' => $email,
        ];

        return $this->db->store($table, $data);
    }

    public function destroyUser($user_id)
    {
        $table = 'users';
        $condition = 'UserID = :user_id';
        $params =  [
            'UserID' => $user_id
        ];

        return $this->db->destroy($table, $condition, $params);
    }

    public function editUser($user, $old_password, $new_password, $formData)
    {
        $errors = [];

        // Check if old password matches the current password
        if (!empty($old_password) && !password_verify($old_password, $user['password'])) {
            $errors['match'] = 'Your current password does not match with the provided password';
        }

        if (empty($errors)) {
            // Hash the new password if it's not empty
            if (!empty($new_password)) {
                $password = password_hash($new_password, PASSWORD_DEFAULT);
            }

            $data = [
                'UserName' => $formData['user_name'],
                'Email' => $formData['email'],
                'Password' => $formData['password'],
            ];

            // Include the password field in the data array only if the new password is not empty
            if (!empty($new_password)) {
                $data['password'] = $password;
            }

            $table = 'users';
            $condition = 'UserID = :UserID';
            $params = ['UserID' => $user['UserID']];

            // Update user data in the database
            return $this->db->edit($table, $data, $condition, $params);
        }

        return $errors;
    }
}
