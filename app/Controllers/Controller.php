<?php
namespace App\Controllers;

abstract class Controller {

    /**
     * Méthode pour charger unr vur
     * @param string $view
     * @param mixed $data
     * @return void
     */
    protected function view(string $view, $data = []){
        extract($data);
        require dirname(__DIR__) . "/Views/$view.php";
    }

    /**
     * Méthode pour rediriger vers une url
     * @param string $url
     * @return never
     */
    protected function redirect ( string $url){
        header("Location: ,$url");
        exit;
    }
}