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

    // public function getItemByPvId(int $id_pv): array //TODO: Ne fonctionne pas encore !
    // {
    //     $query = "SELECT * FROM item WHERE pv_id=:id";

    //     $statement = $this->connection->prepare($query);
    //     $statement->bindValue('id', $id_pv, PDO::PARAM_INT);
    //     $statement->execute();

    //     while ($row = $statement->fetch()) {
    //         $item = new ItemGetData();
    //         $item->id_item = (int) $row['id_item'];
    //         $item->position = (string) $row['position'];
    //         $item->note = (string) $row['note'];
    //         $item->suite_a_donner = (string) $row['suite_a_donner'];
    //         $item->ressource = (string) $row['ressource'];
    //         $item->echeance = (string) $row['echeance'];
    //         $item->visible = (int) $row['visible'];
    //         $item->created_at = (int) $row['created_at'];

    //         $items[] = $item;
    //     }
    //     return (array) $items;
    // }

    public function getAllItems(): array
    //TODO: Comment on trie les items ? dans une requette SQL ou on recupère tout et c'est le serveur qui trie ?
    {
        $query = "SELECT * FROM item";

        $statement = $this->connection->prepare($query);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $item = new ItemGetData();
            $item->id_item = (int) $row['id_item'];
            $item->position = (string) $row['position'];
            $item->note = (string) $row['note'];
            $item->suite_a_donner = (string) $row['suite_a_donner'];
            $item->ressource = (string) $row['ressource'];
            $item->echeance = (string) $row['echeance'];
            $item->visible = (int) $row['visible'];
            $item->created_at = (int) $row['created_at'];

            $items[] = $item;
        }

        return (array) $items;
    }
}
