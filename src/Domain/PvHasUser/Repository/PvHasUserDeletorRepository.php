<?php

namespace App\Domain\PvHasUser\Repository;

use PDO;
use App\Domain\PvHasUser\Data\PvHasUserData;
use App\Domain\PvHasUser\Data\PvHasUserCreateData;

/**
 * Repository.
 */
class PvHasUserDeletorRepository
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
    public function deletePvHasUser(array $data)
    {
        $row = [
            'pv_id' => $data['pv_id'],
            'user_id' => $data['user_id']
        ];

        $query = "DELETE FROM pv_has_user WHERE pv_id=:pv_id AND user_id=:user_id";


        $this->connection->prepare($query)->execute($row);
    }
}
