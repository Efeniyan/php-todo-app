<?php
namespace App\Models;

use DB\Database;

abstract class Model{
    protected $db;

    public function __construct(){
        // Récuperer l'instance de connexion à la bdd
        $this->db = Database::getInstance();
    }
}