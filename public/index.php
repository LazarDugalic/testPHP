<?php

session_start();

use App\Core\Twig;
use App\Repository\UserRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$message = '';
$users = [];

if (isset($_POST['logout'])) {
    unset($_SESSION['logged']);
}

if (isset($_GET['search'])) {
    if (isset($_SESSION['logged'])) {
        $users = (new UserRepository())->findByParameter($_GET['searchParameter']);
    } else {
        $message = 'Please login';
    }
}


Twig::render('default/index.html.twig', [
    'session_logged' => $_SESSION['logged'] ? $_SESSION : null,
    'users' => $users,
    'message' => $message
]);
