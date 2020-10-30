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
}
