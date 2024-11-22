<?php
namespace App\Models;

use DB\Database;

class Model{
    protected $db;

    public function __construct(){
        // Récuperer l'instance de connexion à la bdd
        $this->db = Database::getInstance();
    }
}