<?php

namespace App\Domain\Item\Data;

final class ItemGetData
{
    /** @var int */
    public $id_item;

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

    /** @var int */
    public $created_at;
}
