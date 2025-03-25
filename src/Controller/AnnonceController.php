<?php

namespace App\Controller;

use App\Model\Annonce;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AnnonceController extends AbstractController
{
    public function index(Request $request, Response $response): Response
    {
        $annonces = Annonce::with(['annonceur', 'photos'])->get();
        
        if ($request->getHeaderLine('Accept') === 'application/json') {
            return $this->json($response, $annonces);
        }

        return $this->render($response, 'annonces/index.html.twig', [
            'annonces' => $annonces
        ]);
    }

    public function show(Request $request, Response $response, array $args): Response
    {
        $annonce = Annonce::with(['annonceur', 'photos'])
            ->findOrFail($args['id']);

        if ($request->getHeaderLine('Accept') === 'application/json') {
            return $this->json($response, $annonce);
        }

        return $this->render($response, 'annonces/show.html.twig', [
            'annonce' => $annonce
        ]);
    }

    public function create(Request $request, Response $response): Response
    {
        $data = $request->getParsedBody();
        
        $annonce = new Annonce($data);
        $annonce->save();

        $this->logger->info('Nouvelle annonce créée', [
            'id' => $annonce->id_annonce,
            'titre' => $annonce->titre
        ]);

        return $this->json($response, $annonce, 201);
    }

    public function update(Request $request, Response $response, array $args): Response
    {
        $annonce = Annonce::findOrFail($args['id']);
        $data = $request->getParsedBody();
        
        $annonce->fill($data);
        $annonce->save();

        $this->logger->info('Annonce mise à jour', [
            'id' => $annonce->id_annonce,
            'titre' => $annonce->titre
        ]);

        return $this->json($response, $annonce);
    }

    public function delete(Request $request, Response $response, array $args): Response
    {
        $annonce = Annonce::findOrFail($args['id']);
        $annonce->delete();

        $this->logger->info('Annonce supprimée', [
            'id' => $args['id']
        ]);

        return $response->withStatus(204);
    }
}
