<?php

namespace App\Domain\Token\Repository;

use PDO;
use App\Domain\Token\Data\TokenData;

/**
 * Repository.
 */
class TokenGetterRepository
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

    public function getTokenById(string $token): TokenData
    {
        $query = "SELECT * FROM token WHERE token=:token";

        $statement = $this->connection->prepare($query);
        $statement->bindValue('token', $token, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch();
        $token = new TokenData();
        $token->token = (string) $row['token'];
        $token->device = (string) $row['device'];
        $token->expirationDate = (string) $row['expiration_date'];
        $token->userId = (int) $row['user_id'];

        return $token;
    }

    public function getTokensByUserId(int $userId): array
    {
        $query = "SELECT * FROM token WHERE user_id=:user_id";

        $statement = $this->connection->prepare($query);
        $statement->bindValue('user_id', $userId, PDO::PARAM_INT);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $token = new TokenData();
            $token->token = (string) $row['token'];
            $token->device = (string) $row['device'];
            $token->expirationDate = (string) $row['expiration_date'];
            $token->userId = (int) $row['user_id'];

            $tokens[] = $token;
        }

        return (array) $tokens;
    }
}
