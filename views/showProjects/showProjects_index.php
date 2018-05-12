<style>

    .content {
        width: 100%;
    }

    .status_won span {
        background-color: #38B87C;
        padding: 5px 10px 5px 10px;
        border-radius: 4px;
        color: white;
    }

    /* pagination */
    .pagination {
        display: inline-block;
        margin: 0;
    }

    .pagination a {
        color: black;
        float: left;
        padding: 3px 9px;
        text-decoration: none;
    }

    .pagination a.active {
        background-color: #38B87C;
        color: white;
    }

    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }

    #btnApplyPagination {
        background-color: #dc4d5d;
        border-color: #dc4d5d;
    }

    #pg_transactionsTable {
        float: right;
    }

    .form-group {
        display: inline-block;
    }

    #pglmtTransaction {
        width: 20%;
        text-align: center;
    }

    #pglmtLabel, #pglmtTransaction {
        display: inline-block;
    }

    .pglmt {
        text-align: center;
    }

    .pageLimit {
        float: right;
    }

    /*  drag and dop rows*/

    tbody:hover {
        cursor: all-scroll;
    }

    .status {
        width: 15%;
    }

    /*  Modal */

    .modal-footer-white {
        background-color: white;
    }

</style>

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

<div class="content">
    <div class="row">

        <div class="column-left">

            <button type="button" id="updateShowProjectsTable" class="btn btn-success" data-focus="false" data-toggle="modal"
                    data-keyboard="true">Salvesta
            </button>
        </div>

    </div>


<div class="row">

    <div class="table-responsive">
        <div class="input-group">
            <input type="text" class="form-control input-md search" id="searchTransactionInput" placeholder="Otsi">
        </div>
        <span class="counter"></span>

        <div class="pageLimit">
            <div class="form-group pglmt">
                <div class="paginationResults"></div>
            </div>
        </div>

        <table class="table tablesorter results table-fixed" id="transactionsTable">

            <thead class="header" id="tableHeader">
            <tr title="Sorteeri tabelit veergude järgi">
                <th class="transactionName">Nimetus</th>
                <th class="price">Väärtus</th>
                <th class="date">Tähtaeg</th>
                <th class="status">Staatus</th>
                <th class="completed">Lõpetatud</th>
                <th class="deleted">Kustutatud</th>
            </tr>

            <tr class="warning no-result">
                <td colspan="1"><i class="fa fa-warning"></i>Tulemused puuduvad</td>
            </thead>

            <tbody>

            <?php foreach ($transactions as $transaction): ?>
                <tr id="<?= $transaction['ID'] ?>">
                    <td class="transactionName" contenteditable><?= $transaction['NAME'] ?></td>
                    <td class="price" contenteditable><?= round($transaction['PRICE'], 2) . " €" ?></td>
                    <td class="date"
                        contenteditable><?= date("d/m/Y", strtotime($transaction['DEADLINE_DATE'])) ?></td>
                    <td class="status" contenteditable><span><?= $transaction['STATUS'] ?></span></td>
                    <td class="completed"><span><?= $transaction['COMPLETED'] == 1 ? "Jah" : "Ei" ?></span></td>
                    <td class="completed"><span><?= $transaction['DEL_DATETIME_TRANSACTION'] == NULL ? "Ei" : "Jah" ?></span></td>
                    <td class="editAndDeleteTable">
                        <a title="Märgi tehing lõpetatuks" class="transactionCompletedIcon"><img src="assets/img/icon-completed.png"/></a>
                        <a title="Märgi tehing MITTE lõpetatuks" class="transactionNotCompleted"><img src="assets/img/icon-completed.png"/></a>
                        <a title="Taasta tehing" class="transactionRestoreIcon"><img src="assets/img/icon-restore.png"/></a>

                        <a title="Kogu tehingu LÕPLIK kustutamine" class="deleteTableRow"><img
                                    src="assets/img/icon-delete.png"/></a>
                    </td>
                </tr>
            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>
</div>

<!-- Table sort default by date -->

<script>
    $(document).ready(function () {

        var i = $("td.date").index();

        $("#transactionsTable").tablesorter({
            dateFormat: 'pt',
            sortList: [[i, 0]]
        });
    })

</script>


