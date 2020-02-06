<?php

namespace App\Domain\Affair\Repository;

use PDO;
use App\Domain\Affair\Data\AffairGetData;

/**
 * Repository.
 */
class AffairGetterRepository
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
     * Get All Affairs.
     *
     * @return array All the affairs
     */
    public function getAllAffairs(): array
    {
        $sql = "SELECT * FROM affair";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $affair = new AffairGetData();
            $affair->id_affair = (int) $row['id_affair'];
            $affair->nom = (string) $row['nom'];
            $affair->adresse = (string) $row['adresse'];
            $affair->avancement = (int) $row['avancement'];
            $affair->type_reu = (string) $row['type_reu'];

            $affairs[] = $affair;
        }
        return (array) $affairs;
    }

    public function getAffairById(int $id): AffairGetData
    {
        $sql = "SELECT * FROM affair WHERE id_affair=:id";

        $statement = $this->connection->prepare($sql);
        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch();
        $affair = new AffairGetData();
        $affair->id_affair = (int) $row['id_affair'];
        $affair->nom = (string) $row['nom'];
        $affair->adresse = (string) $row['adresse'];
        $affair->avancement = (int) $row['avancement'];
        $affair->type_reu = (string) $row['type_reu'];

        return $affair;
    }
}
