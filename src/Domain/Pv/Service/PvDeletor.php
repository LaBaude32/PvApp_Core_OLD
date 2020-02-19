<?php

namespace App\Domain\Pv\Service;

use UnexpectedValueException;
use App\Domain\Pv\Repository\PvDeletorRepository;

/**
 * Service.
 */
final class PvDeletor
{
    /**
     * @var PvDeletorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param PvDeletorRepository $repository The repository
     */
    public function __construct(PvDeletorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function deletePv(int $pvId)
    {
        // Validation
        if (empty($pvId)) {
            throw new UnexpectedValueException('Id required');
        }

        // delete Pv
        $this->repository->deletePv($pvId);

        // Logging here: Pv created successfully
    }
}
