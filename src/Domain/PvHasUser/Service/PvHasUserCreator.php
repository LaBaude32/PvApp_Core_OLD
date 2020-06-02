<?php

namespace App\Domain\PvHasUser\Service;

use UnexpectedValueException;
use App\Domain\PvHasUser\Data\PvHasUserData;
use App\Domain\PvHasUser\Data\PvHasUserCreateData;
use App\Domain\PvHasUser\Repository\PvHasUserCreatorRepository;

/**
 * Service.
 */
final class PvHasUserCreator
{
    /**
     * @var PvHasUserCreatorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param PvHasUserCreatorRepository $repository The repository
     */
    public function __construct(PvHasUserCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new Affair.
     *
     * @param PvHasUserCreateData $Affair The Affair data
     *
     * @return int The new Affair ID
     */
    public function createPvHasUser(PvHasUserData $pvHasUser)
    {
        // Validation
        if (empty($pvHasUser->pv_id)) {
            throw new UnexpectedValueException('pv_id required');
        }

        if (empty($pvHasUser->user_id)) {
            throw new UnexpectedValueException('user_id required');
        }

        // Insert pvHasUser
        // $pvHasUserId = $this->repository->insertPvHasUser($pvHasUser);
        $this->repository->insertPvHasUser($pvHasUser);
        // Logging here: pvHasUser created successfully

        // return $pvHasUserId;
    }

    public function addUsersToNewPv(array $data)
    {
        if (empty($data)) {
            throw new UnexpectedValueException('data required');
        }

        $this->repository->insertPvHasUserToNewPv($data);
    }
}
