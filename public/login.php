<?php

session_start();

use App\Core\Twig;
use App\Repository\UserRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$email = isset($_POST['email']) ? $_POST['email'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

if (isset($_POST['login'])) {
    if (empty($email) || empty($password)) {
        $message = 'Both fields must be filled in !';
    }

    $user = (new UserRepository())->findByEmail($email);
    if (empty($user) || password_verify($password, $password['password'])) {
        isset($message) ? : $message = 'Bad credentials !';
    }

    if (!isset($message)) {
        $_SESSION["logged"] = true;
        $_SESSION["id"] = $user['id'];
        $_SESSION["name"] = $user['name'];

        header("location: index.php");
    }
}

Twig::render('user/login.html.twig', [
    'message' => $message
]);
