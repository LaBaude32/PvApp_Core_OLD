<?php

namespace App\Domain\Pv\Data;

final class PvGetData
{
    /** @var int */
    public $id_pv;

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
    public $affair_id;
}
