<?php

namespace App\Domain\PvHasUser\Repository;

use PDO;

/**
 * Repository.
 */
class PvHasUserGetterRepository
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

    public function getPvByUserId(int $userId): array
    {
        $query = "SELECT * FROM pv_has_user WHERE user_id=:id";

        $statement = $this->connection->prepare($query);
        $statement->bindValue('id', $userId, PDO::PARAM_INT);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $pvs[] = $row['pv_id'];
        }

        return (array) $pvs;
    }
}
