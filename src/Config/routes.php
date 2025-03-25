<?php

use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) {
    // Page d'accueil
    $app->get('/', function (Request $request, Response $response) {
        $view = $this->get('view');
        return $view->render($response, 'index.html.twig');
    });

    // Groupe de routes pour l'API
    $app->group('/api', function (RouteCollectorProxy $group) {
        // Routes pour les annonces
        $group->group('/annonces', function (RouteCollectorProxy $group) {
            $group->get('', 'App\Controller\AnnonceController:index');
            $group->get('/{id:[0-9]+}', 'App\Controller\AnnonceController:show');
            $group->post('', 'App\Controller\AnnonceController:create');
            $group->put('/{id:[0-9]+}', 'App\Controller\AnnonceController:update');
            $group->delete('/{id:[0-9]+}', 'App\Controller\AnnonceController:delete');
        });

        // Routes pour les catégories
        $group->group('/categories', function (RouteCollectorProxy $group) {
            $group->get('', 'App\Controller\CategorieController:index');
            $group->get('/{id:[0-9]+}', 'App\Controller\CategorieController:show');
        });

        // Routes pour les régions
        $group->group('/regions', function (RouteCollectorProxy $group) {
            $group->get('', 'App\Controller\RegionController:index');
            $group->get('/{id:[0-9]+}/departements', 'App\Controller\RegionController:getDepartements');
        });
    });
};
