<?php
namespace App\Controllers;

class TodoController {
    public function index(){
        //Récupérer les tâches depuis la session
        if (!isset($_SESSION)) {
            session_start(); //Récupérer la session existante
        }

        $todos = $_SESSION["todos"];
        //Charger la vue "Views/index.php
        // require __DIR__ . "/../views/index.php"; // Méthode 1
        require dirname(__DIR__) . "/views/index.php"; // Méthode 2
    }

    public function add(){

    }

    public function delete(){

    }

    public function toggle(){

    }
}