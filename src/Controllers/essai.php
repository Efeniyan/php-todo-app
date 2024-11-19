<?php
namespace App\Controllers;

class TodoController {
    public function index() {
        //Recuperer les tâches depuis la session
        if (!isset($_SESSION)) {
            session_start(); 
        }

        $todos = $_SESSION["todos"] ?? [];

       

        //Charger la vue "Views/index.php"
        // require _DIR_ . "../Views/index.php";
        require dirname(__DIR__) . "/Views/index.php";
    }
    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $task = trim($_POST['task']);

            if ($task) {
                $_SESSION['todos'][]=[
                    'id' => uniqid(),
                    'task' => $task,
                    'done' => false
                ];
            }
            header('location: /');
            exit;
        }
        //Charger la vue add.php
        require dirname(__DIR__) . "/Views/add.php";
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $_SESSION['todos'] = array_filter($_SESSION['todos'], function($todo) use ($id) {
                return $todo['id'] !== $id;
            });
        }
        header('Location: /');
        exit;
    }

    public function toggle() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            foreach($_SESSION['todos'] as &$todo) {
                if($todo['id'] === $id){
                    $todo['done'] = !$todo['done'];
                }
            }
        }
        header('Location: /');
        exit;
    }}