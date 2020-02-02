<?php

namespace App\Domain\Affaire\Service;

use App\Domain\Affaire\Repository\AffairesGetterAllRepository;

/**
 * Service.
 */
final class AffairesGetterAll
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
}
