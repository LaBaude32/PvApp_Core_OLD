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
            'etat' => $pv->etat,
            'date_reunion' => $pv->date_reunion,
            'lieu_reunion' => $pv->lieu_reunion,
            'date_prochaine_reunion' => $pv->date_prochaine_reunion,
            'lieu_prochaine_reunion' => $pv->lieu_prochaine_reunion,
            'affaire_id' => $pv->affaire_id,
        ];

        $sql = "INSERT INTO pv SET 
                etat=:etat,
                date_reunion=:date_reunion,
                lieu_reunion=:lieu_reunion,
                date_pro_reunion=:date_prochaine_reunion,
                lieu_pro_reunion=:lieu_prochaine_reunion,
                affaire_id=:affaire_id";

        $this->connection->prepare($sql)->execute($row);

        return (int) $this->connection->lastInsertId();
    }
}
