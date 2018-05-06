<script>

    $(document).ready(function () {
        $(".status").each(function () {
            if ($(this).text() == "STATUS_WON") {
                $(this).removeClass("status_won");
                $(this).removeClass("status_lost");
                $(this).removeClass("status_unknown");
                $(this).addClass("status_won");
            }

            if ($(this).text() == "STATUS_LOST") {
                $(this).removeClass("status_won");
                $(this).removeClass("status_lost");
                $(this).removeClass("status_unknown");
                $(this).addClass("status_lost");
            }

            if ($(this).text() == "STATUS_UNKNOWN") {
                $(this).removeClass("status_won");
                $(this).removeClass("status_lost");
                $(this).removeClass("status_unknown");
                $(this).addClass("status_unknown");
            }
        });
    });

</script>


<div class="row">

    <div class="table-responsive">
        <div class="input-group">
            <input type="text" class="form-control input-md search" id="searchTransactionInput" placeholder="Otsi">
        </div>
        <span class="counter"></span>

        <div class="pageLimit">
            <div class="form-group pglmt">
                <label id="pglmtLabel" for="pglmtTransaction">Näita: </label>
                <input id="pglmtTransaction" title="Ridade arv" value="5" class="form-control input-sm">
                <div class="paginationResults"></div>
            </div>
        </div>

        <table class="table tablesorter results table-fixed" id="transactionsTable">

            <thead class="header" id="tableHeader">
            <tr title="Sorteeri tabelit veergude järgi">
                <th class="transactionName">Nimetus</th>
                <th class="price">Väärtus</th>
                <th class="organisationName">Ettevõte</th>
                <th class="contactPersonName">Kontaktisik</th>
                <th class="email">E-mail</th>
                <th class="phone">Telefon</th>
                <th class="date">Tähtaeg</th>
                <th class="status">Staatus</th>
                <th class="note">Märkused</th>
            </tr>

            <tr class="warning no-result">
                <td colspan="1"><i class="fa fa-warning"></i>Tulemused puuduvad</td>
            </thead>

            <tbody>

            <?php foreach ($transactions as $transaction): ?>
                <tr id="<?= $transaction['ID'] ?>">
                    <td class="transactionName" contenteditable><?= $transaction['NAME'] ?></td>
                    <td class="price" contenteditable><?= round($transaction['PRICE'], 2) . " €" ?></td>
                    <td class="organisationName" contenteditable><?= $transaction['ORGANISATION_NAME'] ?></td>
                    <td class="contactPersonName" contenteditable><?= $transaction['CONTACT_PERSON_NAME'] ?></td>
                    <td class="email" contenteditable><?= $transaction['EMAIL'] ?></td>
                    <td class="phone" contenteditable><?= $transaction['PHONE'] ?></td>
                    <td class="date"
                        contenteditable><?= date("d/m/Y", strtotime($transaction['DEADLINE_DATE'])) ?></td>
                    <td class="status" contenteditable><span><?= $transaction['STATUS'] ?></span></td>
                    <td class="note" contenteditable><?= $transaction['NOTE'] ?></td>
                    <td class="editAndDeleteTable">
                        <a title="Tehingu hulgimuutmine" class="editTableRow"><img src="assets/img/icon-edit.png"/></a>
                        <a title="Kogu tehingu kustutamine" class="deleteTableRow"><img
                                    src="assets/img/icon-delete.png"/></a>
                    </td>
                </tr>
            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>

