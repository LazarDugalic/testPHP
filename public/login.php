<?php

use App\Core\Twig;

require_once __DIR__ . '/../vendor/autoload.php';

if (isset($_POST['login'])) {
    echo 'test';
}

Twig::render('user/login.html.twig');