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
            $pv->etat = (string) $row['etat'];
            $pv->date_reunion = (string) $row['date_reunion'];
            $pv->lieu_reunion = (string) $row['lieu_reunion'];
            $pv->date_prochaine_reunion = (string) $row['date_pro_reunion'];
            $pv->lieu_prochaine_reunion = (string) $row['lieu_pro_reunion'];
            $pv->affair_id = (int) $row['affair_id'];

            $pvs[] = $pv;
        }
        return (array) $pvs;
    }

    public function getPvById(int $id_pv): array
    {
        $sql = "SELECT * FROM pv WHERE id_pv=:id";

        $statement = $this->connection->prepare($sql);
        $statement->bindValue('id', $id_pv, PDO::PARAM_INT);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $pv = new PvGetData();
            $pv->id_pv = (int) $row['id_pv'];
            $pv->etat = (string) $row['etat'];
            $pv->date_reunion = (string) $row['date_reunion'];
            $pv->lieu_reunion = (string) $row['lieu_reunion'];
            $pv->date_prochaine_reunion = (string) $row['date_pro_reunion'];
            $pv->lieu_prochaine_reunion = (string) $row['lieu_pro_reunion'];
            $pv->affair_id = (int) $row['affair_id'];

            $pvs[] = $pv;
        }
        return (array) $pvs;
    }
}