<script>

    $(".deleteTableRow").click(function () {
        var transaction_id = $(this).parent().parent().attr('id');

        // make $.post query
        $.post("showProjects/deleteTableRow", {
            transaction_id: transaction_id
        }).done(function (data) {
            if (data == "success") {
                $('#deleteTransactionSuccess').modal('show');
                location.reload();


            } else if (data == "notEmpty") {
                $('#deleteTransactionErrorNotEmpty').modal('show');

            }
        });
    });

</script>

<!-- deleted transaction success -->

<div class="modal fade" tabindex="-1" role="dialog" id="deleteTransactionSuccess" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body modal-body-delete-success">
                <h3>Kustutatud</h3>
                <h4>Tehing on kustutatud.</h4>
            </div>
        </div>
    </div>
</div>


<!--  deleted transaction error -->
<div id="deleteTransactionError" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">VIGA KUSTUTAMISEL</h4>
            </div>
            <div class="modal-body">
                <p>Tehingu kustutamisel esines viga. Proovi uuesti kustutada</p>
            </div>
            <div class="modal-footer modal-footer-white">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Sulge</button>
            </div>
        </div>
    </div>
</div>

<!-- delete transaction error not empty -->

<div id="deleteTransactionErrorNotEmpty" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">VIGA KUSTUTAMISEL</h4>
            </div>
            <div class="modal-body">
                <p>Tehingut ei saa kustutada. Tehing on seotud tegevusega.</p>
            </div>
            <div class="modal-footer modal-footer-white">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Sulge</button>
            </div>
        </div>
    </div>
</div>

<!-- edit table data -->

<script>

    $(function () {
        var transactionName = {};
        var price = {};
        var date = {};
        var status = {};


        $('.transactionName').each(function () {
            $(this).blur(function () {
                transactionName[$(this).parent().attr("id")] = $(this).text();
                $("#updateShowProjectsTable").addClass("opacitySaveButton");
            })
        })

        $('.price').each(function () {
            $(this).blur(function () {
                price[$(this).parent().attr("id")] = $(this).text();
                $("#updateShowProjectsTable").addClass("opacitySaveButton");
            })
        })

        $('.date').each(function () {
            $(this).blur(function () {
                date[$(this).parent().attr("id")] = $(this).text();
                $("#updateShowProjectsTable").addClass("opacitySaveButton");
            })
        });

        $('.status').each(function () {
            $(this).blur(function () {
                status[$(this).parent().attr("id")] = $(this).text();
                $("#updateShowProjectsTable").addClass("opacitySaveButton");
            })
        });

        $('#updateShowProjectsTable').click(function () {

            transactionName = JSON.stringify(transactionName);
            price = JSON.stringify(price);
            date = JSON.stringify(date);
            status = JSON.stringify(status);

            // make $.post query
            $.post("showProjects/updateTransactionTable", {
                data: {transactionName: transactionName,
                    price: price,
                    date: date,
                    status: status
                }
            }).done(function (data) {
                if (data == "success") {
                    location.reload();
                    $('#deleteTransactionSuccess').modal('show');

                } else {
                    console.log("pole korras");

                }
            });
        });
    })


</script>

<!-- mark transaction completed -->
<script>

    $(".transactionCompletedIcon").click(function(){
        var completedTransactionId = $(this).parent().parent().attr('id');

        $.post("showProjects/markTransactionCompleted", {
            completedTransactionId: completedTransactionId
        }).done(function (data) {
            if (data == "success") {
                location.reload();

            } else if (data =="notWonTransaction") {
                $("#getNotWonTransactionModal").modal("show");
            }else if (data == "notEmpty"){
                $("#markTransactionCompletedErrorNotEmpty").modal("show");
            }else if(data == "deleted"){
                $("#markTransactionCompletedErrorIsDeleted").modal("show");
            }else if(data = "isCompleted"){
                $("#markTransactionCompletedErrorIsCompleted").modal("show");

            }
        });
    });

</script>


<!-- mark transaction NOT completed -->
<script>

$(".transactionNotCompleted").click(function(){
    var transactionId = $(this).parent().parent().attr('id');

    $.post("showProjects/markTransactionNotCompleted", {
        transactionId: transactionId
    }).done(function (data) {
        if (data == "success") {
            location.reload();

        } else if (data =="notWonTransaction") {
            $("#getNotWonTransactionModalNotCompleted").modal("show");
        }else if (data == "deleted"){
            $("#markTransactionNotCompletedErrorNotEmpty").modal("show");
        }
    });
});

