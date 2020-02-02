<?php

namespace App\Domain\Affaire\Repository;

use App\Domain\Affaire\Data\AffaireCreateData;
use PDO;

/**
 * Repository.
 */
class AffaireCreatorRepository
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
     * Insert affaire row.
     *
     * @param AffaireCreateData $affaire The affaire
     *
     * @return int The new ID
     */
    public function insertAffaire(AffaireCreateData $affaire): int
    {
        $row = [
            'nom' => $affaire->nom,
            'adresse' => $affaire->adresse,
            'avancement' => $affaire->avancement,
            'type_reu' => $affaire->type_reu
        ];

        $sql = "INSERT INTO affaire SET 
                nom=:nom,
                adresse=:adresse,
                avancement=:avancement, 
                type_reu=:type_reu";

        $this->connection->prepare($sql)->execute($row);

        return (int) $this->connection->lastInsertId();
    }
}
