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
     * Create a new Affaire.
     *
     * @param PvCreateData $Affaire The Affaire data
     *
     * @return int The new Affaire ID
     */
    public function createPv(PvCreateData $pv): int
    {
        // Validation
        if (empty($pv->date_reunion)) {
            throw new UnexpectedValueException('date de réunion required');
        }

        if (empty($pv->lieu_reunion)) {
            throw new UnexpectedValueException('lieu de réunion required');
        }

        if (empty($pv->affaire_id)) {
            throw new UnexpectedValueException('Affaire required');
        }

        // Insert pv
        $pvId = $this->repository->insertPv($pv);

        // Logging here: pv created successfully

        return $pvId;
    }
}
