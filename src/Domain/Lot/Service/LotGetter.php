<?php

namespace App\Domain\Lot\Service;

use UnexpectedValueException;
use App\Domain\Lot\Repository\LotGetterRepository;

/**
 * Service.
 */
final class LotGetter
{
    /**
     * @var LotGetterRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param LotGetterRepository $repository The repository
     */
    public function __construct(LotGetterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all the lots.
     *
     * @return array All the lots
     */
    public function getLotByAffaireId(int $id): array
    {
        // Validation
        if (empty($id)) {
            throw new UnexpectedValueException('id required');
        }

        if ($id == 0) {
            throw new UnexpectedValueException('id doit être positif');
        }

        // Get All lots
        $lots = $this->repository->getLotByAffaireId($id);

        return (array) $lots;
    }
}
