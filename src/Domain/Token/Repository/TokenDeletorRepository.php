<?php

namespace App\Domain\Token\Repository;

use PDO;

/**
 * Repository.
 */
class TokenDeletorRepository
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

    public function deleteToken(string $token)
    {
        $row = [
            'token' => $token
        ];

        $query = "DELETE FROM token WHERE token=:token";

        $this->connection->prepare($query)->execute($row);
    }
}
