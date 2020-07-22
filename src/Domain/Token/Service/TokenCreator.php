<?php

namespace App\Domain\Token\Service;

use UnexpectedValueException;
use App\Domain\Token\Data\TokenData;
use App\Domain\Token\Repository\TokenCreatorRepository;

/**
 * Service.
 */
final class TokenCreator
{
    /**
     * @var TokenCreatorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param TokenCreatorRepository $repository The repository
     */
    public function __construct(TokenCreatorRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create a new Affaire.
     *
     * @param TokenData $Affaire The Affaire data
     *
     * @return int The new Affaire ID
     */
    public function createToken(TokenData $token)
    {
        // Validation
        if (empty($token->userId)) {
            throw new UnexpectedValueException('user_id required');
        }

        // Insert token
        $this->repository->createToken($token);

        // Logging here: Token created successfully
    }
}
