<?php

namespace App\Action;

use App\Domain\Item\Service\ItemCreator;
use App\Domain\Item\Service\ItemGetter;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use App\Domain\Pv\Data\PvCreateData;
use App\Domain\Pv\Service\PvCreator;
use App\Domain\Pv\Service\PvGetter;
use App\Domain\PvHasUser\Data\PvHasUserData;
use App\Domain\PvHasUser\Service\PvHasUserCreator;
use App\Domain\PvHasUser\Service\PvHasUserGetter;

final class PvCreateAction
{
    private $pvCreator;
    protected $pvHasUserCreator;
    protected $itemCreator;
    protected $pvGetter;
    protected $itemGetter;

    protected $pvHasUserGetter;

    public function __construct(PvCreator $pvCreator, PvHasUserCreator $pvHasUserCreator, ItemCreator $itemCreator, PvGetter $pvGetter, ItemGetter $itemGetter, PvHasUserGetter $pvHasUserGetter)
    {
        $this->pvCreator = $pvCreator;
        $this->pvHasUserCreator = $pvHasUserCreator;
        $this->itemCreator = $itemCreator;
        $this->pvGetter = $pvGetter;
        $this->itemGetter = $itemGetter;
        $this->pvHasUserGetter = $pvHasUserGetter;
    }

    public function __invoke(ServerRequest $request, Response $response): Response
    {
        // Collect input from the HTTP request
        $data = (array) $request->getParsedBody();

        // Mapping (should be done in a mapper class)
        $pv = new PvCreateData();
        $pv->state = $data['state'];
        $pv->meeting_date = htmlspecialchars($data['meeting_date']);
        $pv->meeting_place = htmlspecialchars($data['meeting_place']);
        if (!empty($data['meeting_next_date'])) {
            $pv->meeting_next_date = (string) htmlspecialchars($data['meeting_next_date']);
        }
        $pv->meeting_next_place = htmlspecialchars($data['meeting_next_place']);
        $pv->affair_id = htmlspecialchars($data['affair_id']);

        // Invoke the Domain with inputs and retain the result
        $pvId = $this->pvCreator->createPv($pv);

        $pv = $this->pvGetter->getPvById($pvId);
        $pv = $this->pvGetter->getPvNumber($pv);

        if ($pv->pv_number > 1) {
            //Recuperer l'ancien pv
            $pvs = $this->pvGetter->getPvByAffairId($pv->affair_id);
            foreach ($pvs as $value) {
                if ($value->pv_number == $pv->pv_number - 1) {
                    $previousPv = $value;
                }
            }

            //Récuperer tous les pHI du $previousPv 
            $allPHI = $this->itemGetter->getPvHasItem($previousPv);

            if (!empty($allPHI)) {
                //On met l'id du nouveau pv
                foreach ($allPHI as $pHI) {
                    $pHI->pvId = $pv->id_pv;
                }

                //Créer les nouveaux pHI
                $this->itemCreator->addItemsToNewPv($allPHI);
            }

            //Récuperer tous les pHU
            $allPHU = $this->pvHasUserGetter->getPvHasUsers($previousPv);

            //Les ajouter dans le nouveau PV
            foreach ($allPHU as $pHU) {
                $pHU->pv_id = $pv->id_pv;
            }

            //Créer les nouveaux pHI
            $this->pvHasUserCreator->addUsersToNewPv($allPHU);
        } else {
            //Si c'est le premier pv
            $pHU = new PvHasUserData();
            $pHU->pv_id = $pvId;
            $pHU->user_id = (int) htmlspecialchars($data['user_id']);
            $pHU->status_PAE = "Présent";
            $pHU->invited_current_meeting = 1;
            $pHU->invited_next_meeting = 1;
            $pHU->distribution = 1;
            $pHU->owner = 1;

            $this->pvHasUserCreator->createPvHasUser($pHU);
        }

        // Transform the result into the JSON representation
        $result = [
            'pv' => $pv
        ];

        // Build the HTTP response
        return $response->withJson($result)->withStatus(201);
    }
}
