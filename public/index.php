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



use App\Router;
require dirname(__DIR__) . "/vendor/autoload.php";

// Démarrer la session
if (!isset($_SESSION)) {
    session_start();
}

// Créer une instance du router;
$router = new Router();

$router->get("/", function(){});
$router->get("/add", function () {});
$router->post("/add", function () {});
$router->get("/toggle", function () {});
$router->get("/delete", function () {});

var_dump($router);

