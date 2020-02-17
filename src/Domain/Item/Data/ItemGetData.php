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
    public $follow_up;

    /** @var string */
    public $ressources;

    /** @var string */
    public $completion;

    /** @var string */
    public $completion_date;

    /** @var bool */
    public $visible;

    /** @var string */
    public $created_at;
}
