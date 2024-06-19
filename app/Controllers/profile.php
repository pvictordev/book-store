<?php

require_once base_path('app/Models/UserModel.php');

$userModel = new UserModel($db);

// get the logged user
$user_id = $_SESSION['user_id'];

// user data
$user = $userModel->getUser($user_id);

require base_path("app/views/profile.view.php");
