<style>

    .column-l {
        width: 60%;
        margin-right: 3%;
        vertical-align: top;
    }

    .column-r {
        width: 35%;
        display: inline-block;
        background-color: white;
        padding: 30px;
    }

</style>

<link href="node_modules/pizza-master/dist/css/pizza.css" media="screen, projector, print" rel="stylesheet" type="text/css" />



<div class="row">

    <div class="column-l">
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

</div>

    <div class="column-r">
        <ul data-pie-id="my-cool-chart3" data-options='{donut: "true", animation_speed: 200,
  animation_type: "backin"}'>
            <li data-value="36">Pole teada tehingud</li>
            <li data-value="14">Kokku</li>
        </ul>

        <div id="my-cool-chart3"></div>
    </div>

</div>


<script>

    $(function(){
        Pizza.init();
    })


</script>

