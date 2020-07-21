<?php

namespace App\Domain\PvHasUser\Service;

use UnexpectedValueException;
use App\Domain\PvHasUser\Data\PvHasUserData;
use App\Domain\PvHasUser\Data\PvHasUserCreateData;
use App\Domain\PvHasUser\Repository\PvHasUserDeletorRepository;

/**
 * Service.
 */
final class PvHasUserDeletor
{
    /**
     * @var PvHasUserDeletorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param PvHasUserDeletorRepository $repository The repository
     */
    public function __construct(PvHasUserDeletorRepository $repository)
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
    public function deletePvHasUser(array $data)
    {
        // var_dump($data);
        // Validation
        if (empty($data['pv_id'])) {
            throw new UnexpectedValueException('pv_id required');
        }

        if (empty($data['user_id'])) {
            throw new UnexpectedValueException('user_id required');
        }

        $this->repository->deletePvHasUser($data);
    }
}
