<?php

namespace App\Domain\Tocken\Service;

use App\Domain\Tocken\Data\TockenData;
use UnexpectedValueException;
use App\Domain\Tocken\Repository\TockenGetterRepository;

/**
 * Service.
 */
final class TockenGetter
{
    /**
     * @var TockenGetterRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param TockenGetterRepository $repository The repository
     */
    public function __construct(TockenGetterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all the Tockens.
     *
     * @return TockenData All the Tockens
     */
    public function getTockenById(int $tocken): TockenData
    {
        // Validation
        if (empty($id)) {
            throw new UnexpectedValueException('tocken required');
        }

        // Get All Tockens
        $tockenId = $this->repository->getTockenById($tocken);

        return $tockenId;
    }
}
