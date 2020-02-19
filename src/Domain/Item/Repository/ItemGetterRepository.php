<?php

namespace App\Domain\Item\Repository;

use PDO;
use App\Domain\Item\Data\ItemGetData;

/**
 * Repository.
 */
class ItemGetterRepository
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

    public function getItemById(int $id_item): ItemGetData
    {
        $query = "SELECT * FROM item WHERE id_item=:id_item";

        $statement = $this->connection->prepare($query);
        $statement->bindValue('id_item', $id_item, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch();
        $item = new ItemGetData();
        $item->id_item = (int) $row['id_item'];
        $item->position = (int) $row['position'];
        $item->note = (string) $row['note'];
        $item->follow_up = (string) $row['follow_up'];
        $item->ressources = (string) $row['ressources'];
        $item->completion = (string) $row['completion'];
        $item->completion_date = (string) $row['completion_date'];
        $item->visible = (int) $row['visible'];
        $item->created_at = (string) $row['created_at'];

        return $item;
    }

    public function getItemsByPvId(int $id_pv): array
    {
        $query = "SELECT i.*
        FROM item i
        INNER JOIN pv_has_item phi
        ON phi.item_id = i.id_item
        WHERE phi.pv_id =:pv_id";

        $statement = $this->connection->prepare($query);
        $statement->bindValue('pv_id', $id_pv, PDO::PARAM_INT);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $item = new ItemGetData();
            $item->id_item = (int) $row['id_item'];
            $item->position = (string) $row['position'];
            $item->note = (string) $row['note'];
            $item->follow_up = (string) $row['follow_up'];
            $item->ressources = (string) $row['ressources'];
            $item->completion = (string) $row['completion'];
            $item->completion_date = (string) $row['completion_date'];
            $item->visible = (int) $row['visible'];
            $item->created_at = (string) $row['created_at'];

            $items[] = $item;
        }
        return (array) $items;
    }

    public function getAllItems(): array
    {
        $query = "SELECT * FROM item";

        $statement = $this->connection->prepare($query);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $item = new ItemGetData();
            $item->id_item = (int) $row['id_item'];
            $item->position = (string) $row['position'];
            $item->note = (string) $row['note'];
            $item->follow_up = (string) $row['follow_up'];
            $item->ressources = (string) $row['ressources'];
            $item->completion = (string) $row['completion'];
            $item->completion_date = (string) $row['completion_date'];
            $item->visible = (int) $row['visible'];
            $item->created_at = (int) $row['created_at'];

            $items[] = $item;
        }

        return (array) $items;
    }
}
