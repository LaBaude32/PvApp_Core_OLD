<?php

namespace App\Domain\Pv\Data;

final class PvCreateData
{
    /** @var string */
    public $state;

    /** @var string */
    public $meeting_date;

    /** @var string */
    public $meeting_place;

    /** @var string */
    public $meeting_next_date;

    /** @var string */
    public $meeting_next_place;

    /** @var int */
    public $affair_id;

    /** @var int */
    public $release_date;
}
