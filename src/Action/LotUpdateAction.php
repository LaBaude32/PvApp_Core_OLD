<?php

namespace App\Action;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use UnexpectedValueException;
use App\Domain\Lot\Data\LotGetData;
use App\Domain\Lot\Service\LotGetter;
use App\Domain\Lot\Service\LotUpdater;

final class LotUpdateAction
{
    private $lotUpdater;

    protected $lotGetter;

    public function __construct(LotUpdater $lotUpdater, LotGetter $lotGetter)
    {
        $this->lotUpdater = $lotUpdater;
        $this->lotGetter = $lotGetter;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // Mapping (should be done in a mapper class)
        $lot = new LotGetData();
        $lot->id_lot = htmlspecialchars($data['id_lot']);
        $lot->name = htmlspecialchars($data['name']);
        //$lot->affair_id = $data['affair_id'];

        // Invoke the Domain with inputs and retain the result
        $this->lotUpdater->updateLot($lot);

        $newLot = $this->lotGetter->getLotById($lot->id_lot);

        foreach ($newLot as $key => $value) {
            if ($lot->$key !== $value && $key != "affair_id") {
                throw new UnexpectedValueException('Erreur sur le ' . $key . ' qui est différent');
            }
        }

        // Transform the result into the JSON representation
        $result = [
            'lot_id' => $newLot->id_lot
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}
