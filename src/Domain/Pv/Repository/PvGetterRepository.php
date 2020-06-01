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
        $sql = "SELECT * FROM pv WHERE affair_id=:id";

        $statement = $this->connection->prepare($sql);
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

            $pvs[] = $pv;
        }
        return (array) $pvs;
    }

    public function getPvById(int $id_pv): PvGetData
    {
        $query = "SELECT p.*, a.meeting_type as affair_meeting_type
        FROM pv p
        INNER JOIN affair a ON a.id_affair = p.affair_id
        WHERE p.id_pv =:id";

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
        $pv->affair_meeting_type = (string) $row['affair_meeting_type'];
        $pv->release_date = (string) $row['release_date'];

        return $pv;
    }

    public function getPvNumber(PvGetData $pv): PvGetData
    {
        $query = "SELECT COUNT(created_at) as result FROM pv WHERE affair_id = :affairId AND id_pv <= :pvId";

        $statement = $this->connection->prepare($query);
        $statement->bindValue('affairId', $pv->affair_id, PDO::PARAM_INT);
        $statement->bindValue('pvId', $pv->id_pv, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch();

        $pv->pv_number = (int) $row['result'];

        return $pv;
    }

    public function getPvsByUserId(array $data): array
    {
        $query = "SELECT p.*, a.name as affair_name
        FROM pv p
        INNER JOIN pv_has_user phu ON phu.pv_id = p.id_pv
        INNER JOIN affair a ON a.id_affair = p.affair_id
        WHERE phu.user_id =:user_id
        ORDER BY p.created_at
        DESC
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
            $pv->affair_name = (string) $row['affair_name'];

            $pvs[] = $pv;
        }


        return (array) $pvs;
    }

    public function getLotsForPv(PvGetData $pv): PvGetData
    {
        $query = "SELECT l.* FROM lot l
            INNER JOIN affair a ON a.id_affair = l.affair_id
            INNER JOIN pv i ON i.affair_id = a.id_affair
            WHERE i.id_pv =:pvId";

        $statement = $this->connection->prepare($query);
        $statement->bindValue("pvId", $pv->id_pv, PDO::PARAM_INT);
        $statement->execute();
        while ($row = $statement->fetch()) {
            $result = new LotGetData();
            $result->id_lot = (int) $row['id_lot'];
            $result->name = (string) $row['name'];

            $pv->lots[] = $result;
        }
        $pvToReturn = $pv;

        return $pvToReturn;
    }

    // public function getPreviousPv(PvGetData $pv): PvGetData
    // {
    //     $query = "SELECT * FROM pv WHERE affair_id=:affairId AND id_pv=:pvId";
    //     $pv = new PvGetData;

    //     return $pv;
    // }
}
