<?php

namespace App\Domain\Item\Repository;

use PDO;
use App\Domain\Item\Data\ItemGetData;

/**
 * Repository.
 */
class ItemUpdaterRepository
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
     * @param ItemGetData $lot The affaire
     *
     * @return int The new ID
     */
    public function updateItem(ItemGetData $item): int
    {
        $row = [
            'id_item' => $item->id_item,
            'position' => $item->position,
            'note' => $item->note,
            'follow_up' => $item->follow_up,
            'ressources' => $item->ressources,
            'completion' => $item->completion,
            'completion_date' => $item->completion_date,
            'visible' => $item->visible,
            'created_at' => $item->created_at
        ];

        $query = "UPDATE item SET
               position=:position,
                note=:note,
                follow_up=:follow_up,
                ressources=:ressources,
                completion=:completion,
                completion_date=:completion_date,
                visible=:visible,
                created_at=:created_at
                WHERE id_item=:id_item";

        $statement = $this->connection->prepare($query);
        $statement->bindValue('id_item', $item->id_item, PDO::PARAM_INT);
        $statement->execute($row);

        // return (int) $this->connection->lastInsertId(); //TODO: ne renvoie rien
        return (int) $item->id_item;
    }
}
