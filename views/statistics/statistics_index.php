<div class="row">

    <h3>Võidetud tehingud</h3>

    <div class="table-responsive">

        <table class="table tablesorter results"  id="transactionsTable">

            <thead  class="header" id="tableHeader">
            <tr title="Sorteeri tabelit veergude järgi">
                <th>Ettevõtte nimetus</th>
                <th>Tehingu nimetus</th>
                <th class="price">Väärtus</th>
                <th>Märkus</th>
            </tr>

            <tr class="warning no-result">
                <td colspan="1"><i class="fa fa-warning"></i>Tulemused puuduvad</td>
            </thead>

            <tbody>

            <?php foreach ($transactions as $transaction): ?>
                <tr id="<?= $transaction['ID'] ?>">
                    <td class="organisation_name" contenteditable><?= $transaction['ORGANISATION_NAME'] ?></td>
                    <td class="transaction_name" contenteditable><?= $transaction['NAME'] ?></td>
                    <td class="price" contenteditable><?= round($transaction['PRICE'], 2) . " €" ?></td>
                    <td class="note" contenteditable><?= $transaction['NOTE'] ?></td>
                </tr>
            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

        <h3>Kaotatud tehingud</h3>

        <div class="table-responsive">

            <table class="table tablesorter results"  id="transactionsTable">

                <thead  class="header" id="tableHeader">
                <tr title="Sorteeri tabelit veergude järgi">
                    <th>Ettevõtte nimetus</th>
                    <th>Tehingu nimetus</th>
                    <th class="price">Väärtus</th>
                    <th>Märkus</th>
                </tr>

                <tr class="warning no-result">
                    <td colspan="1"><i class="fa fa-warning"></i>Tulemused puuduvad</td>
                </thead>

                <tbody>

                <?php foreach ($transactions_lost as $transaction): ?>
                    <tr id="<?= $transaction['ID'] ?>">
                        <td class="organisation_name" contenteditable><?= $transaction['ORGANISATION_NAME'] ?></td>
                        <td class="transaction_name" contenteditable><?= $transaction['NAME'] ?></td>
                        <td class="price" contenteditable><?= round($transaction['PRICE'], 2) . " €" ?></td>
                        <td class="note" contenteditable><?= $transaction['NOTE'] ?></td>
                    </tr>
                <?php endforeach; ?>

                </tbody>

            </table>
        </div>

    <h3>Pole teada tehingud</h3>

    <div class="table-responsive">

        <table class="table tablesorter results"  id="transactionsTable">

            <thead  class="header" id="tableHeader">
            <tr title="Sorteeri tabelit veergude järgi">
                <th>Ettevõtte nimetus</th>
                <th>Tehingu nimetus</th>
                <th class="price">Väärtus</th>
                <th>Märkus</th>
            </tr>

            <tr class="warning no-result">
                <td colspan="1"><i class="fa fa-warning"></i>Tulemused puuduvad</td>
            </thead>

            <tbody>

            <?php foreach ($transactions_unknown as $transaction): ?>
                <tr id="<?= $transaction['ID'] ?>">
                    <td class="organisation_name" contenteditable><?= $transaction['ORGANISATION_NAME'] ?></td>
                    <td class="transaction_name" contenteditable><?= $transaction['NAME'] ?></td>
                    <td class="price" contenteditable><?= round($transaction['PRICE'], 2) . " €" ?></td>
                    <td class="note" contenteditable><?= $transaction['NOTE'] ?></td>
                </tr>
            <?php endforeach; ?>

            </tbody>

        </table>
    </div>
</div>