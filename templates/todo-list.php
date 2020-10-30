<!-- todo-list.php -->
<h1>Ma liste de tâches</h1>
<ul id="todo-list" class="list-group mb-4">

    <?php foreach ($todos as $todo): ?>
    <li class="list-group-item">

        <?php if($todo['done']): ?>
            <del class="text-muted">
                <?= $todo['description'] ?>
            </del>
        <?php else: ?>
            <?= $todo['description'] ?>
        <?php endif; ?>

    </li>
    <?php endforeach; ?>

</ul>
<form id="add-todo" class="d-flex">
    <input id="add-todo-name" name="" class="form-control" type="text" placeholder="Entrez une nouvelle tâche" />
    <button id="add-todo-button" class="btn btn-success">Ajouter</button>
</form>