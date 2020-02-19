<?php

namespace App\Domain\Lot\Service;

use UnexpectedValueException;
use App\Domain\Lot\Data\LotCreateData;
use App\Domain\Lot\Repository\LotDeletorRepository;

/**
 * Service.
 */
final class LotDeletor
{
    /**
     * @var LotDeletorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param LotDeletorRepository $repository The repository
     */
    public function __construct(LotDeletorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function deleteLot(int $lotId)
    {
        // Validation
        if (empty($lotId)) {
            throw new UnexpectedValueException('Id required');
        }

        // delete Lot
        $this->repository->deleteLot($lotId);

        // Logging here: Lot created successfully
    }
}
