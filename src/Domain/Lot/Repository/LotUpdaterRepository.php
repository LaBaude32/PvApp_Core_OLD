<?php

namespace App\Domain\Lot\Repository;

use PDO;
use App\Domain\Lot\Data\LotGetData;

/**
 * Repository.
 */
class LotUpdaterRepository
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
     * Update a lot.
     *
     * @param LotGetData $lot the Lot
     */
    public function updateLot(LotGetData $lot)
    {
        $row = [
            'id_lot' => $lot->id_lot,
            'name' => $lot->name,

        ];

        $sql = "UPDATE lot SET
                name=:name

                WHERE id_lot=:id_lot";

        $statement = $this->connection->prepare($sql);
        $statement->bindValue('id_lot', $lot->id_lot, PDO::PARAM_INT);
        $statement->execute($row);
    }
}
