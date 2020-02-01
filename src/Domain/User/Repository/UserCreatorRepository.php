<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserCreateData;
use PDO;

/**
 * Repository.
 */
class UserCreatorRepository
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
     * Insert user row.
     *
     * @param UserCreateData $user The user
     *
     * @return int The new ID
     */
    public function insertUser(UserCreateData $user): int
    {
        $row = [
            'email' => $user->email,
            'pwd' => $user->pwd,
            'first_name' => $user->firstName,
            'last_name' => $user->lastName,
            'email' => $user->email,
            'telephone' => $user->telephone,
            'groupe' => $user->groupe,
            'fonction' => $user->fonction,
            'organisme' => $user->organisme
        ];

        $sql = "INSERT INTO personne SET 
                email=:email,
                password=:pwd,
                first_name=:first_name, 
                last_name=:last_name,
                telephone=:telephone,
                groupe=:groupe,
                fonction=:fonction, 
                organisme=:organisme";

        $this->connection->prepare($sql)->execute($row);

        return (int) $this->connection->lastInsertId();
    }
}
