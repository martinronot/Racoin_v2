<?php

namespace App\Controller;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;
use Monolog\Logger;

abstract class AbstractController
{
    protected ContainerInterface $container;
    protected Twig $view;
    protected Logger $logger;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->view = $container->get(Twig::class);
        $this->logger = $container->get(Logger::class);
    }

    protected function render(Response $response, string $template, array $data = []): Response
    {
        return $this->view->render($response, $template, $data);
    }

    protected function json(Response $response, mixed $data, int $status = 200): Response
    {
        $response->getBody()->write(json_encode($data));
        
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($status);
    }
}
