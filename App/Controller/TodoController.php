<?php

namespace App\Controller;

use PDO;

class TodoController
{
    public function list()
    {
        // Crée une nouvelle interface avec la base de données
        $databaseHandler = new PDO('mysql:host=localhost;dbname=php-todos', 'root', 'root');
        // Récupère la liste des tâches à faire en base de données
        $statement = $databaseHandler->query('SELECT * FROM `todos` ORDER BY `rank`');
        $todos = $statement->fetchAll();

        // Inclut les templates nécessaires à l'affichage de la liste des tâches
        require './templates/head.php';
        require './templates/todo-list.php';
        require './templates/foot.php';
    }

    public function create()
    {
        // Crée une nouvelle interface avec la base de données
        $databaseHandler = new PDO('mysql:host=localhost;dbname=php-todos', 'root', 'root');
        // Envoie une requête permettant de compter le nombre de tâches existantes
        $statement = $databaseHandler->query('SELECT COUNT(*) FROM `todos`');
        $result = $statement->fetchAll();
        // Définit le rang de la tâche à créer comme le nombre de tâches existantes plus 1
        $rank = intval($result[0][0]) + 1;

        // Crée une requête préparée et l'exécute en lui passant les valeurs adéquates
        $statement = $databaseHandler->prepare('
            INSERT INTO `todos`
            (`description`, `done`, `rank`)
            VALUES (:description, :done, :rank)
        ');
        $statement->execute([
            ':description' => $_POST['description'],
            ':done' => false,
            ':rank' => $rank,
        ]);

        // Rediriger sur la liste des tâches
        header('Location: /todos');
    }
}
