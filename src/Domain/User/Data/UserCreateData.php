<?php

namespace App\Domain\User\Data;

final class UserCreateData
{
    /** @var string */
    public $email;

    /** @var string */
    public $pwd;

    /** @var string */
    public $firstName;

    /** @var string */
    public $lastName;

    /** @var string */
    public $phone;

    /** @var string */
    public $user_group;

    /** @var string */
    public $function;

    /** @var string */
    public $organism;
}
