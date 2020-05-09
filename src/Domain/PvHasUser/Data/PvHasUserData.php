<?php

namespace App\Domain\PvHasUser\Data;

final class PvHasUserData
{
    /** @var int */
    public $pv_id;

    /** @var int */
    public $user_id;

    /** @var string */
    public $status_PAE;

    /** @var string */
    public $invited_current_meeting;

    /** @var string */
    public $invited_next_meeting;

    /** @var string */
    public $distribution;

    /** @var int */
    public $owner;
}
