<?php

namespace App\Domain\Affaire\Service;

use UnexpectedValueException;
use App\Domain\Affaire\Repository\AffaireGetterRepository;

/**
 * Service.
 */
final class AffaireGetter
{
    /**
     * @var AffaireGetterRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param AffaireGetterRepository $repository The repository
     */
    public function __construct(AffaireGetterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all the affaires.
     *
     * @return array All the affaires
     */
    public function getAllAffaires(): array
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
