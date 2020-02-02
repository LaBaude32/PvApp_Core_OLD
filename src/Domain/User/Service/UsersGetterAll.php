<?php

namespace App\Domain\User\Service;

use App\Domain\User\Repository\UsersGetterAllRepository;

/**
 * Service.
 */
final class UsersGetterAll
{
    /**
     * @var UsersGetterAllRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UsersGetterAllRepository $repository The repository
     */
    public function __construct(UsersGetterAllRepository $repository)
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
}
