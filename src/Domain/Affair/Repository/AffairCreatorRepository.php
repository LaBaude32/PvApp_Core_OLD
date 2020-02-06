<?php

namespace App\Domain\Affair\Repository;

use App\Domain\Affair\Data\AffairCreateData;
use PDO;

/**
 * Repository.
 */
class AffairCreatorRepository
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
     * Insert affair row.
     *
     * @param AffairCreateData $affair The affair
     *
     * @return int The new ID
     */
    public function insertAffair(AffairCreateData $affair): int
    {
        $row = [
            'nom' => $affair->name,
            'adresse' => $affair->address,
            'avancement' => $affair->progress,
            'type_reu' => $affair->meeting_type
        ];

        $sql = "INSERT INTO affair SET
                nom=:nom,
                adresse=:adresse,
                avancement=:avancement,
                type_reu=:type_reu";

        $this->connection->prepare($sql)->execute($row);

        return (int) $this->connection->lastInsertId();
    }
}
