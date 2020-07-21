<?php

namespace App\Domain\User\Service;

use UnexpectedValueException;
use App\Domain\User\Data\UserGetData;
use App\Domain\User\Data\UserCreateData;
use App\Domain\User\Repository\UserUpdaterRepository;

/**
 * Service.
 */
final class UserUpdater
{
    /**
     * @var UserUpdaterRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UserUpdaterRepository $repository The repository
     */
    public function __construct(UserUpdaterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Update an user.
     *
     * @param UserGetData $user The user data
     */
    public function updateUser(UserGetData $user)
    {
        // Validation
        if (empty($user->id_user)) {
            throw new UnexpectedValueException('id user required');
        }

        // Update user
        $this->repository->updateUser($user);
    }

    public function updateParticipant(UserGetData $user)
    {
        // Validation
        if (empty($user->id_user)) {
            throw new UnexpectedValueException('id user required');
        }

        // Update user
        $this->repository->updateParticipant($user);
    }
}
