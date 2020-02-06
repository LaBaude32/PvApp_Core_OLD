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

    public function getItemByPvId(int $id_pv): array //TODO: Ne fonctionne pas encore !
    {
        $query = "SELECT * FROM item WHERE pv_id=:id";

        $statement = $this->connection->prepare($query);
        $statement->bindValue('id', $id_pv, PDO::PARAM_INT);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $item = new ItemGetData();
            $item->id_item = (int) $row['id_item'];
            $item->position = (string) $row['position'];
            $item->note = (string) $row['note'];
            $item->follow_up = (string) $row['follow_up'];
            $item->completion = (string) $row['completion'];
            $item->completion_date = (string) $row['completion_date'];
            $item->visible = (int) $row['visible'];
            $item->created_at = (int) $row['created_at'];

            $items[] = $item;
        }
        return (array) $items;
    }


    //TODO: Ajouter une propriété à l'objet, faire une jointure de table, recuperer les item là où y'a le bon id_pv

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
            $item->completion = (string) $row['completion'];
            $item->completion_date = (string) $row['completion_date'];
            $item->visible = (int) $row['visible'];
            $item->created_at = (int) $row['created_at'];

            $items[] = $item;
        }

        return (array) $items;
    }
}
