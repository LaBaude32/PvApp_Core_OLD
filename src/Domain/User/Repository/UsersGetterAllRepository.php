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
        $sql = "SELECT * FROM personne";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $user = new UserGetData();
            $user->personne_id = (int) $row['id_personne'];
            $user->email = (string) $row['email'];
            $user->firstName = (string) $row['first_name'];
            $user->lastName = (string) $row['last_name'];
            $user->telephone = (string) $row['telephone'];
            $user->groupe= (string) $row['groupe'];
            $user->fonction = (string) $row['fonction'];
            $user->organisme = (string) $row['organisme'];

            $users[] = $user;
        }
        return (array) $users;
    }
}
