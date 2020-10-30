<?php

namespace App\Controller;

use PDO;
use App\Model\Todo;

class TodoController
{
    public function list()
    {
        $todos = Todo::findAllOrderedByRank();

        // Inclut les templates nécessaires à l'affichage de la liste des tâches
        require './templates/head.php';
        require './templates/todo-list.php';
        require './templates/foot.php';
    }

    public function create()
    {
        $todo = new Todo(
            null,
            $_POST['description'],
            Todo::countAll() + 1,
            false
        );

        $todo->insert();

        // Redirige sur la liste des tâches
        header('Location: /todos');
    }

    public function update(int $id)
    {
        $todo = Todo::findById($id);

        // Si le formulaire contient une description
        if (isset($_POST['description'])) {
            // Modifie la description de l'enregistrement existant
            $todo->setDescription($_POST['description']);
        }
        
        // Si le formulaire contient un rang
        if (isset($_POST['rank'])) {
            // Modifie le rang de l'enregistrement existant
            $todo->setRank($_POST['rank']);
        }

        $todo->update();

        // Redirige sur la liste des tâches
        header('Location: /todos');
    }

    public function delete(int $id)
    {
        $todo = Todo::findById($id);

        $todo->delete();

        // Redirige sur la liste des tâches
        header('Location: /todos');
    }
}
