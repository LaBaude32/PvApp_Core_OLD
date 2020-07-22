<?php

namespace App\Domain\Pv\Repository;

use PDO;

/**
 * Repository.
 */
class PvDeletorRepository
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

    public function deletePv(int $pvId)
    {
        $row = [
            'id_pv' => $pvId
        ];

        $query = "DELETE FROM pv WHERE id_pv=:id_pv";

        $this->connection->prepare($query)->execute($row);
    }
}
