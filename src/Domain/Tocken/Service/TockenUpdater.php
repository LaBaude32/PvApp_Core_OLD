<?php

namespace App\Domain\Tocken\Service;

use UnexpectedValueException;
use App\Domain\Tocken\Data\TockenData;
use App\Domain\Tocken\Repository\TockenUpdaterRepository;

/**
 * Service.
 */
final class TockenUpdater
{
    /**
     * @var TockenUpdaterRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param TockenUpdaterRepository $repository The repository
     */
    public function __construct(TockenUpdaterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Update a Tocken.
     *
     * @param TockenData
     */
    public function updateTocken(TockenData $tocken)
    {
        // Validation
        if (empty($tocken->tocken)) {
            throw new UnexpectedValueException('tocken required');
        }

        // Update tocken
        $this->repository->updateTocken($tocken);

        // Logging here: tocken created successfully
    }
}
