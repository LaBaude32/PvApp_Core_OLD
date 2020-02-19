<?php

namespace App\Domain\Affair\Repository;

use PDO;

/**
 * Repository.
 */
class AffairDeletorRepository
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

    public function deleteAffair(int $affairId)
    {
        $row = [
            'id_affair' => $affairId
        ];

        $query = "DELETE FROM affair WHERE id_affair=:id_affair";

        $this->connection->prepare($query)->execute($row);
    }
}
