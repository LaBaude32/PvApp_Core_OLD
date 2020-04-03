<?php

namespace App\Domain\User\Data;

final class UserStatusGetData
{
    /** @var int */
    public $id_user;

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
    public $userGroup;

    /** @var string */
    public $function;

    /** @var string */
    public $organism;

    /** @var string */
    public $status;
}
