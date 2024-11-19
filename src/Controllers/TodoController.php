<?php
namespace App\Controllers;

class TodoController {
    public function index(){
        //Récupérer les tâches depuis la session
        if (!isset($_SESSION)) {
            session_start(); //Récupérer la session existante
        }

        $todos = $_SESSION["todos"] ?? [];

        // if (isset($_SESSION["todos"])) {
        //     $todos = $_SESSION["todos"];
        // }else{
        //     $todos = [];
        // }
        // echo"<pre>";
        // echo session_id();
        // print_r($todos);

        //Charger la vue "Views/index.php
        // require __DIR__ . "/../views/index.php"; // Méthode 1

        require dirname(__DIR__) . "/Views/index.php"; // Méthode 2
    }

    public function add(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task = trim($_POST['task']);

            if ($task) {
                $_SESSION['todos'][] = [
                    'id'=> uniqid("todo_"),
                    'task'=> $task,
                    'done'=>false
                ]; 
            }

            header('Location: /');
            exit;
        }

        // Charger la vue add.php
        require dirname(__DIR__) . "/Views/add.php"; 
    }

    public function delete(){
        $id = $_GET['id'] ?? null;
        if ($id) {
            $_SESSION['todos'] = array_filter($_SESSION['todos'], function($todo) use ($id){
                return $todo['id'] !== $id;
            });
        }
        header('Location: /');
        exit;
    }

    public function toggle(){
        $id = $_GET['id'] ?? null;
        if ($id) {
            foreach($_SESSION['todos'] as &$todo){
                if ($todo['id'] === $id) {
                    $todo['done'] = !$todo['done'];
                }
            }
        }
        header('Location: /');
        exit;
    }
}