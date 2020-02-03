<?php

namespace App\Domain\Affaire\Repository;

use PDO;
use App\Domain\Affaire\Data\AffaireGetData;

/**
 * Repository.
 */
class AffaireGetterRepository
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
     * Get All Affaires.
     *
     * @return array All the affaires
     */
    public function getAllAffaires(): array
    {
        $sql = "SELECT * FROM affaire";

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        while ($row = $statement->fetch()) {
            $affaire = new AffaireGetData();
            $affaire->id_affaire = (int) $row['id_affaire'];
            $affaire->nom = (string) $row['nom'];
            $affaire->adresse = (string) $row['adresse'];
            $affaire->avancement = (int) $row['avancement'];
            $affaire->type_reu = (string) $row['type_reu'];

            $affaires[] = $affaire;
        }
        return (array) $affaires;
    }

    public function getAffaireById(int $id): AffaireGetData
    {
        $sql = "SELECT * FROM affaire WHERE id_affaire=:id";

        $statement = $this->connection->prepare($sql);
        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->execute();

        $row = $statement->fetch();
        $affaire = new AffaireGetData();
        $affaire->id_affaire = (int) $row['id_affaire'];
        $affaire->nom = (string) $row['nom'];
        $affaire->adresse = (string) $row['adresse'];
        $affaire->avancement = (int) $row['avancement'];
        $affaire->type_reu = (string) $row['type_reu'];

        return $affaire;
    }
}
