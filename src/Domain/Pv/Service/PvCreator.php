<?php

namespace App\Domain\Pv\Service;

use UnexpectedValueException;
use App\Domain\Pv\Data\PvCreateData;
use App\Domain\Pv\Repository\PvCreatorRepository;

/**
 * Service.
 */
final class PvCreator
{
    /**
     * @var PvCreatorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param PvCreatorRepository $repository The repository
     */
    public function __construct(PvCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new Affair.
     *
     * @param PvCreateData $Affair The Affair data
     *
     * @return int The new Affair ID
     */
    public function createPv(PvCreateData $pv): int
    {
        // Validation
        if (empty($pv->meeting_date)) {
            throw new UnexpectedValueException('date de réunion required');
        }

        if (empty($pv->meeting_place)) {
            throw new UnexpectedValueException('lieu de réunion required');
        }

        if (empty($pv->affair_id)) {
            throw new UnexpectedValueException('Affair required');
        }

        // Insert pv
        $pvId = $this->repository->insertPv($pv);

        // Logging here: pv created successfully

        return $pvId;
    }
}
