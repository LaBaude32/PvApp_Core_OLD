<?php

namespace App\Domain\ItemHasPv\Repository;

use PDO;
use App\Domain\ItemHasPv\Data\ItemHasPvData;

/**
 * Repository.
 */
class ItemHasPvCreatorRepository
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
     * @param ItemHasPvCreateData $lot The affaire
     *
     * @return int The new ID
     */
    public function insertItemHasPv(ItemHasPvData $itemHasPv): int
    {
        $row = [
            'item_id' => $itemHasPv->item_id,
            'pv_id' => $itemHasPv->pv_id,
        ];

        $query = "INSERT INTO item_has_pv SET
                item_id=:item_id,
                pv_id=:pv_id";

        $this->connection->prepare($query)->execute($row);

        return (int) $this->connection->lastInsertId();
    }
}
