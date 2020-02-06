<?php

namespace App\Domain\User\Repository;

use PDO;
use App\Domain\User\Data\UserCreateData;

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
            'phone' => $user->phone,
            'group' => $user->group,
            'user_function' => $user->user_function,
            'organism' => $user->organism
        ];

        $query = "INSERT INTO user SET
        email=:email,
        password=:pwd,
        first_name=:first_name,
        last_name=:last_name,
        phone=:phone,
        group=:group,
        user_function=:user_function,
        organism=:organism";

        $this->connection->prepare($query)->execute($row);
        return (int) $this->connection->lastInsertId();
    }
}
