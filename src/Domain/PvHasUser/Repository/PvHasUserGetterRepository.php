<?php

namespace App\Domain\PvHasUser\Repository;

use PDO;
use App\Domain\Pv\Data\PvGetData;
use App\Domain\PvHasUser\Data\PvHasUserData;
use App\Domain\User\Data\UserGetData;

/**
 * Repository.
 */
class PvHasUserGetterRepository
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

    public function getPvByUserId(int $userId): array
    {
        $query = "SELECT * FROM pv_has_user WHERE user_id=:id";

        $statement = $this->connection->prepare($query);
        $statement->bindValue('id', $userId, PDO::PARAM_INT);
        $statement->execute();

        $pvs = [];
        while ($row = $statement->fetch()) {
            $pvs[] = $row['pv_id'];
        }

        return (array) $pvs;
    }

    public function getPvOwner(int $pvId): UserGetData
    {
        $query = "SELECT u.*
        FROM user u
        INNER JOIN pv_has_user phu
        ON phu.user_id = u.id_user
        WHERE pv_id=:pvId AND phu.owner=1";

        $statement = $this->connection->prepare($query);
        $statement->bindValue('pvId', $pvId, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch();

        $user = new UserGetData();
        $user->id_user = (int) $row['id_user'];
        $user->email = (string) $row['email'];
        $user->firstName = (string) $row['first_name'];
        $user->lastName = (string) $row['last_name'];
        $user->phone = (string) $row['phone'];
        $user->userGroup = (string) $row['user_group'];
        $user->userFunction = (string) $row['user_function'];
        $user->organism = (string) $row['organism'];

        return $user;
    }

    public function getAllPvHasUser(int $pvId): array
    {
        $query = "SELECT * FROM pv_has_user WHERE pv_id=:pvId";
        $statement = $this->connection->prepare($query);
        $statement->bindValue('pvId', $pvId, PDO::PARAM_INT);
        $statement->execute();

        $pHUs = [];
        while ($row = $statement->fetch()) {
            $pHU = new PvHasUserData;
            $pHU->pv_id = (int) $row['pv_id'];
            $pHU->user_id = (int) $row['user_id'];
            $pHU->status_PAE = (string) $row['status_PAE'];
            $pHU->invited_current_meeting = (int) $row['invited_current_meeting'];
            $pHU->invited_next_meeting = (int) $row['invited_next_meeting'];
            $pHU->distribution = (int) $row['distribution'];
            $pHU->owner = (int) $row['owner'];

            $pHUs[] = $pHU;
        }

        return $pHUs;
    }
}
