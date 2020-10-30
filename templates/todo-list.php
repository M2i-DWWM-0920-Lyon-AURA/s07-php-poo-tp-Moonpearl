<!-- todo-list.php -->
<h1>Ma liste de tâches</h1>
<ul id="todo-list" class="list-group mb-4">

    <?php foreach ($todos as $todo): ?>
    <li class="list-group-item">

        <form method="post" action="/todos/<?= $todo['id'] ?>/update" class="d-flex">
            <input name="description" type="text" value="<?= $todo['description'] ?>" class="form-control" />
            <button class="btn btn-success">
                <i class="fas fa-check"></i>
            </button>
        </form>

    </li>
    <?php endforeach; ?>

</ul>
<form id="add-todo" class="d-flex" method="post" action="/todos/new">
    <input id="add-todo-name" name="description" class="form-control" type="text" placeholder="Entrez une nouvelle tâche" />
    <button id="add-todo-button" class="btn btn-success">Ajouter</button>
</form>