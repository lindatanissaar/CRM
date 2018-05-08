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


<script src="node_modules/table-paging/jquery.table.hpaging.js"></script>

<script>

    $(document).ready(function () {
        $(".status").each(function () {
            if ($(this).text() == "Võidetud") {
                $(this).removeClass("status_won");
                $(this).removeClass("status_lost");
                $(this).removeClass("status_unknown");
                $(this).addClass("status_won");
            }

            if ($(this).text() == "Kaotatud") {
                $(this).removeClass("status_won");
                $(this).removeClass("status_lost");
                $(this).removeClass("status_unknown");
                $(this).addClass("status_lost");
            }

            if ($(this).text() == "Pole teada") {
                $(this).removeClass("status_won");
                $(this).removeClass("status_lost");
                $(this).removeClass("status_unknown");
                $(this).addClass("status_unknown");
            }
        });
    });

</script>


<script>
    $(function () {
        $(document).tooltip();
    });
</script>


<div class="content">
    <div class="row">

        <div class="column-left">

            <button type="button" id="updateTransactionTable" class="btn btn-success" data-focus="false" data-toggle="modal"
                    data-keyboard="true">Salvesta
            </button>
            <button type="button" class="btn btn-basic addTransactionButton" data-focus="false" data-toggle="modal" data-keyboard="true"
                    data-target="#myModal">Lisa tehing
            </button>

            <a title="Müügitunnel" href="salesfunnel"><img src="assets/img/icon-tunnel.png" id="displayTunnel"/></a>
            <a title="Projektide tabel" href="projects"><img src="assets/img/icon-table.png" id="displayTable"/></a>
            <a title="Muuda tabeli veerge"><img id="changeTableColumns" src="assets/img/icon-add.png"/></a>
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
                    <?php if($transaction['STATUS'] == "STATUS_WON"){
                        $STATUS = "Võidetud";
                    } elseif ($transaction['STATUS'] == "STATUS_UNKNOWN") {
                        $STATUS = "Pole teada";
                    }else {
                        $STATUS = "Kaotatud";
                    }

                    ?>
                    <tr id="<?= $transaction['ID'] ?>">
                        <td class="transactionName" contenteditable><?= $transaction['NAME'] ?></td>
                        <td class="price" contenteditable><?= round($transaction['PRICE'], 2) . " €" ?></td>
                        <td class="organisationName" contenteditable><?= $transaction['ORGANISATION_NAME'] ?></td>
                        <td class="contactPersonName" contenteditable><?= $transaction['CONTACT_PERSON_NAME'] ?></td>
                        <td class="email" contenteditable><?= $transaction['EMAIL'] ?></td>
                        <td class="phone" contenteditable><?= $transaction['PHONE'] ?></td>
                        <td class="date"
                            contenteditable><?= date("d/m/Y", strtotime($transaction['DEADLINE_DATE'])) ?></td>
                        <td class="status" contenteditable><span><?= $STATUS ?></span></td>
                        <td class="note" contenteditable><?= $transaction['NOTE'] ?></td>
                        <td class="editAndDeleteTable">
                            <a title="Märgi tehing lõpetatuks" class="transactionCompletedIcon"><img src="assets/img/icon-completed.png"/></a>
                            <a title="Kogu tehingu kustutamine" class="deleteTableRow"><img
                                        src="assets/img/icon-delete.png"/></a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

    <div class="row">

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog" tabindex="-1">
            <div class="vertical-alignment-helper">
                <div class="modal-lg vertical-align-center">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">x</button>
                            <h3 class="modal-title">Lisa tehing</h3>
                        </div>
                        <div class="modal-body">
                            <div class="modal-body row">
                                <div class="col-lg-8">
                                    <div class="col-lg-12">
                                        <div class="form-group col-lg-8">
                                            <input id="name" placeholder="Tehingu nimetus"
                                                   class="form-control input-lg">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group col-lg-4">
                                            <label for="price">Hind:</label>
                                            <input type="text" class="form-control input-sm" id="price" placeholder="">
                                        </div>

                                        <div class="form-group col-lg-4">
                                            <label for="datepicker">Tähtaeg:</label>
                                            <input type="text" class="form-control input-sm" id="datepicker"
                                                   placeholder="">
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="status">Staatus:</label>

                                            <div class="form-group">
                                                <select name="item-0-status" id="id_item-0-status"
                                                        class="form-control input-sm">
                                                    <option value="STATUS_UNKNOWN">Pole teada</option>
                                                    <option value="STATUS_WON">Võidetud</option>
                                                    <option value="STATUS_LOST">Kaotatud</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group col-lg-10">
                                            <label for="note">Märkus:</label>
                                            <textarea class="form-control" rows="6" id="note"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 right-side">

                                    <h4>Seosed</h4>

                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Seosta ettevõttega"
                                               id="organisationNameId" list="organisationName">
                                        <datalist id="organisationName">
                                            <?php foreach ($organisations as $organisation): ?>
                                                <option id="<?= $organisation['ID'] ?>"><?= $organisation['ORGANISATION_NAME'] ?></option>
                                            <?php endforeach; ?>
                                        </datalist>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Seosta isikuga"
                                               id="contactPersonNameId" list="contactPersonName">
                                        <datalist id="contactPersonName">
                                            <?php foreach ($contact_persons as $contact_person): ?>
                                                <option id="<?= $contact_person['ID'] ?>"><?= $contact_person['CONTACT_PERSON_NAME'] ?></option>
                                            <?php endforeach; ?>
                                        </datalist>
                                    </div>

                                    <h4>Kontaktandmed</h4>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="text" class="form-control input-md" id="email" placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label for="telephone">Telefon:</label>
                                        <input type="text" class="form-control input-md" id="telephone" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="addTransaction" type="button" class="btn btn-success" data-dismiss="modal">
                                Salvesta
                            </button>
                        </div>
                    </div>

                </div>
            </div>
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

