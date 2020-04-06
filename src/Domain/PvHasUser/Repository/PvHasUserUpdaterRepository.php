<?php

namespace App\Domain\PvHasUser\Repository;

use PDO;
use App\Domain\PvHasUser\Data\PvHasUserData;
use App\Domain\PvHasUser\Data\PvHasUserCreateData;

/**
 * Repository.
 */
class PvHasUserUpdaterRepository
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
     * @param PvHasUserCreateData $lot The affaire
     *
     * @return int The new ID
     */
    public function updatePvHasUser(PvHasUserData $pvHasUser)
    {
        $row = [
            'pv_id' => $pvHasUser->pv_id,
            'user_id' => $pvHasUser->user_id,
            'status_PAE' => $pvHasUser->status_PAE
        ];

        $query = "UPDATE pv_has_user SET
                status_PAE=:status_PAE
                WHERE pv_id=:pv_id AND user_id=:user_id";

        $statement = $this->connection->prepare($query);
        $statement->bindValue('pv_id', $pvHasUser->pv_id, PDO::PARAM_INT);
        $statement->bindValue('user_id', $pvHasUser->user_id, PDO::PARAM_INT);
        $statement->execute($row);
    }
}
