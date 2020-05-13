<?php

namespace App\Domain\Affair\Repository;

use App\Domain\Affair\Data\AffairGetData;
use PDO;

/**
 * Repository.
 */
class AffairUpdaterRepository
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
     * @param AffairGetData $affair The affair
     *
     * @return int The new ID
     */
    public function updateAffair(AffairGetData $affair): int
    {
        $row = [
            'id_affair' => $affair->id_affair,
            'name' => $affair->name,
            'address' => $affair->address,
            'progress' => $affair->progress,
            'meeting_type' => $affair->meeting_type,
            'description' => $affair->description
        ];

        $query = "UPDATE affair SET
                name=:name,
                address=:address,
                progress=:progress,
                meeting_type=:meeting_type,
                description=:description
                WHERE id_affair=:id_affair";

        $statement = $this->connection->prepare($query);
        $statement->bindValue('id_affair', $affair->id_affair, PDO::PARAM_INT);
        $statement->execute($row);

        return (int) $affair->id_affair;
    }
}
