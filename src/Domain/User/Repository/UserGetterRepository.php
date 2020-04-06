<?php

namespace App\Domain\User\Repository;

use PDO;
use App\Domain\User\Data\UserGetData;
use App\Domain\User\Data\UserStatusGetData;

/**
 * Repository.
 */
class UserGetterRepository
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
            $user->userGroup = (string) $row['user_group'];
            $user->function = (string) $row['function'];
            $user->organism = (string) $row['organism'];

            $users[] = $user;
        }
        return (array) $users;
    }

    /**
     * getUserById
     *
     * @param int $id_user
     *
     * @return UserGetData
     */
    public function getUserById(int $id_user): UserGetData
    {
        $query = "SELECT * FROM user WHERE id_user=:id_user";

        $statement = $this->connection->prepare($query);
        $statement->bindValue('id_user', $id_user, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch();
        $user = new UserGetData();
        $user->id_user = (int) $row['id_user'];
        $user->email = (string) $row['email'];
        $user->pwd = (string) $row['password'];
        $user->firstName = (string) $row['first_name'];
        $user->lastName = (string) $row['last_name'];
        $user->phone = (string) $row['phone'];
        $user->userGroup = (string) $row['user_group'];
        $user->function = (string) $row['function'];
        $user->organism = (string) $row['organism'];

        return $user;
    }

    public function getUserByEmail(string $email): UserGetData
    {
        $query = "SELECT * FROM user WHERE email=:email";

        $statement = $this->connection->prepare($query);
        $statement->bindValue('email', $email, PDO::PARAM_STR);
        $statement->execute();

        $row = $statement->fetch();
        $user = new UserGetData();
        $user->id_user = (int) $row['id_user'];
        $user->email = (string) $row['email'];
        $user->pwd = (string) $row['password'];
        $user->firstName = (string) $row['first_name'];
        $user->lastName = (string) $row['last_name'];
        $user->phone = (string) $row['phone'];
        $user->userGroup = (string) $row['user_group'];
        $user->function = (string) $row['function'];
        $user->organism = (string) $row['organism'];

        return $user;
    }

    public function getUsersByPvId(int $pv_id): array
    {
        $query = "SELECT u.*, phu.status_PAE
        FROM user u
        INNER JOIN pv_has_user phu
        ON phu.user_id = u.id_user
        WHERE phu.pv_id =:pv_id";

        $statement = $this->connection->prepare($query);
        $statement->bindValue('pv_id', $pv_id, PDO::PARAM_INT);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $user = new UserStatusGetData();
            $user->id_user = (int) $row['id_user'];
            $user->email = (string) $row['email'];
            $user->firstName = (string) $row['first_name'];
            $user->lastName = (string) $row['last_name'];
            $user->phone = (string) $row['phone'];
            $user->userGroup = (string) $row['user_group'];
            $user->function = (string) $row['function'];
            $user->organism = (string) $row['organism'];
            $user->status_PAE = (string) $row['status_PAE'];

            $users[] = $user;
        }
        return (array) $users;
    }
}
