<?php

namespace App\Domain\Token\Repository;

use PDO;
use App\Domain\Token\Data\TokenData;

/**
 * Repository.
 */
class TokenUpdaterRepository
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
     * Update a Token.
     *
     * @param TokenData $Token the Token
     */
    public function updateToken(TokenData $token)
    {
        $row = [
            'token' => $token->token,
            'device' => $token->device,
            'expiration_date' => $token->expirationDate,
            'user_id' => $token->userId
        ];

        $sql = "UPDATE token SET
                device=:device,
                expiration_date=:expiration_date,
                user_id=:user_id,
                WHERE token=:token";

        $statement = $this->connection->prepare($sql);
        $statement->bindValue('token', $token->token, PDO::PARAM_STR);
        $statement->execute($row);
    }
}
