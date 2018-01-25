<div class="row">

    <h1>Tasks</h1>

    <div class="table-responsive">

        <table class="table table-striped table-bordered clickable-rows">

            <thead>

            <tr>
                <th>ID</th>
                <th><?= __('Task Name') ?></th>
            </tr>

            </thead>

            <tbody>

            <?php foreach ($tasks as $task): ?>
                <tr data-href="tasks/<?= $task['task_id'] ?>">
                    <td><?= $task['task_id'] ?></td>
                    <td><?= $task['task_name'] ?></td>
                </tr>
            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>
