<?php
namespace DB;
use \PDO;
use \PDOException;

class Database {
    public static ?PDO $instanceDb =null;

    //Configuration de la base de données 
    private const DB_HOST  = "localhost";
    private const DB_NAME = "todos_db";
    private const DB_USER = "root";

    private const DB_PASSWORD = "";

    /**
     * 
     */

    private function __construct(){

    }

    private function __clone(){}
    
    public static function getInstance( ){
        // s i l'instane est null, on la cré
        if (self::$instanceDb === null) {
            try {
                self::$instanceDb = new PDO( "mysql:host=".
                self::DB_HOST.";dbname=".self::DB_NAME.";charset=utf8mb4"
                ,self::DB_USER,
                 self::DB_PASSWORD,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // lever des exceptions quand il y a des erreurs
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // renvoyer les data sous forme de tab associatif
                ]);
            } catch (PDOException $e) {
                exit("Echec de connexion à la bdd: ". $e-> getMessage());
                // dis("Echec de connexion à la bdd : " . $e ->getMessage ())
            }
        }
        // sinon, on la renvoie directement
        return self::$instanceDb;
    }

}