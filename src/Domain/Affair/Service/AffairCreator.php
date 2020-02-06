<?php

namespace App\Domain\Affair\Service;

use UnexpectedValueException;
use App\Domain\Affair\Data\AffairCreateData;
use App\Domain\Affair\Repository\AffairCreatorRepository;

/**
 * Service.
 */
final class AffairCreator
{
    /**
     * @var AffairCreatorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param AffairCreatorRepository $repository The repository
     */
    public function __construct(AffairCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new Affair.
     *
     * @param AffairCreateData $Affair The Affair data
     *
     * @return int The new Affair ID
     */
    public function createAffair(AffairCreateData $affair): int
    {
        // Validation
        if (empty($affair->nom)) {
            throw new UnexpectedValueException('Nom required');
        }

        // Insert Affair
        $affairId = $this->repository->insertAffair($affair);

        // Logging here: Affair created successfully

        return $affairId;
    }
}
