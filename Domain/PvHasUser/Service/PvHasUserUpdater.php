<?php

namespace App\Domain\PvHasUser\Service;

use UnexpectedValueException;
use App\Domain\PvHasUser\Data\PvHasUserData;
use App\Domain\PvHasUser\Data\PvHasUserCreateData;
use App\Domain\PvHasUser\Repository\PvHasUserUpdaterRepository;

/**
 * Service.
 */
final class PvHasUserUpdater
{
    /**
     * @var PvHasUserUpdaterRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param PvHasUserUpdaterRepository $repository The repository
     */
    public function __construct(PvHasUserUpdaterRepository $repository)
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
    public function updatePvHasUser(PvHasUserData $pvHasUser)
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
        $this->repository->updatePvHasUser($pvHasUser);
        // Logging here: pvHasUser created successfully

        // return $pvHasUserId;
    }
}
