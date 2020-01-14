<?php

namespace App\Database;

use PDO;
use Psr\Container\ContainerInterface;

class Database
{
    protected $pdo;
    protected $container;

    public function __construct(PDO $pdo, ContainerInterface $container)
    {
        $this->pdo = $pdo;
        $this->container = $container;
    }

    public function query($sql)
    {
        $req = $this->container->get('pdo')->prepare($sql);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
        // $json = json_encode($users);
    }
}
