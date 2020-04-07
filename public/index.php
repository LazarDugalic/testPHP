<?php

session_start();

use App\Core\Twig;

require_once __DIR__ . '/../vendor/autoload.php';

if (isset($_POST['logout'])) {
    session_destroy();
}

Twig::render('default/index.html.twig', [
    'session_logged' => $_SESSION['logged'] ? $_SESSION : null
]);