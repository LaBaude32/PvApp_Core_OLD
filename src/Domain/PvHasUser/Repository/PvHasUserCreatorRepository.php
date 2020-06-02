<?php

namespace App\Domain\PvHasUser\Repository;

use PDO;
use App\Domain\PvHasUser\Data\PvHasUserData;
use App\Domain\PvHasUser\Data\PvHasUserCreateData;

/**
 * Repository.
 */
class PvHasUserCreatorRepository
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
    public function insertPvHasUser(PvHasUserData $pvHasUser)
    {
        $row = [
            'pv_id' => $pvHasUser->pv_id,
            'user_id' => $pvHasUser->user_id,
            'status_PAE' => $pvHasUser->status_PAE,
            'owner' => $pvHasUser->owner
        ];

        $query = "INSERT INTO pv_has_user SET
                pv_id=:pv_id,
                user_id=:user_id,
                status_PAE=:status_PAE,
                owner=:owner";

        $this->connection->prepare($query)->execute($row);
    }

    public function insertPvHasUserToNewPv(array $data)
    {
        foreach ($data as $value) {
            $row = [
                'pv_id' => $value->pv_id,
                'user_id' => $value->user_id,
                'status_PAE' => $value->status_PAE,
                'invited_current_meeting' => $value->invited_current_meeting,
                'invited_next_meeting' => $value->invited_next_meeting,
                'distribution' => $value->distribution,
                'owner' => $value->owner
            ];

            $rows[] = $row;
        }

        $query = "INSERT INTO pv_has_user SET
                pv_id=:pv_id,
                user_id=:user_id,
                status_PAE=:status_PAE,
                invited_current_meeting=:invited_current_meeting,
                invited_next_meeting=:invited_next_meeting,
                distribution=:distribution,
                owner=:owner";

        $statement = $this->connection->prepare($query);

        foreach ($rows as $row) {
            $statement->execute($row);
        }
    }
}
