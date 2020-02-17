<?php

namespace App\Domain\Tocken\Repository;

use PDO;
use App\Domain\Tocken\Data\TockenData;

/**
 * Repository.
 */
class TockenCreatorRepository
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
     * Insert Tocken row.
     *
     * @param TockenData $tocken The affaire
     *
     * @return int The new ID
     */
    public function createTocken(TockenData $tocken): int
    {
        $row = [
            'tocken' => (string) $tocken->tocken, //TODO: générer automatiquement un tocken
            'device' => (string) $tocken->device,
            'expiration_date' => (string) $tocken->expiration_date,
            'user_id' => (int) $tocken->userId
        ];

        $sql = "INSERT INTO tocken SET
                tocken=:tocken,
                device=:device,
                expiration_date=:expiration_date,
                user_id=:user_id";

        $this->connection->prepare($sql)->execute($row);

        return (int) $this->connection->lastInsertId();
    }
}
