<?php


namespace App\Models;

class Todo extends Model
{
    /**
     * Récupère toutes les tâches dans la BDD
     * 
     * @param  string $task
     */
    public function getAll()
    {
        

        //Récupérer les tâches depuis la bdd
        $query = $this->db->query("SELECT * FROM todos;");
        return $query->fetchAll(); // retourne le resultat de l'exécution de la requête

    }
    public function add(string $task)
    {
        
        // préparer la requête sql pou insérer une new tâche dans la table "todos" 
        // Les placeholders 'task' et 'done' sont utilisés pour éviter les injections SQL 
        // Cela sécurise les données entrez par le user
        $stmt = $this->db->prepare("INSERT INTO todos (task, done) VALUES (:task, :done);");
        // exécution de la rêquete 
        // - ':task' contient la sdescription de la tâche saisie par le user
        // - ':done ' est initialisé à 0 pour indiquer que la tâche n'est pas terminée
        $stmt->execute([":task" => $task, ":done" => 0]);
    }

    public function create() {}

    public function update() {}

    /**
     * Summary of toggle
     * change le status d'une tâche 
     * @param int $id
     * @return void
     */
    public function toggle(int $id) {

        
        $stmt = $this->db->prepare("UPDATE todos SET done = NOT done Where id = :id");
        $stmt->execute(["id" => (int) $id]); 
              
    }

    /**
     * 
     * @param int $id L'identifiant
     * @return void
     */
    public function delete(int $id) {
        
        $stmt = $this->db->prepare("DELETE FROM todos WHERE id = :id;");
        $stmt->execute(["id" => (int) $id]);
    }
}
