<?php

namespace App\Domain\Pv\Service;

use UnexpectedValueException;
use App\Domain\Pv\Data\PvGetData;
use App\Domain\Pv\Repository\PvUpdaterRepository;

/**
 * Service.
 */
final class PvUpdater
{
    /**
     * @var PvUpdaterRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param PvUpdaterRepository $repository The repository
     */
    public function __construct(PvUpdaterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new Affaire.
     *
     * @param PvGetData $Affaire The Affaire data
     *
     * @return int The new Affaire ID
     */
    public function updatePv(PvGetData $pv): int
    {
        // Validation
        if (empty($pv->id_pv)) {
            throw new UnexpectedValueException('id required');
        }

        // Insert pv
        $pvId = $this->repository->updatePv($pv);

        // Logging here: pv created successfully

        return $pvId;
    }

    public function validatePv(int $pvId)
    {
        // Validation
        if (empty($pvId)) {
            throw new UnexpectedValueException('id required');
        }

        // Insert pv
        $pvId = $this->repository->validatePv($pvId);
    }
}
