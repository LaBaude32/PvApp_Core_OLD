<?php

namespace App\Domain\Tocken\Service;

use UnexpectedValueException;
use App\Domain\Tocken\Data\TockenData;
use App\Domain\Tocken\Repository\TockenCreatorRepository;

/**
 * Service.
 */
final class TockenCreator
{
    /**
     * @var TockenCreatorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param TockenCreatorRepository $repository The repository
     */
    public function __construct(TockenCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new Affaire.
     *
     * @param TockenData $Affaire The Affaire data
     *
     * @return int The new Affaire ID
     */
    public function createTocken(TockenData $tocken): int
    {
        // Validation
        if (empty($tocken->name)) {
            throw new UnexpectedValueException('Nom required');
        }

        // Insert tocken
        $tockenId = $this->repository->createTocken($tocken);

        // Logging here: Tocken created successfully

        return $tockenId;
    }
}
