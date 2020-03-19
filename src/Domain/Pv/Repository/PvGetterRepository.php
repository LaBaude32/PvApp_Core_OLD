<?php

namespace App\Domain\Pv\Repository;

use PDO;
use App\Domain\Pv\Data\PvGetData;
use App\Domain\Lot\Data\LotGetData;

/**
 * Repository.
 */
class PvGetterRepository
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

    public function getPvByAffairId(int $id_affair): array
    {
        $query = "SELECT p.*, a.name
        FROM pv p
        INNER JOIN affair a
        ON p.affair_id = a.id_affair
        WHERE id_pv=:id";

        $statement = $this->connection->prepare($query);
        $statement->bindValue('id', $id_affair, PDO::PARAM_INT);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $pv = new PvGetData();
            $pv->id_pv = (int) $row['id_pv'];
            $pv->state = (string) $row['state'];
            $pv->meeting_date = (string) $row['meeting_date'];
            $pv->meeting_place = (string) $row['meeting_place'];
            $pv->meeting_next_date = (string) $row['meeting_next_date'];
            $pv->meeting_next_place = (string) $row['meeting_next_place'];
            $pv->affair_id = (int) $row['affair_id'];
            $pv->affair_name = (string) $row["name"];
            var_dump($row["name"]);

            $pvs[] = $pv;
        }
        return (array) $pvs;
    }

    public function getPvById(int $id_pv): PvGetData
    {
        $query = "SELECT * FROM pv WHERE id_pv=:id";

        $statement = $this->connection->prepare($query);
        $statement->bindValue('id', $id_pv, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch();
        $pv = new PvGetData();
        $pv->id_pv = (int) $row['id_pv'];
        $pv->state = (string) $row['state'];
        $pv->meeting_date = (string) $row['meeting_date'];
        $pv->meeting_place = (string) $row['meeting_place'];
        $pv->meeting_next_date = (string) $row['meeting_next_date'];
        $pv->meeting_next_place = (string) $row['meeting_next_place'];
        $pv->affair_id = (int) $row['affair_id'];

        return $pv;
    }

    public function getPvsByUserId(array $data): array
    {
        $query = "SELECT p.*
        FROM pv p
        INNER JOIN pv_has_user phu
        ON phu.pv_id = p.id_pv
        WHERE phu.user_id =:user_id
        ORDER BY p.meeting_date
        LIMIT :nbPvs";

        $statement = $this->connection->prepare($query);
        $statement->bindValue('user_id', $data['userId'], PDO::PARAM_INT);
        $statement->bindValue('nbPvs', $data['numberOfPvs'], PDO::PARAM_INT);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $pv = new PvGetData();
            $pv->id_pv = (int) $row['id_pv'];
            $pv->state = (string) $row['state'];
            $pv->meeting_date = (string) $row['meeting_date'];
            $pv->meeting_place = (string) $row['meeting_place'];
            $pv->meeting_next_date = (string) $row['meeting_next_date'];
            $pv->meeting_next_place = (string) $row['meeting_next_place'];
            $pv->affair_id = (int) $row['affair_id'];

            $pvs[] = $pv;
        }


        return (array) $pvs;
    }
}
