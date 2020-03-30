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
    public function insertLots(array $lots): array
    {
        foreach ($lots as $lot) {
            $row = [
                'name' => $lot,
                'affair_id' => $lot->affair_id,
            ];

            $sql = "INSERT INTO lot SET
                name=:name,
                affair_id=:affair_id";

            $this->connection->prepare($sql)->execute($row);

            $lotId = (int) $this->connection->lastInsertId();

            $lotsIds[] = $lotId;
        }

        return (array) $lotsIds;
    }

    public function linkLotsToItem(array $lotsIds, int $itemId)
    {
        foreach ($lotsIds as $lotId) {
            $row = [
                'lot_id' => $lotId,
                'item_id' => $itemId,
            ];

            $sql = "INSERT INTO item_has_lot SET
                lot_id=:lot_id,
                item_id=:item_id";

            $this->connection->prepare($sql)->execute($row);
        }
    }
}
