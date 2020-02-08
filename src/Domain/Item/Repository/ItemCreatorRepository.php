<?php

namespace App\Domain\Item\Repository;

use PDO;
use App\Domain\Item\Data\ItemCreateData;

/**
 * Repository.
 */
class ItemCreatorRepository
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
     * @param ItemCreateData $lot The affaire
     *
     * @return int The new ID
     */
    public function insertItem(ItemCreateData $item): int
    {
        $row = [
            'position' => $item->position,
            'note' => $item->note,
            'follow_up' => $item->follow_up,
            'ressources' => $item->ressources,
            'completion' => $item->completion,
            'completion_date' => $item->completion_date,
            'visible' => $item->visible,
            'created_at' => $item->created_at
        ];

        $query = "INSERT INTO item SET
                position=:position,
                note=:note,
                follow_up=:follow_up,
                ressources=:ressources,
                completion=:completion,
                completion_date=:completion_date,
                visible=:visible,
                created_at=:created_at";

        $this->connection->prepare($query)->execute($row);

        return (int) $this->connection->lastInsertId();
    }

    /**
     * Insert lot row.
     *
     * @param ItemCreateData $lot The affaire
     *
     * @return int The new ID
     */
    public function insertPvHasItem($ids): int
    {
        $itemId = $ids['itemId'];
        $pvId = $ids['pvId'];

        
        $row = [
            'pv_id' => $pvId,
            'item_id' => $itemId
        ];

        $query = "INSERT INTO pv_has_item SET
                pv_id=:pv_id,
                item_id=:item_id";

        $this->connection->prepare($query)->execute($row);

        return (int) $this->connection->lastInsertId();
    }
}
