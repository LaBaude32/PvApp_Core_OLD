<?php

namespace App\Domain\Affair\Service;

use UnexpectedValueException;
use App\Domain\Affair\Data\AffairCreateData;
use App\Domain\Affair\Repository\AffairDeletorRepository;

/**
 * Service.
 */
final class AffairDeletor
{
    /**
     * @var AffairDeletorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param AffairDeletorRepository $repository The repository
     */
    public function __construct(AffairDeletorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function deleteAffair(int $affairId)
    {
        // Validation
        if (empty($affairId)) {
            throw new UnexpectedValueException('Id required');
        }

        // delete Affair
        $this->repository->deleteAffair($affairId);

        // Logging here: Affair created successfully
    }
}
