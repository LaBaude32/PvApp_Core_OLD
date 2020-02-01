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
    public $telephone;

    /** @var string */
    public $groupe;

    /** @var string */
    public $fonction;

    /** @var string */
    public $organisme;
}
