<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

// Initialisation du conteneur
$container = require __DIR__ . '/../src/Config/container.php';
$app = $container->get(Slim\App::class);

// Configuration des middlewares
(require __DIR__ . '/../src/Config/middleware.php')($app);

// Configuration des routes
(require __DIR__ . '/../src/Config/routes.php')($app);

// Démarrage de l'application
$app->run();
