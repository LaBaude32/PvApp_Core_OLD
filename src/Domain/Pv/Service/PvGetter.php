<?php

namespace App\Domain\Pv\Service;

use UnexpectedValueException;
use App\Domain\Pv\Repository\PvGetterRepository;

/**
 * Service.
 */
final class PvGetter
{
    /**
     * @var PvGetterRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param PvGetterRepository $repository The repository
     */
    public function __construct(PvGetterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all the pvs.
     *
     * @return array All the pvs
     */
    public function getPvByAffaireId(int $id): array
    {
        // Validation
        if (empty($id)) {
            throw new UnexpectedValueException('id required');
        }

        if ($id == 0) {
            throw new UnexpectedValueException('id doit être positif');
        }

        // Get All pvs
        $pvs = $this->repository->getPvByAffaireId($id);

        return (array) $pvs;
    }


    /**
     * Get one pvs.
     *
     * @return array All one pv with his items
     */
    public function getPvById(int $id): array
    {
        // Validation
        if (empty($id)) {
            throw new UnexpectedValueException('id required');
        }

        if ($id == 0) {
            throw new UnexpectedValueException('id doit être positif');
        }

        // Get one pv
        $pv = $this->repository->getPvById($id);

        return (array) $pv;
    }
}
