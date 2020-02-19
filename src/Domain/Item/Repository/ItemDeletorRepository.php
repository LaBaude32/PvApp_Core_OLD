<?php

namespace App\Domain\Item\Repository;

use PDO;

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
}
