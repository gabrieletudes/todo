<div class="container col s12 m12 l12">
<div class="section">
    <h1>Les tâches de <?= $_SESSION['user']->first_name; ?></h1>
    <?php if ($data['tasks']): ?>
        <ul class="col s12 m12 l12">
            <?php foreach ($data['tasks'] as $task): ?>
                <li class="row">
                    <div class="col s12 m12 l12">
                    <form action="index.php" method="post">
                        <p class="row">
                        <input title="Changer le statut" <?= $task->is_done == 1?'checked="checked"':'';?> type="checkbox" id="<?= $task->task_id; ?>" name="is_done" value="<?= $task->is_done?>">
                            <label for="<?= $task->task_id; ?>" class="checkbox"><span class="checkbox__label fs-base"><?= $task->description; ?></span>
                            </label>
                        </p>
                        <?php if($_GET['a']=='getUpdate' && $task->editable):?>
                            <label for="description" class="textfield">
                                <input type="text" size="40" value="<?= $task->description; ?>" name="description" title="description" id="description">
                            </label>
                        <?php endif;?>
                        <input type="hidden" name="r" value="tasks">
                        <input type="hidden" name="a" value="postUpdate">
                        <input type="hidden" name="id" value="<?= $task->task_id; ?>">
                        <button class="col s6 m3 l2 waves-effect waves-light btn" type="submit">Enregistrer</button>
                    </form>
                        <form action="index.php" method="get" class="col s6 m3 l2">
                            <button class="col s12 m12 l12 waves-effect waves-light btn" type="submit">modifier</button>
                            <input type="hidden" name="a" value="getUpdate">
                            <input type="hidden" name="r" value="tasks">
                            <input type="hidden" name="id" value="<?= $task->task_id; ?>">
                        </form>
                        <form action="index.php" method="post" class="col s6 m3 l2">
                            <button class="col s12 m12 l12 waves-effect waves-light btn" type="submit">supprimer</button>
                            <input type="hidden" name="a" value="postDelete">
                            <input type="hidden" name="r" value="tasks">
                            <input type="hidden" name="id" value="<?= $task->task_id; ?>">
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Vous n’avez pas encore créé de tâche…</p>
    <?php endif; ?>
</div>
<div class="section">
    <h1>Ajouter une tâche</h1>
    <form action="index.php"
          method="post">
        <span class="textfield__label">Description</span>
        <label for="description" class="textfield"><input type="text" name="description" id="description" size="80">
        </label>
        <input type="hidden" name="r" value="tasks">
        <input type="hidden" name="a" value="create">
        <button class="waves-effect waves-light btn" type="submit">Créer cette nouvelle tâche</button>
    </form>
</div>
</div>
