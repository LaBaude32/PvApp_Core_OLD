<?php

namespace App\Domain\Lot\Repository;

use PDO;
use App\Domain\Lot\Data\LotGetData;

/**
 * Repository.
 */
class LotGetterRepository
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

    public function getLotByAffaireId(int $id_affaire): array
    {
        $sql = "SELECT * FROM lot WHERE affaire_id=:id";

        $statement = $this->connection->prepare($sql);
        $statement->bindValue('id', $id_affaire, PDO::PARAM_INT);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $lot = new LotGetData();
            $lot->id_lot = (int) $row['id_lot'];
            $lot->name = (string) $row['name'];

            $lots[] = $lot;
        }
        return (array) $lots;
    }
}
