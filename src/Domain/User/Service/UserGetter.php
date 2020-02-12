<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UserGetterRepository;

/**
 * Service.
 */
final class UserGetter
{
    /**
     * @var UserGetterRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UserGetterRepository $repository The repository
     */
    public function __construct(UserGetterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all the users.
     *
     * @return array All the users
     */
    public function getUsers(): array
    {

        // Get All Users
        $users = $this->repository->getAllUsers();

        return (array) $users;
    }

    public function getUsersByPvId(int $pv_id): array
    {
        $users = $this->repository->getUsersByPvId($pv_id);

        return (array) $users;
    }
}
