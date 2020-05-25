<?php

namespace App\Domain\Item\Repository;

use PDO;
use App\Domain\Item\Data\ItemGetData;

/**
 * Repository.
 */
class ItemDeletorRepository
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

    public function deleteItem(int $itemId)
    {
        $row = [
            'id_item' => $itemId
        ];

        $query = "DELETE FROM item WHERE id_item=:id_item";

        $this->connection->prepare($query)->execute($row);
    }

    public function deleteItemHasPv(array $data)
    {
        $row = [
            'id_item' => $data['id_item'],
            'id_pv' => $data['id_pv']
        ];

        $query = "DELETE FROM pv_has_item WHERE item_id=:id_item AND pv_id=:id_pv";

        $this->connection->prepare($query)->execute($row);
    }

    public function deleteItemHasLots(ItemGetData $item)
    {
        foreach ($item->lots as $value) {
            $row = [
                'lot_id' => $value->id_lot,
                'item_id' => $item->id_item
            ];

            $query = "DELETE FROM item_has_lot WHERE item_id=:item_id AND lot_id=:lot_id";

            $this->connection->prepare($query)->execute($row);
        }
    }
}
