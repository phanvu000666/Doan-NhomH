<?php
require_once 'Auth.php';

class FactoryPattern{
    public function make($model){
        if($model == 'auth'){
        return Auths::getInstance();
        } else {
            return null;
        }
    }
}
// if user clicks on the forgot password button
if (isset($_POST['quenmatkhau'])){
    $email = $_POST['email'];

if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email'] = "Email address is invalid";
}
if(empty($email)){
    $errors['email'] = "Email required";
}
if(count($errors) == 0){
    $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_fetch_assoc($result);
    $token = $user['token'];
    sendPasswordResetLink($email, $token);
    header('location: password_messege.php');
    exit(0);
}

}