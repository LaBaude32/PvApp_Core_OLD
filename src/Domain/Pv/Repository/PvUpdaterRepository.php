<?php

namespace App\Domain\Pv\Repository;

use PDO;
use App\Domain\Pv\Data\PvGetData;

/**
 * Repository.
 */
class PvUpdaterRepository
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
     * @param PvGetData $lot The affair
     *
     * @return int The new ID
     */
    public function UpdatePv(PvGetData $pv): int
    {
        $row = [
            'id_pv' => $pv->id_pv,
            'state' => $pv->state,
            'meeting_date' => $pv->meeting_date,
            'meeting_place' => $pv->meeting_place,
            'meeting_next_date' => $pv->meeting_next_date,
            'meeting_next_place' => $pv->meeting_next_place,
            'affair_id' => $pv->affair_id,
        ];

        $query = "UPDATE pv SET
                state=:state,
                meeting_date=:meeting_date,
                meeting_place=:meeting_place,
                meeting_next_date=:meeting_next_date,
                meeting_next_place=:meeting_next_place,
                affair_id=:affair_id
                WHERE id_pv=:id_pv";

        $statement = $this->connection->prepare($query);
        $statement->bindValue('id_pv', $pv->id_pv, PDO::PARAM_INT);
        $statement->execute($row);

        return (int) $pv->id_pv; //TODO: supprimer ça et faire un getter dans le Action
    }
}
