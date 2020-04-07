<?php

use App\Core\Twig;
use App\Repository\UserRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$email = isset($_POST['email']) ? $_POST['email'] : null;
$name = isset($_POST['name']) ? $_POST['name'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$passwordRepeat = isset($_POST['repeat-password']) ? $_POST['repeat-password'] : null;

if (isset($_POST['register'])) {

    if (empty($email) && empty($name) && empty($password) && empty($passwordRepeat)) {
        $message = 'All fields must be filled in !';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        isset($message) ? : $message = 'Invalid email format !';
    }

    $userAlreadyExists = (new UserRepository())->userExists($email);
    if ($userAlreadyExists) {
        isset($message) ? : $message = 'User with the same email already exists !';
    }

    if ($password !== $passwordRepeat) {
        isset($message) ? : $message = 'Password do not match !';
    }

    if ( strlen($password) < 6 ) {
        isset($message) ? : $message = 'Password must have al least 6 characters !';
    }

    if (!isset($message)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        (new UserRepository())->createNewUser($email, $name, $hashedPassword);
        header('location: index.php');
    }

}

Twig::render('user/registration.html.twig', [
    'message' => $message
]);
