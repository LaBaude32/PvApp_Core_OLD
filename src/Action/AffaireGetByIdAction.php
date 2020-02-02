<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Lot\Service\LotGetter;
use App\Domain\Affaire\Service\AffaireGetter;

final class AffaireGetByIdAction
{
    private $affaireGetter;
    protected $lotGetter;

    public function __construct(AffaireGetter $affaireGetter, LotGetter $lotGetter)
    {
        $this->affaireGetter = $affaireGetter;
        $this->lotGetter = $lotGetter;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
      // Collect input from the HTTP request
      $data = (array) $request->getParsedBody();

      $id = (int) $data['id_affaire'];
      
      // Invoke the Domain with inputs and retain the result
      $affaire = $this->affaireGetter->getAffaireById($id);
      $lots =$this->lotGetter->getLotByAffaireId($affaire->id_affaire);

      $affaireWithLots = ["Infos Affaire" => $affaire, "lots" => $lots];

      //TODO: Mettre en forme pour supprimer le tableau
      
      // Build the HTTP response
      return $response->withJson($affaireWithLots)->withStatus(201);
    }
}