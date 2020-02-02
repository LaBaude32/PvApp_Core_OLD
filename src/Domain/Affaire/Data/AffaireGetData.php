<?php

namespace App\Domain\Affaire\Data;

final class AffaireGetData
{
    /** @var int */
    public $id_affaire;
    
    /** @var string */
    public $nom;

    /** @var string */
    public $adresse;

    /** @var int */
    public $avancement;

    /** @var string */
    public $type_reu;
}
