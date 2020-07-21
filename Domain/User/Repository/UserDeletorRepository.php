<?php

namespace App\Domain\User\Repository;

use PDO;

/**
 * Repository.
 */
class UserDeletorRepository
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

    public function deleteUser(int $userId)
    {
        $row = [
            'id_user' => $userId
        ];

        $query = "DELETE FROM user WHERE id_user=:id_user";

        $this->connection->prepare($query)->execute($row);
    }
}
