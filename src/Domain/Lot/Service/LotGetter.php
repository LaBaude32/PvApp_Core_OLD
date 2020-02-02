<?php

namespace App\Domain\Lot\Service;

use UnexpectedValueException;
use App\Domain\Affaire\Repository\AffairesGetterAllRepository;

/**
 * Service.
 */
final class LotGetter
{
    /**
     * @var AffairesGetterAllRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param AffairesGetterAllRepository $repository The repository
     */
    public function __construct(AffairesGetterAllRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all the affaires.
     *
     * @return array All the affaires
     */
    public function getAffaires(): array
    {

        // Get All Affaires
        $affaires = $this->repository->getAllAffaires();

        return (array) $affaires;
    }

    public function getAffaireById(int $id)
    {
        // Validation
        if (empty($id)) {
            throw new UnexpectedValueException('id required');
        }

        if ($id == 0) {
            throw new UnexpectedValueException('id doit être positif');
        }

        $affaire = $this->repository->getAffaireById($id);
        return $affaire;
    }
}
