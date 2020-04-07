<?php

namespace App\Core;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

/**
 * Class Twig
 * @package App\Core
 */
class Twig
{
    /**
     * The Render method will be used in order to render the template
     *
     * @param string $path The path of the template. For example ('default/index.html.twig')
     * @param array $params The params which will be passed to the template
     *
     * @return void
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    static function render(string $path, array $params = [])
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../templates/');
        $twig = new Environment($loader, [
            'debug' => true
        ]);
        $twig->addExtension(new DebugExtension());

        echo $twig->render($path, $params);
    }
}