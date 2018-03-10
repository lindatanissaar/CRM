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

<!-- sort table -->

<script>
    $(document).ready(function () {
            $("#lostProjects").tablesorter({dateFormat: 'pt'});
        }
    );
</script>

<link href="node_modules/pizza-master/dist/css/pizza.css" media="screen, projector, print" rel="stylesheet" type="text/css" />

<script>
    $(document).ready(function () {
        $(".search").keyup(function () {
            var searchTerm = $(".search").val();
            var listItem = $('.results tbody').children('tr');
            var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

            $.extend($.expr[':'], {
                'containsi': function (elem, i, match, array) {
                    return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
                }
            });

            $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function (e) {
                $(this).attr('visible', 'false');
            });

            $(".results tbody tr:containsi('" + searchSplit + "')").each(function (e) {
                $(this).attr('visible', 'true');
            });

            var jobCount = $('.results tbody tr[visible="true"]').length;

            if (jobCount == 1) {
                $('.counter').text(jobCount + ' tulemus');

            } else {
                $('.counter').text(jobCount + ' tulemust');
            }

            if (jobCount == '0') {
                $('.no-result').show();
            }
            else {
                $('.no-result').hide();
            }
        });
    });
</script>

<div class="row">

    <div class="column-l">

        <div class="input-group">
            <input type="text" class="form-control input-md search" id="searchTasksInput" placeholder="Otsi">
        </div>
        <span class="counter"></span>
    <h3>Kaotatud tehingud</h3>

    <div class="table-responsive">

        <table class="table tablesorter results"  id="lostProjects">

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

