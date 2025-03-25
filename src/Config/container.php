<?php

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

return function (): ContainerInterface {
    $containerBuilder = new ContainerBuilder();

    // Ajout des définitions au conteneur
    $containerBuilder->addDefinitions([
        // Configuration de Twig
        Twig::class => function (ContainerInterface $container) {
            return Twig::create(__DIR__ . '/../../template', [
                'cache' => __DIR__ . '/../../var/cache/twig',
                'auto_reload' => true,
                'debug' => true
            ]);
        },

        // Configuration de Logger
        Logger::class => function (ContainerInterface $container) {
            $logger = new Logger('app');
            $logger->pushHandler(new StreamHandler(__DIR__ . '/../../var/log/app.log'));
            return $logger;
        },

        // Configuration de l'application Slim
        App::class => function (ContainerInterface $container) {
            AppFactory::setContainer($container);
            $app = AppFactory::create();
            
            // Configuration du middleware de parsing du corps de la requête
            $app->addBodyParsingMiddleware();
            
            // Configuration du middleware d'erreurs
            $errorMiddleware = $app->addErrorMiddleware(true, true, true);
            
            return $app;
        },
    ]);

    return $containerBuilder->build();
};
