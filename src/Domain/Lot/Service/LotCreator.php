<?php

namespace App\Domain\Lot\Service;

use UnexpectedValueException;
use App\Domain\Lot\Data\LotCreateData;
use App\Domain\Lot\Repository\LotCreatorRepository;

/**
 * Service.
 */
final class LotCreator
{
    /**
     * @var LotCreatorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param LotCreatorRepository $repository The repository
     */
    public function __construct(LotCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new Affaire.
     *
     * @param LotCreateData $Affaire The Affaire data
     *
     * @return int The new Affaire ID
     */
    public function createLot(LotCreateData $lot): int
    {
        // Validation
        if (empty($lot->name)) {
            throw new UnexpectedValueException('Nom required');
        }

        // Insert lot
        $lotId = $this->repository->insertLot($lot);

        // Logging here: lot created successfully

        return $lotId;
    }
}
