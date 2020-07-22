<?php

namespace App\Domain\Affair\Service;

use UnexpectedValueException;
use App\Domain\Affair\Repository\AffairGetterRepository;

/**
 * Service.
 */
final class AffairGetter
{
    /**
     * @var AffairGetterRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param AffairGetterRepository $repository The repository
     */
    public function __construct(AffairGetterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all the affairs.
     *
     * @return array All the affairs
     */
    public function getAllAffairs(): array
    {

        // Get All Affairs
        $affairs = $this->repository->getAllAffairs();

        return (array) $affairs;
    }

    public function getAffairById(int $id)
    {
        // Validation
        if (empty($id)) {
            throw new UnexpectedValueException('id required');
        }

        if ($id == 0) {
            throw new UnexpectedValueException('id doit être positif');
        }

        $affair = $this->repository->getAffairById($id);
        return $affair;
    }

    public function getAffairsByIds(array $affairsId): array
    {
        // Validation
        if (empty($affairsId)) {
            throw new UnexpectedValueException('id required');
        }

        foreach ($affairsId as $affairId) {
            if (empty($affairId)) {
                throw new UnexpectedValueException('id required');
            }
            
            $affair = $this->repository->getAffairById($affairId);
            $affairs[] = $affair;
        }

        return (array) $affairs;
    }
}
