<?php

namespace App\Domain\Affair\Data;

final class AffairCreateData
{
    /** @var string */
    public $name;

    /** @var string */
    public $address;

    /** @var int */
    public $progress;

    /** @var string */
    public $meeting_type;
}
