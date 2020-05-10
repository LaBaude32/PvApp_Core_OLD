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
            'name' => $affair->name,
            'address' => $affair->address,
            'progress' => $affair->progress,
            'meeting_type' => $affair->meeting_type,
            'description' => $affair->description
        ];

        $sql = "INSERT INTO affair SET
                name=:name,
                address=:address,
                progress=:progress,
                meeting_type=:meeting_type,
                description=:description";

        $this->connection->prepare($sql)->execute($row);

        return (int) $this->connection->lastInsertId();
    }
}