<script src="node_modules/moment/moment.js"></script>
<script src="node_modules/pikaday/pikaday.js"></script>
<script>

    var picker = new Pikaday(
        {
            field: document.getElementById('datepicker'),
            firstDay: 1,
            minDate: new Date(),
            maxDate: new Date(2020, 12, 31),
            yearRange: [2000, 2050],
            format: 'DD/MM/YYYY'
        });

</script>

<script>

    $("#addTransaction").click(function () {
        var name = $("#name").val();
        var price = $("#price").val();
        var organisation_name = $("#organisationNameId").val();
        var contact_person_name = $("#contactPersonNameId").val();
        var email = $("#email").val();
        var deadline_date = picker.toString();
        var status = $("#id_item-0-status").val();
        var note = $("#note").val();
        var telephone = $("#telephone").val();

        // make $.post query
        $.post("projects/addTransaction", {
            name: name,
            price: price,
            organisation_name: organisation_name,
            contact_person_name: contact_person_name,
            email: email,
            deadline_date: deadline_date,
            status: status,
            note: note,
            telephone: telephone
        }).done(function (data) {
            // if response from users/addingAdmins is successful, write "Uus kasutaja on lisatud", otherwise alert error
            if (data == "success") {
                $('#addTransactionSuccess').modal('show');
                location.reload();

            } else {
                $('#addTransactionError').modal('show');
            }

        });
    })

</script>


