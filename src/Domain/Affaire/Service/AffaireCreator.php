<?php

namespace App\Domain\Affaire\Service;

use UnexpectedValueException;
use App\Domain\Affaire\Data\AffaireCreateData;
use App\Domain\Affaire\Repository\AffaireCreatorRepository;

/**
 * Service.
 */
final class AffaireCreator
{
    /**
     * @var AffaireCreatorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param AffaireCreatorRepository $repository The repository
     */
    public function __construct(AffaireCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new Affaire.
     *
     * @param AffaireCreateData $Affaire The Affaire data
     *
     * @return int The new Affaire ID
     */
    public function createAffaire(AffaireCreateData $affaire): int
    {
        // Validation
        if (empty($affaire->nom)) {
            throw new UnexpectedValueException('Nom required');
        }

        // Insert Affaire
        $affaireId = $this->repository->insertAffaire($affaire);

        // Logging here: Affaire created successfully

        return $affaireId;
    }
}
