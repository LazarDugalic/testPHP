<?php

use App\Core\Twig;
use App\Entity\User;
use App\Repository\UserRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$email = isset($_POST['email']) ? : null;
$name = isset($_POST['name']) ? : null;
$password = isset($_POST['password']) ? : null;
$passwordRepeat = isset($_POST['repeat-password']) ? : null;

$message = '';

if (isset($_POST['register'])) {
    if ($email && $name && $password && $passwordRepeat) {
        if ($password === $passwordRepeat) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if ( strlen($password) > 6 ) {
                    (new UserRepository())->createNewUser($email, $name, $password);

                    Twig::render('user/login.html.twig');
                } else {
                    $message = 'Email must have more than 5 characters !';
                }
            } else {
                $message = 'Invalid email format !';
            }
        } else {
            $message = 'Password do not match !';
        }
    } else {
        $message = 'All fields must be filled in !';
    }
}

Twig::render('user/registration.html.twig', [
    'message' => $message
]);