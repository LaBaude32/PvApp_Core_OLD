<?php

namespace App\Domain\Lot\Repository;

use PDO;

/**
 * Repository.
 */
class LotDeletorRepository
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

    public function deleteLot(int $lotId)
    {
        $row = [
            'id_lot' => $lotId
        ];

        $query = "DELETE FROM lot WHERE id_lot=:id_lot";

        $this->connection->prepare($query)->execute($row);
    }
}
