<?php

namespace App\Controllers;


use App\Models\Todo;
use DB\Database;

class TodoController extends Controller
{
    private Todo $todoModel;
    public function __construct()
    {
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


        $this->View("index", ["tods" => $todos]); // Méthode 2
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

            $this->redirect('/');
        }

        // Charger la vue add.php
        $this->View("index");
    }

    public function update()
    {
        // Vérifier si l'ID de la tâche est fourni dans la requête GET ou POST
        $id = $_GET['id'] ?? $_POST['id'] ?? null; // Ajouter $_POST['id'] pour récupérer l'ID envoyé via POST

        if ($id) {
            // Trouver la tâche à modifier en récupérant l'élément avec cet ID
            $todoToEdit = $this->todoModel->getById((int)$id);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Récupérer la nouvelle tâche depuis le formulaire
                $newTask = trim($_POST['task']);

                if ($newTask && $id) {
                    // Mettre à jour la tâche avec le nouvel intitulé
                    $this->todoModel->update((int)$id, $newTask);

                    // Rediriger vers la page d'accueil après la mise à jour
                    $this->redirect('/');
                } else {
                    $this->redirect('/update?id=' . $id);  // Redirige vers le formulaire avec l'ID de la tâche
                }
            }

            // Si la méthode est GET, on affiche le formulaire de modification avec les données actuelles
            if ($todoToEdit) {
                $this->View("update", ["todoEdit" => $todoToEdit]);  // Passer la tâche sous la clé "todoEdit"
            } else {
                // Si la tâche n'existe pas, rediriger vers la page d'accueil
                $this->redirect('/');
            }
        } else {
            // Si l'ID n'est pas fourni, rediriger vers la page d'accueil
            $this->redirect('/');
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
        $this->redirect('/');
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
        $this->redirect('/');
    }
}
