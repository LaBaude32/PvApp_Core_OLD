<?php

namespace App\Domain\Token\Service;

use UnexpectedValueException;
use App\Domain\Token\Data\TokenData;
use App\Domain\Token\Repository\TokenUpdaterRepository;

/**
 * Service.
 */
final class TokenUpdater
{
    /**
     * @var TokenUpdaterRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param TokenUpdaterRepository $repository The repository
     */
    public function __construct(TokenUpdaterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Update a Token.
     *
     * @param TokenData
     */
    public function updateToken(TokenData $token)
    {
        // Validation
        if (empty($token->token)) {
            throw new UnexpectedValueException('token required');
        }

        // Update token
        $this->repository->updateToken($token);

        // Logging here: token created successfully
    }
}
