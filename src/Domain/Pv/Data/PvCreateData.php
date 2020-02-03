<?php

namespace App\Domain\Pv\Data;

final class PvCreateData
{
    /** @var string */
    public $etat;

    /** @var string */
    public $date_reunion;

    /** @var string */
    public $lieu_reunion;

    /** @var string */
    public $date_prochaine_reunion;

    /** @var string */
    public $lieu_prochaine_reunion;

    /** @var int */
    public $affaire_id;
}
