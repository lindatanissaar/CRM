<style>

    table {
        background: #f7f6f6;
        width: 100%;
    }

    table th, table td {
        width: 20%;
        height: 50px;
        text-align: center;
    }

    table {
        border-collapse: collapse;
    }

    .row {
        margin-top: 30px;
    }


    #displayTunnel, #displayTable {
        margin-left: 20px;
    }

    .container {
        width: 100% !important;
    }

    .salesfunnel tr td {
        width: 80px;
        height: 70px;
    }

    .dragDiv {
        text-align: center;
        background-color: white;
        height: 100%;
        vertical-align: middle;
        position: relative;
        width: 100%;
    }

    p {
        display: inline-block;
    }

    .date {
        text-align: right
    }

    .price {
        text-align: left;
    }

</style>



<div class="row">

    <div class="column-left">
        <a href="salesfunnel"><img src="assets/img/icon-tunnel.png" id="displayTunnel" /></a>
        <a href="projects"><img src="assets/img/icon-table.png" id="displayTable" /></a>
    </div>
</div>

<div class="row">
    <table class="salesfunnel">
        <tr>
            <th>PÄRING</th>
            <th>TÖÖS</th>
            <th>KOOLITUS</th>
            <th>ÜLE ANTUD</th>
            <th>ABI</th>
        </tr>

        <?php foreach ($transactions1 as $transaction1): ?>

            <tr>

                <td class="dragTd" id="1">
                    <div class="dragDiv" id="<?= $transaction1['ID'] ?>">
                        <h4><?= $transaction1['NAME'] ?></h4>
                        <p class="price"><?= round($transaction1['PRICE'], 2) . " €" ?></p>
                        <p class="date"><?= date("d/m/Y", strtotime($transaction1['DEADLINE_DATE'])) ?></p>
                    </div>
                </td>
                <td class="dragTd" id="3"></td>
                <td class="dragTd" id="4"></td>
                <td class="dragTd" id="5"></td>
                <td class="dragTd" id="5"></td>

            </tr>
                <?php endforeach; ?>
                <?php foreach ($transactions1 as $transaction1): ?>
                    <tr>
                        <td class="dragTd" id="5"></td>


                        <td class="dragTd" id="1">
                        <div class="dragDiv" id="<?= $transaction1['ID'] ?>">
                            <h4><?= $transaction1['NAME'] ?></h4>
                            <p class="price"><?= round($transaction1['PRICE'], 2) . " €" ?></p>
                            <p class="date"><?= date("d/m/Y", strtotime($transaction1['DEADLINE_DATE'])) ?></p>
                        </div>
                    </td>

                        <td class="dragTd" id="3"></td>
                        <td class="dragTd" id="4"></td>
                        <td class="dragTd" id="5"></td>
                    </tr>
                <?php endforeach; ?>

        <?php foreach ($transactions1 as $transaction1): ?>
            <tr>
                <td class="dragTd" id="5"></td>
                <td class="dragTd" id="3"></td>



                <td class="dragTd" id="1">
                    <div class="dragDiv" id="<?= $transaction1['ID'] ?>">
                        <h4><?= $transaction1['NAME'] ?></h4>
                        <p class="price"><?= round($transaction1['PRICE'], 2) . " €" ?></p>
                        <p class="date"><?= date("d/m/Y", strtotime($transaction1['DEADLINE_DATE'])) ?></p>
                    </div>
                </td>

                <td class="dragTd" id="4"></td>
                <td class="dragTd" id="5"></td>
            </tr>
        <?php endforeach; ?>

        <?php foreach ($transactions1 as $transaction1): ?>
            <tr>
                <td class="dragTd" id="5"></td>

                <td class="dragTd" id="3"></td>
                <td class="dragTd" id="4"></td>

                <td class="dragTd" id="1">
                    <div class="dragDiv" id="<?= $transaction1['ID'] ?>">
                        <h4><?= $transaction1['NAME'] ?></h4>
                        <p class="price"><?= round($transaction1['PRICE'], 2) . " €" ?></p>
                        <p class="date"><?= date("d/m/Y", strtotime($transaction1['DEADLINE_DATE'])) ?></p>
                    </div>
                </td>

                <td class="dragTd" id="5"></td>
            </tr>
        <?php endforeach; ?>

        <?php foreach ($transactions1 as $transaction1): ?>
            <tr>
                <td class="dragTd" id="5"></td>
                <td class="dragTd" id="3"></td>
                <td class="dragTd" id="4"></td>
                <td class="dragTd" id="5"></td>

                <td class="dragTd" id="1">
                    <div class="dragDiv" id="<?= $transaction1['ID'] ?>">
                        <h4><?= $transaction1['NAME'] ?></h4>
                        <p class="price"><?= round($transaction1['PRICE'], 2) . " €" ?></p>
                        <p class="date"><?= date("d/m/Y", strtotime($transaction1['DEADLINE_DATE'])) ?></p>
                    </div>
                </td>


            </tr>
        <?php endforeach; ?>
    </table>

</div>





<script>

    $(function() {
        $(".dragDiv").draggable({
            revert: 'invalid'
        });
        $(".salesfunnel tr td").droppable({
            accept: function() {
                var $this = $(this);
                if(($this.data("parent-id") == $this.parent().attr("id")) && $(this).find("*").length == 0)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            },
            drop: function(event, ui) {

                var $this = $(this);
                $this.append(ui.draggable.css({
                    top: 0,
                    left: 0
                }));
                ui.draggable.position({
                    my: "center",
                    at: "center",
                    of: $this,
                    using: function(pos) {
                        $(this).animate(pos, "slow", "linear", function() {

                        });
                    }
                });
            }
        });
    });

</script>




