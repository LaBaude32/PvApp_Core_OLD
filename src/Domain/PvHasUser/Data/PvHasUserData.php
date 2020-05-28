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

    /** @var bool */
    public $invited_current_meeting;

    /** @var bool */
    public $invited_next_meeting;

    /** @var bool */
    public $distribution;

    /** @var bool */
    public $owner;
}
