<?php

namespace App\Domain\User\Service;

use UnexpectedValueException;
use App\Domain\User\Repository\UserDeletorRepository;

/**
 * Service.
 */
final class UserDeletor
{
    /**
     * @var UserDeletorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param UserDeletorRepository $repository The repository
     */
    public function __construct(UserDeletorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function deleteUser(int $userId)
    {
        // Validation
        if (empty($userId)) {
            throw new UnexpectedValueException('Id required');
        }

        // delete User
        $this->repository->deleteUser($userId);

        // Logging here: User created successfully
    }
}