<script>

    $(".deleteTableRow").click(function () {
        var transaction_id = $(this).parent().parent().attr('id');

        // make $.post query
        $.post("projects/deleteTableRow", {
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

<script>

    $("#organisationNameId").blur(function () {

        var organisation_name = $("#organisationNameId").val();

        $.post("projects/getOrganisation", {
            organisation_name: organisation_name
        }).done(function (data) {
            if (data) {
                var myJsonString = JSON.stringify(data);

                obj = JSON.parse(myJsonString);

                obj = JSON.parse(obj);

                $('#contactPersonNameId').val(obj[0].CONTACT_PERSON_NAME);
                $('#telephone').val(obj[0].PHONE);
                $('#email').val(obj[0].EMAIL);
            } else {
                console.log("mingi error");
            }
        });
    });

</script>


<script>

    $('select[id$=-status][id^=id_item-]').change(function () {
        $(this).removeClass('STATUS_UNKNOWN STATUS_WON STATUS_LOST').addClass($(this).find('option:selected').val());
    }).change();

</script>

<script>

    $("#changeTableColumns").click(function () {
        if (Cookies.get('transactionName') == "none") {
            $("#transactionName").prop('checked', false);
        } else {
            $("#transactionName").prop('checked', true);

        }

        if (Cookies.get('price') == "none") {
            $("#transactionPrice").prop('checked', false);
        } else {
            $("#transactionPrice").prop('checked', true);

        }

        if (Cookies.get('organisationName') == "none") {
            $("#transactionCompany").prop('checked', false);
        } else {
            $("#transactionCompany").prop('checked', true);
        }

        if (Cookies.get('contactPersonName') == "none") {
            $("#transactionContactPerson").prop('checked', false);
        } else {
            $("#transactionContactPerson").prop('checked', true);
        }

        if (Cookies.get('email') == "none") {
            $("#transactionEmail").prop('checked', false);
        } else {
            $("#transactionEmail").prop('checked', true);
        }

        if (Cookies.get('phone') == "none") {
            $("#transactionTelephone").prop('checked', false);
        } else {
            $("#transactionTelephone").prop('checked', true);
        }


        if (Cookies.get('status') == "none") {
            $("#transactionStatus").prop('checked', false);
        } else {
            $("#transactionStatus").prop('checked', true);
        }

        if (Cookies.get('note') == "none") {
            $("#transactionNote").prop('checked', false);
        } else {
            $("#transactionNote").prop('checked', true);
        }

        if (Cookies.get('date') == "none") {
            $("#transactionDate").prop('checked', false);
        } else {
            $("#transactionDate").prop('checked', true);
        }


        $('#changeTableColumnsModal').modal('show');
    })

</script>

<!-- Modal -->
<div class="modal fade" id="changeTableColumnsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Vali tabeli väljad</h3>
            </div>
            <div class="modal-body">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="transactionName">
                    <label class="form-check-label" for="transactionName">
                        Nimetus
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="transactionPrice">
                    <label class="form-check-label" for="transactionPrice">
                        Väärtus
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="transactionCompany">
                    <label class="form-check-label" for="transactionCompany">
                        Ettevõte
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="transactionContactPerson">
                    <label class="form-check-label" for="transactionContactPerson">
                        Kontaktisik
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="transactionEmail">
                    <label class="form-check-label" for="transactionEmail">
                        Email
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="transactionTelephone">
                    <label class="form-check-label" for="transactionTelephone">
                        Telefon
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="transactionDate">
                    <label class="form-check-label" for="transactionDate">
                        Tähtaeg
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="transactionStatus">
                    <label class="form-check-label" for="transactionStatus">
                        Staatus
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="transactionNote">
                    <label class="form-check-label" for="transactionNote">
                        Märkused
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- pagination -->

<script>
    $(function () {
        var lmt = Cookies.get('transactionLimit');
        if(lmt == undefined){
            $("#transactionsTable").hpaging({"limit": 5});
        }else {
            $("#transactionsTable").hpaging({"limit": lmt});
        }

        if(lmt != undefined){
            $('#pglmtTransaction').attr('value', lmt);
        }
    });

    $("#pglmtTransaction").keyup(function () {
        var lmt = $(this).val();
        if (lmt == "" || lmt == "0") {
        } else {
            $("#transactionsTable").hpaging("newLimit", lmt);
        }

        var numOfVisibleRows = $('tbody tr:visible').length;

        var allResults = $('tbody tr').length;

        $('.paginationResults').text(numOfVisibleRows + ' rida ' + allResults + "-st");

    });

    $("#pglmtTransaction").blur(function () {
        var lmt = $(this).val();
        if (lmt == "" || lmt == "0") {
        } else {
            Cookies.set('transactionLimit', lmt);
        }
    });

</script>

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


<!-- hide/show table columns -->
<script>

    $(function () {
        if (Cookies.get('transactionName') == "none") {
            $(".transactionName").hide();
        } else {
            $(".transactionName").show();
        }

        if (Cookies.get('price') == "none") {
            $(".price").hide();
        } else {
            $(".price").show();
        }

        if (Cookies.get('organisationName') == "none") {
            $(".organisationName").hide();
        } else {
            $(".organisationName").show();
        }

        if (Cookies.get('contactPersonName') == "none") {
            $(".contactPersonName").hide();
        } else {
            $(".contactPersonName").show();
        }

        if (Cookies.get('email') == "none") {
            $(".email").hide();
        } else {
            $(".email").show();
        }

        if (Cookies.get('phone') == "none") {
            $(".phone").hide();
        } else {
            $(".phone").show();
        }

        if (Cookies.get('price') == "none") {
            $(".price").hide();
        } else {
            $(".price").show();
        }

        if (Cookies.get('status') == "none") {
            $(".status").hide();
        } else {
            $(".status").show();
        }

        if (Cookies.get('date') == "none") {
            $(".date").hide();
        } else {
            $(".date").show();
        }

        if (Cookies.get('note') == "none") {
            $(".note").hide();
        } else {
            $(".note").show();
        }
    })

    $("#transactionName").blur(function () {
        if ($("#transactionName").is(":checked")) {
            $(".transactionName").show();
            Cookies.set('transactionName', 'display');


        } else {
            $(".transactionName").hide();
            Cookies.set('transactionName', 'none');
        }
    })

    $("#transactionPrice").blur(function () {
        if ($("#transactionPrice").is(":checked")) {
            $(".price").show();
            Cookies.set('price', 'display');


        } else {
            $(".price").hide();
            Cookies.set('price', 'none');

        }
    })

    $("#transactionCompany").blur(function () {
        if ($("#transactionCompany").is(":checked")) {
            $(".organisationName").show();
            Cookies.set('organisationName', 'display');


        } else {
            $(".organisationName").hide();
            Cookies.set('organisationName', 'none');

        }
    })

    $("#transactionContactPerson").blur(function () {
        if ($("#transactionContactPerson").is(":checked")) {
            $(".contactPersonName").show();
            Cookies.set('contactPersonName', 'display');


        } else {
            $(".contactPersonName").hide();
            Cookies.set('contactPersonName', 'none');

        }
    })

    $("#transactionEmail").blur(function () {
        if ($("#transactionEmail").is(":checked")) {
            $(".email").show();
            Cookies.set('email', 'display');


        } else {
            $(".email").hide();
            Cookies.set('email', 'none');

        }
    })

    $("#transactionTelephone").blur(function () {
        if ($("#transactionTelephone").is(":checked")) {
            $(".phone").show();
            Cookies.set('phone', 'display');


        } else {
            $(".phone").hide();
            Cookies.set('phone', 'none');
        }
    })

    $("#transactionStatus").blur(function () {
        if ($("#transactionStatus").is(":checked")) {
            $(".status").show();
            Cookies.set('status', 'display');


        } else {
            $(".status").hide();
            Cookies.set('status', 'none');

        }
    })

    $("#transactionDate").blur(function () {
        if ($("#transactionDate").is(":checked")) {
            $(".date").show();
            Cookies.set('date', 'display');


        } else {
            $(".date").hide();
            Cookies.set('date', 'none');
        }
    })

    $("#transactionNote").blur(function () {
        if ($("#transactionNote").is(":checked")) {
            $(".note").show();
            Cookies.set('note', 'display');


        } else {
            $(".note").hide();
            Cookies.set('note', 'none');

        }
    })


</script>

<!-- edit table data -->

<script>

    $(function () {
        var transactionName = {};
        var price = {};
        var organisationName = {};
        var email = {};
        var phone = {};
        var date = {};
        var status = {};
        var note = {};
        $('.transactionName').each(function () {
            $(this).blur(function () {
                transactionName[$(this).parent().attr("id")] = $(this).text();
                $("#updateTransactionTable").addClass("opacitySaveButton");
            })
        })

        $('.price').each(function () {
            $(this).blur(function () {
                price[$(this).parent().attr("id")] = $(this).text();
                $("#updateTransactionTable").addClass("opacitySaveButton");
            })
        });

        $('.organisationName').each(function () {
            $(this).blur(function () {
                organisationName[$(this).parent().attr("id")] = $(this).text();
                $("#updateTransactionTable").addClass("opacitySaveButton");
            })
        });

        $('.phone').each(function () {
            $(this).blur(function () {
                phone[$(this).parent().attr("id")] = $(this).text();
                $("#updateTransactionTable").addClass("opacitySaveButton");
            })
        });

        $('.date').each(function () {
            $(this).blur(function () {
                date[$(this).parent().attr("id")] = $(this).text();
                $("#updateTransactionTable").addClass("opacitySaveButton");
            })
        });

        $('.status').each(function () {
            $(this).blur(function () {
                status[$(this).parent().attr("id")] = $(this).text();
                $("#updateTransactionTable").addClass("opacitySaveButton");
            })
        });

        $('.note').each(function () {
            $(this).blur(function () {
                note[$(this).parent().attr("id")] = $(this).text();
                $("#updateTransactionTable").addClass("opacitySaveButton");
            })
        });

        $('#updateTransactionTable').click(function () {

            transactionName = JSON.stringify(transactionName);
            price = JSON.stringify(price);
            organisationName = JSON.stringify(organisationName);
            email = JSON.stringify(email);
            phone = JSON.stringify(phone);
            date = JSON.stringify(date);
            status = JSON.stringify(status);
            note = JSON.stringify(note);

            console.log(transactionName);
            console.log(price);
            console.log(organisationName);
            console.log(email);
            console.log(phone);
            console.log(date);
            console.log(status);
            console.log(note);

            // make $.post query
            $.post("projects/updateTransactionTable", {
                data: {transactionName: transactionName,
                    price: price,
                    organisationName: organisationName,
                    email: email,
                    phone: phone,
                    date: date,
                    status: status,
                    note: note
                }
            }).done(function (data) {
                if (data == "success") {
                    location.reload();
                    $('#deleteTransactionSuccess').modal('show');
                    $('body').click(function () {
                        location.reload();
                    })

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

        $.post("projects/markTransactionCompleted", {
            completedTransactionId: completedTransactionId
        }).done(function (data) {
            if (data == "success") {
                location.reload();

            } else if (data =="notWonTransaction") {
                $("#getNotWonTransactionModal").modal("show");
            }else if (data == "notEmpty"){
                $("#markTransactionCompletedErrorNotEmpty").modal("show");
            }
        });
    });

</script>

<!-- MODALS -->

<!-- added transaction success -->

<div class="modal fade" tabindex="-1" role="dialog" id="addTransactionSuccess" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body modal-body-success">
                <h3>Salvestatud</h3>
                <h4>Sisestatud tehing on salvestatud.</h4>
            </div>
        </div>
    </div>
</div>


<!-- added transaction error -->

<div id="addTransactionError" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">VIGA SALVESTAMISEL</h4>
            </div>
            <div class="modal-body">
                <p>Tehingu salvestamisel esines viga. Proovi uuesti salvestada</p>
            </div>
            <div class="modal-footer modal-footer-white">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Sulge</button>
            </div>
        </div>
    </div>
</div>

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






