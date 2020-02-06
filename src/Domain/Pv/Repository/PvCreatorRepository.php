<?php

namespace App\Domain\Pv\Repository;

use PDO;
use App\Domain\Pv\Data\PvCreateData;

/**
 * Repository.
 */
class PvCreatorRepository
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
     * @param PvCreateData $lot The affaire
     *
     * @return int The new ID
     */
    public function insertPv(PvCreateData $pv): int
    {
        $row = [
            'state' => $pv->state,
            'meeting_date' => $pv->meeting_date,
            'meeting_place' => $pv->meeting_place,
            'meeting_next_date' => $pv->meeting_next_date,
            'meeting_next_place' => $pv->meeting_next_place,
            'affair_id' => $pv->affair_id,
        ];

        $sql = "INSERT INTO pv SET
                state=:state,
                meeting_date=:meeting_date,
                meeting_place=:meeting_place,
                meeting_next_date=:meeting_next_date,
                meeting_next_place=:meeting_next_place,
                affair_id=:affair_id";

        $this->connection->prepare($sql)->execute($row);

        return (int) $this->connection->lastInsertId();
    }
}
