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
            'suite_a_donner' => $item->suite_a_donner,
            'ressources' => $item->ressources,
            'echeance' => $item->echeance,
            'date_echeance' => $item->date_echeance,
            'visible' => $item->visible,
            'created_at' => $item->created_at
        ];

        $query = "INSERT INTO item SET
                position=:position,
                note=:note,
                suite_a_donner=:suite_a_donner,
                ressources=:ressources,
                echeance=:echeance,
                date_echeance=:date_echeance,
                visible=:visible,
                created_at=:created_at";

        $this->connection->prepare($query)->execute($row);

        return (int) $this->connection->lastInsertId();
    }
}
