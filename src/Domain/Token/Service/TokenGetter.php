<?php

namespace App\Domain\Token\Service;

use App\Domain\Token\Data\TokenData;
use UnexpectedValueException;
use App\Domain\Token\Repository\TokenGetterRepository;

/**
 * Service.
 */
final class TokenGetter
{
    /**
     * @var TokenGetterRepository
     */
    private $repository;

    /**
     * The constructor.
     *
     * @param TokenGetterRepository $repository The repository
     */
    public function __construct(TokenGetterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get all the Tokens.
     *
     * @return TokenData All the Tokens
     */
    public function getTokenById(string $token): TokenData
    {
        // Validation
        if (empty($token)) {
            throw new UnexpectedValueException('token required');
        }

        // Get All Tokens
        $tokenId = $this->repository->getTokenById($token);

        return $tokenId;
    }

    public function getLoggedToken(array $datas): TokenData
    {
        // Validation
        if (empty($datas['userId'])) {
            throw new UnexpectedValueException('user Id required');
        }

        // Get All Tokens
        $token = $this->repository->getLoggedToken($datas);

        return $token;
    }
}
