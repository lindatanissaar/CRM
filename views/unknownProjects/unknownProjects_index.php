<style>

    .column-l {
        width: 60%;
        margin-right: 3%;
        vertical-align: top;
    }

    .column-r {
        width: 35%;
        display: inline-block;
    }

    #daterangepicker {
        background-color: #e7e7e7;
        border-color: #e7e7e7;
        text-align: center;
        border-radius: 4px;
        padding: 20px 4px 20px 4px;
        display: inline-block;
    }

    #searchWonProjectsInput {
        display: inline-block;
    }

    #bar {
        width: 75%;
        margin: auto;

    }

    #pie, #bar {
        margin-bottom: 10%;
    }

    .bar, .pie {
        background-color: white;
    }

    svg {
        padding: 60px;
    }


</style>




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

<!-- sort table -->

<script>
    $(document).ready(function () {
            $("#unknownProjects").tablesorter({dateFormat: 'pt'});
        }
    );
</script>

<div class="row">

    <div class="column-l">

        <div class="input-group">
            <input type="text" class="form-control input-md search" id="searchTasksInput" placeholder="Otsi">
        </div>
        <span class="counter"></span>


    <h3>Pole teada tehingud</h3>

    <div class="table-responsive">

        <table class="table tablesorter results"  id="unknownProjects">

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
    <div class="column-r">
        <div class="pie">
            <ul data-pie-id="pie"data-options='{animation_speed: 200,
  animation_type: "backin"}'>
                <li data-value="36">Pole teada tehingud</li>
                <li data-value="14">Kokku</li>
            </ul>
            <div id="pie"></div>
        </div>

        <div class="bar">
            <ul data-bar-id="bar">
                <li data-value="36">Pole teada tehingud</li>
                <li data-value="14">Kokku</li>
            </ul>

            <div class="large-8 small-8 columns">
                <div id="bar" style="height: 250px;"></div>
            </div>
        </div>
    </div>

</div>


<script>

    $(function(){
        Pizza.init();
    })


</script>

