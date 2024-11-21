<?php

namespace App\Controllers;


use App\Models\Todo;
use DB\Database;

class TodoController
{
    private Todo $todoModel;
    public function __construct(){
        $this->todoModel = new Todo();
    }
    public function index()
    {
       $todos = $this->todoModel->getAll();
        
        // //Récupérer les tâches depuis la session
        // if (!isset($_SESSION)) {
        //     session_start(); //Récupérer la session existante
        // }

        // $todos = $_SESSION["todos"] ?? [];

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

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task = trim($_POST['task']);

            if ($task) {
                $this->todoModel->add($task);

                // $_SESSION['todos'][] = [
                //     'id' => uniqid("todo_"),
                //     'task' => $task,
                //     'done' => false
                // ];
            }

            header('Location: /');
            exit;
        }

        // Charger la vue add.php
        require dirname(__DIR__) . "/Views/add.php";
    }

    public function update()
    {
        // Vérifier si l'ID de la tâche est fourni dans la requête GET
        $id = $_GET['id'] ?? null;
        $task = $_GET['task'] ?? null;
        if ($id) {
            // Vérifier si une donnée POST a été envoyée pour mettre à jour la tâche
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Récupérer la nouvelle tâche depuis le formulaire
                $newTask = trim($_POST['task']);
                // $newDoneStatus = isset($_POST['done']) ? true : false; // Si un checkbox "done" est coché

                // Trouver la tâche et la mettre à jour
                // foreach ($_SESSION['todos'] as &$todo) {
                    if ($id) {
                        $db = Database::getInstance();
                        $stmt = $db->prepare("UPDATE todos SET task = :task AND done = :done;"); 
                        $stmt->execute([":task" => $newTask, ":done" => 0]);

                        // $todo['task'] = $newTask; // Mettre à jour la description de la tâche
                        // $todo['done'] = false; // Mettre à jour le statut de la tâche
                    }
                // }

                // Rediriger vers la page d'accueil
                header('Location: /');
                exit;
            } else {
                // Si la méthode est GET, afficher le formulaire de modification

                // Trouver la tâche à modifier
                $todoToEdit = null;
                // foreach ($_SESSION['todos'] as $todo) {
                    if ($id) {
                        // $todoToEdit = $todo;
                        // break;
                    }
                // }

                // Charger la vue pour la modification de la tâche
                if ($todoToEdit) {
                    require dirname(__DIR__) . "/Views/update.php"; // Charger le formulaire de modification
                } else {
                    // Si la tâche n'existe pas, rediriger vers la page d'accueil
                    header('Location: /');
                    exit;
                }
            }
        } else {
            // Si l'ID n'est pas fourni, rediriger vers la page d'accueil
            header('Location: /');
            exit;
        }
    }

    
    public function delete()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
           $this->todoModel->delete((int) $id);
            // $_SESSION['todos'] = array_filter($_SESSION['todos'], function ($todo) use ($id) {
            //     return $todo['id'] !== $id;
            // });
        }
        header('Location: /');
        exit;
    }

    public function toggle()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
           
            $this->todoModel->toggle((int) $id);
            // foreach ($_SESSION['todos'] as &$todo) {
            //     if ($todo['id'] === $id) {
            //         $todo['done'] = !$todo['done'];
            //     }
            // }
        }
        header('Location: /');
        exit;
    }
}