</script>

<!-- getNotWonTransactionModal -->

<div id="getNotWonTransactionModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Pane tähele</h4>
            </div>
            <div class="modal-body">
                <p>Saad valida "lõpetatuks" ainult "võidetud" tehinguid</p>
            </div>
            <div class="modal-footer modal-footer-white">
                <button type="button" class="btn btn-success" data-dismiss="modal">Sulge</button>
            </div>
        </div>
    </div>
</div>



<!-- markTransactionCompletedErrorNotEmpty -->

<div id="markTransactionCompletedErrorNotEmpty" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">VIGA lõpetatuks märkimisel</h4>
            </div>
            <div class="modal-body">
                <p>Tehingut ei saa määrata lõpetatuks. Tehing on seotud tegevusega.</p>
            </div>
            <div class="modal-footer modal-footer-white">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Sulge</button>
            </div>
        </div>
    </div>
</div>

<!-- markTransactionCompletedErrorIsDeleted -->

<div id="markTransactionCompletedErrorIsDeleted" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">VIGA lõpetatuks märkimisel</h4>
            </div>
            <div class="modal-body">
                <p>Tehingut ei saa määrata lõpetatuks. Tehing on kustutatud</p>
            </div>
            <div class="modal-footer modal-footer-white">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Sulge</button>
            </div>
        </div>
    </div>
</div>

<!-- markTransactionCompletedErrorIsCompleted -->

<div id="markTransactionCompletedErrorIsCompleted" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">VIGA lõpetatuks märkimisel</h4>
            </div>
            <div class="modal-body">
                <p>Tehing juba on märgitud lõpetatuks</p>
            </div>
            <div class="modal-footer modal-footer-white">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Sulge</button>
            </div>
        </div>
    </div>
</div>

<!-- restore transaction -->
<script>

    $(".transactionRestoreIcon").click(function(){
        var restoreTransactionId = $(this).parent().parent().attr('id');

        $.post("showProjects/restoreTransaction", {
            restoreTransactionId: restoreTransactionId
        }).done(function (data) {
            if (data == "success") {
                location.reload();

            } else if (data =="isNull") {
                $("#restoreGetIsNullError").modal("show");
            }
        });
    });

</script>


<!-- restoreGetIsNullError -->

<div id="restoreGetIsNullError" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">VIGA tehingu taastamisel</h4>
            </div>
            <div class="modal-body">
                <p>Tehingut ei saa taastada. Tehing pole kustutatud</p>
            </div>
            <div class="modal-footer modal-footer-white">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Sulge</button>
            </div>
        </div>
    </div>
</div>

<!--  getNotWonTransactionModalNotCompleted -->

<div id="getNotWonTransactionModalNotCompleted" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">VIGA tehingu MITTE lõpetanuks lisamine</h4>
            </div>
            <div class="modal-body">
                <p>Tehingut ei saa tagasi töösse võtta. Pole tegemist võidetud tehinguga.</p>
            </div>
            <div class="modal-footer modal-footer-white">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Sulge</button>
            </div>
        </div>
    </div>
</div>

<!-- -->

<div id="markTransactionNotCompletedErrorNotEmpty" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">VIGA MITTE lõpetatuks märkimisel</h4>
            </div>
            <div class="modal-body">
                <p>Tehingut ei saa määrata MITTE lõpetatuks. Tehing on kustutatud</p>
            </div>
            <div class="modal-footer modal-footer-white">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Sulge</button>
            </div>
        </div>
    </div>
</div>

<!-- search -->

<script>
    $(document).ready(function () {
        $(".search").keyup(function () {
            $('.paginationResults').text("");
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
                $(".paginationResults").css("display", "none");

            } else {
                $('.counter').text(jobCount + ' tulemust');
            }

            if ($("#searchTransactionInput").val() == "") {
                $(".counter").text("");
                var numOfVisibleRows = $('tbody tr:visible').length;

                var allResults = $('tbody tr').length;

                $('.paginationResults').text(numOfVisibleRows + ' rida ' + allResults + "-st");
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




