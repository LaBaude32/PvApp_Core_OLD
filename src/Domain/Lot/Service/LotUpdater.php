<?php

namespace App\Domain\Lot\Service;

use UnexpectedValueException;
use App\Domain\Lot\Data\LotGetData;
use App\Domain\Lot\Repository\LotUpdaterRepository;

/**
 * Service.
 */
final class LotUpdater
{
    /**
     * @var LotUpdaterRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param LotUpdaterRepository $repository The repository
     */
    public function __construct(LotUpdaterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Update a Lot.
     *
     * @param LotGetData
     */
    public function UpdateLot(LotGetData $lot)
    {
        // Validation
        if (empty($lot->id_lot)) {
            throw new UnexpectedValueException('id required');
        }

        // Update lot
        $this->repository->updateLot($lot);

        // Logging here: lot created successfully
    }
}
