<?php

namespace App\Domain\Tocken\Repository;

use PDO;
use App\Domain\Tocken\Data\TockenData;

/**
 * Repository.
 */
class TockenUpdaterRepository
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
     * Update a Tocken.
     *
     * @param TockenData $Tocken the Tocken
     */
    public function updateTocken(TockenData $tocken)
    {
        $row = [
            'tocken' => $tocken->tocken,
            'device' => $tocken->device,
            'expiration_date' => $tocken->expirationDate,
            'user_id' => $tocken->userId
        ];

        $sql = "UPDATE tocken SET
                device=:device,
                expiration_date=:expiration_date,
                user_id=:user_id,
                WHERE tocken=:tocken";

        $statement = $this->connection->prepare($sql);
        $statement->bindValue('tocken', $tocken->tocken, PDO::PARAM_STR);
        $statement->execute($row);
    }
}
