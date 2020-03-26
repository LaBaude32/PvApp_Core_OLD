<?php

namespace App\Domain\Lot\Repository;

use PDO;
use App\Domain\Lot\Data\LotCreateData;

/**
 * Repository.
 */
class LotCreatorRepository
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
     * Insert lot row.
     *
     * @param LotCreateData $lot The affaire
     *
     * @return int The new ID
     */
    public function insertLot(LotCreateData $lot): int
    {
        $row = [
            'name' => $lot->name,
            'affair_id' => $lot->affair_id,
        ];

        $sql = "INSERT INTO lot SET
                name=:name,
                affair_id=:affair_id";

        $this->connection->prepare($sql)->execute($row);

        return (int) $this->connection->lastInsertId();
    }

    /**
     * Insert lot row.
     *
     * @param LotCreateData $lot The affaire
     *
     * @return int The new ID
     */
    public function insertLots(array $lots)
    {
        foreach ($lots as $lot) {
            $row = [
                'name' => $lot->name,
                'affair_id' => $lot->affair_id,
            ];

            $sql = "INSERT INTO lot SET
                name=:name,
                affair_id=:affair_id";

            $this->connection->prepare($sql)->execute($row);
        }
    }
}
