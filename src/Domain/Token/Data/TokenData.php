<?php

namespace App\Domain\Token\Data;

final class TokenData
{
    /** @var string */
    public $token;

    /** @var string */
    public $device;

    /** @var string */
    public $expirationDate;

    /** @var int */
    public $userId;
}
