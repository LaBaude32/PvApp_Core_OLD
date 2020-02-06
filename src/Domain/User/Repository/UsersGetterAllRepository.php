<?php

namespace App\Domain\User\Repository;

use App\Domain\User\Data\UserGetData;
use PDO;

/**
 * Repository.
 */
class UsersGetterAllRepository
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
     * Get All Users.
     *
     * @return array All the users
     */
    public function getAllUsers(): array
    {
        $sql = "SELECT * FROM user";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $user = new UserGetData();
            $user->id_user = (int) $row['id_user'];
            $user->email = (string) $row['email'];
            $user->firstName = (string) $row['first_name'];
            $user->lastName = (string) $row['last_name'];
            $user->phone = (string) $row['phone'];
            $user->group = (string) $row['group'];
            $user->function = (string) $row['function'];
            $user->organism = (string) $row['organism'];

            $users[] = $user;
        }
        return (array) $users;
    }
}
