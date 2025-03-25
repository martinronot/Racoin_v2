<?php

use Slim\App;
use Slim\Views\TwigMiddleware;

return function (App $app) {
    // Ajout du middleware Twig
    $app->add(TwigMiddleware::createFromContainer($app));

    // Middleware CORS
    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });

    // Middleware pour les erreurs 404
    $app->addRoutingMiddleware();
};
