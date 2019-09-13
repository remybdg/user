<?php


include 'vendor/autoload.php';
use App\Model\UserModel;

var_dump($_POST);

if (!empty($_POST)) {
    $newUser = new UserModel();

    $newUser-> addUser($_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['password']);
}
	
include 'create_user.phtml';