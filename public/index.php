<?php
// echo "Hello World !";

//Autoloader
//    function monAutoloader($class){
//         require "../src/$class.php";
//     } 

// echo "<pre>";

// //Enregistrer l'Autoloader
// // spl_autoload_register("monAutoloader");

// require "../database/Product.php";
// require "../src/Person.php";
// require "../src/Product.php";
// require "../src/Highfive/Person.php";
// require "../src/Highfive/Product.php";


// $person = new App\Person();
// $person->sayHello();

// $product = new App\Product();
// $product->describe();

// $person = new App\Highfive\Person();
// $person->sayHello();

// $product = new App\Product();
// $product->describe();

// $database = new Database\Product();

// require "../src/views/layout.php";



use App\Controllers\TodoController;
use App\Router;
require dirname(__DIR__) . "/vendor/autoload.php";

// Démarrer la session
if (!isset($_SESSION)) {
    session_start();
}

// Créer une instance du router;
$router = new Router();

// Créer une instance du controlleur
$todoController = new TodoController;

// Définirles routes de l'application
$router->get("/", [$todoController, 'index']);
$router->get("/add", [$todoController, 'add']);
$router->post("/add", [$todoController, 'add']);
$router->get("/toggle", [$todoController, 'toggle']);
$router->get("/delete", [$todoController, 'delete']);

// Résoudre la route  corrrespondante
$router->resolve();

