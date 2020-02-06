<?php

namespace App\Domain\Item\Data;

final class ItemCreateData
{
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

    /** @var int */
    public $created_at;
}
