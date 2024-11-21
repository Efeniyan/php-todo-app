<?php

namespace DB;

use Dotenv\Dotenv;
use \PDO;
use \PDOException;

class Database
{
    public static ?PDO $instanceDb = null;



    /**
     * 
     */

    private function __construct() {}

    private function __clone() {}

    public static function getInstance()
    {

        $dotenv = Dotenv::createImmutable(dirname(__DIR__));
        $dotenv->load();
        //Configuration de la base de données 
        $dbHost = $_ENV["DB_HOST"];
        $dbName = $_ENV["DB_NAME"];
        $dbUser = $_ENV["DB_USER"];
        $dbPassword = $_ENV["DB_PASSWORD"];
        $dbcharset = $_ENV["DB_CHARSET"];

        // s i l'instane est null, on la cré
        if (self::$instanceDb === null) {
            try {
                self::$instanceDb = new PDO(
                    "mysql:host=" .
                        $dbHost . ";dbname=" . $dbName . ";charset=". $dbcharset ,
                    $dbUser,
                    $dbPassword,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // lever des exceptions quand il y a des erreurs
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // renvoyer les data sous forme de tab associatif
                    ]
                );
            } catch (PDOException $e) {
                exit("Echec de connexion à la bdd: " . $e->getMessage());
                // dis("Echec de connexion à la bdd : " . $e ->getMessage ())
            }
        }
        // sinon, on la renvoie directement
        return self::$instanceDb;
    }
}
