<?php

namespace App\Domain\Token\Service;

use UnexpectedValueException;
use App\Domain\Token\Repository\TokenDeletorRepository;

/**
 * Service.
 */
final class TokenDeletor
{
    /**
     * @var TokenDeletorRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param TokenDeletorRepository $repository The repository
     */
    public function __construct(TokenDeletorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function deleteToken(string $token)
    {
        // Validation
        if (empty($token)) {
            throw new UnexpectedValueException('Id required');
        }

        // delete Token
        $this->repository->deleteToken($token);

        // Logging here: Token created successfully
    }
}
