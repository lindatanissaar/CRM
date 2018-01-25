<div class="row">

    <h1>Statistics</h1>

    <div class="table-responsive">

        <table class="table table-striped table-bordered clickable-rows">

            <thead>

            <tr>
                <th>ID</th>
                <th><?= __('Statistic Name') ?></th>
            </tr>

            </thead>

            <tbody>

            <?php foreach ($statistics as $statistic): ?>
                <tr data-href="statistics/<?= $statistic['statistic_id'] ?>">
                    <td><?= $statistic['statistic_id'] ?></td>
                    <td><?= $statistic['statistic_name'] ?></td>
                </tr>
            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>
