<?php

namespace App\Domain\Lot\Service;

use App\Domain\Lot\Data\LotGetData;
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
    public function getLotById(int $id): LotGetData
    {
        // Validation
        if (empty($id)) {
            throw new UnexpectedValueException('id required');
        }

        if ($id == 0) {
            throw new UnexpectedValueException('id doit être positif');
        }

        // Get All lots
        $lot = $this->repository->getLotById($id);

        return $lot;
    }

    /**
     * Get all the lots.
     *
     * @return array All the lots
     */
    public function getLotByAffairId(int $id): array
    {
        // Validation
        if (empty($id)) {
            throw new UnexpectedValueException('id required');
        }

        if ($id == 0) {
            throw new UnexpectedValueException('id doit être positif');
        }

        // Get All lots
        $lots = $this->repository->getLotByAffairId($id);

        return (array) $lots;
    }
}
