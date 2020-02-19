<?php

namespace App\Domain\Token\Repository;

use PDO;
use App\Domain\Token\Data\TokenData;

/**
 * Repository.
 */
class TokenCreatorRepository
{
    /**
     * @var PDO The database connection
     */
    private $connection;

    /**
     * Constructor.
     *
     * @param PDO $connection The database connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Insert Token row.
     *
     * @param TokenData $token The affaire
     *
     * @return int The new ID
     */
    public function createToken(TokenData $token)
    {
        $row = [
            'token' => (string) $token->token,
            'device' => (string) $token->device,
            'expiration_date' => (string) $token->expirationDate,
            'user_id' => (int) $token->userId
        ];

        $query = "INSERT INTO token SET
                token=:token,
                device=:device,
                expiration_date=:expiration_date,
                user_id=:user_id";

        $this->connection->prepare($query)->execute($row);
    }
}
