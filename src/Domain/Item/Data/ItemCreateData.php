<?php

namespace App\Domain\Item\Data;

use DateTime;

final class ItemCreateData
{
    /** @var int */
    public $position;

    /** @var string */
    public $note;

    /** @var string */
    public $suite_a_donner;

    /** @var string */
    public $ressources;

    /** @var string */
    public $echeance;

    /** @var string */
    public $date_echeance;

    /** @var bool */
    public $visible;

    /** @var string */ //TODO: vraiment ça ?
    public $created_at;
}
