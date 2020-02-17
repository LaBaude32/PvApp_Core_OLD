<?php

namespace App\Domain\Tocken\Repository;

use PDO;
use App\Domain\Tocken\Data\TockenData;

/**
 * Repository.
 */
class TockenGetterRepository
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

    public function getTockenById(int $id_tocken): TockenData
    {
        $query = "SELECT * FROM tocken WHERE id_tocken=:id";

        $statement = $this->connection->prepare($query);
        $statement->bindValue('id', $id_tocken, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch();
        $tocken = new TockenData();
        $tocken->tocken = (string) $row['tocken'];
        $tocken->device = (string) $row['device'];
        $tocken->expirationDate = (string) $row['expiration_date'];
        $tocken->userId = (int) $row['user_id'];

        return $tocken;
    }
}
