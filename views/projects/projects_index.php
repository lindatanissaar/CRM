<style>

    .table-responsive {
        padding: 30px;
        background-color: white;
    }

    .status_won span {
        background-color: #38B87C;
        padding: 5px 10px 5px 10px;
        border-radius: 4px;
        color: white;
    }

</style>


<script>
    $(document).ready(function() {
        $(".search").keyup(function () {
            var searchTerm = $(".search").val();
            var listItem = $('.results tbody').children('tr');
            var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

            $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
                return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
            }
            });

            $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
                $(this).attr('visible','false');
            });

            $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
                $(this).attr('visible','true');
            });

            var jobCount = $('.results tbody tr[visible="true"]').length;

            if (jobCount == 1){
                $('.counter').text(jobCount + ' tulemus');

            }else {
                $('.counter').text(jobCount + ' tulemust');

            }

            if(jobCount == '0') {$('.no-result').show();}
            else {$('.no-result').hide();}
        });
    });
</script>

<script>

    $(document).ready(function(){
        $( ".status" ).each(function() {
            if($(this).text()== "STATUS_WON"){
                $(this).removeClass("status_won");
                $(this).removeClass("status_lost");
                $(this).removeClass("status_unknown");
                $( this ).addClass( "status_won" );
            }

            if($(this).text()== "STATUS_LOST"){
                $(this).removeClass("status_won");
                $(this).removeClass("status_lost");
                $(this).removeClass("status_unknown");
                $( this ).addClass( "status_lost" );
            }

            if($(this).text()== "STATUS_UNKNOWN"){
                $(this).removeClass("status_won");
                $(this).removeClass("status_lost");
                $(this).removeClass("status_unknown");
                $( this ).addClass( "status_unknown" );
            }
        });
    });


</script>


<script>
    $( function() {
        $( document ).tooltip();
    } );
</script>




<div class="row white"></div>

<div class="row white">

    <div class="column-left">
        <button type="button" class="btn btn-success" data-focus="false" data-toggle="modal" data-keyboard="true"
                data-target="#myModal">Lisa tehing
        </button>

        <a title="Müügitunnel" href="salesfunnel"><img src="assets/img/icon-tunnel.png" id="displayTunnel" /></a>
        <a title="Projektide tabel" href="projects"><img src="assets/img/icon-table.png" id="displayTable" /></a>
        <a title="Muuda tabeli veerge"><img id="changeTableColumns" src="assets/img/icon-add.png" /></a>
    </div>

    <div class="column-right">

        <div class="input-group">
            <input type="text" class="form-control input-md search" id="searchTransactionInput" placeholder="Otsi">
        </div>
        <span class="counter"></span>

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
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title">Lisa tehing</h3>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body row">
                            <div class="col-lg-8">
                                <div class="col-lg-12">
                                    <div class="form-group col-lg-8">
                                        <input id="name" placeholder="Tehingu nimetus" class="form-control input-lg">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group col-lg-4">
                                        <label for="price">Hind:</label>
                                        <input type="text" class="form-control input-sm" id="price" placeholder="">
                                    </div>

                                    <div class="form-group col-lg-4">
                                        <label for="datepicker">Tähtaeg:</label>
                                        <input type="text" class="form-control input-sm" id="datepicker" placeholder="">
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

                            <div class="col-lg-4">

                                <h4>Seosed</h4>
                                <hr>

                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Seosta ettevõttega"
                                           id="organisationNameId" list="organisation_name">
                                    <datalist id="organisation_name">
                                        <?php foreach ($organisations as $organisation): ?>
                                            <option id="<?= $organisation['ID'] ?>"><?= $organisation['ORGANISATION_NAME'] ?></option>
                                        <?php endforeach; ?>
                                    </datalist>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Seosta isikuga"
                                           id="contactPersonNameId" list="contact_person_name">
                                    <datalist id="contact_person_name">
                                        <?php foreach ($contact_persons as $contact_person): ?>
                                            <option id="<?= $contact_person['ID'] ?>"><?= $contact_person['CONTACT_PERSON_NAME'] ?></option>
                                        <?php endforeach; ?>
                                    </datalist>
                                </div>

                                <h4>Kontaktandmed</h4>
                                <hr>
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="text" class="form-control input-sm" id="email" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="telephone">Telefon:</label>
                                    <input type="text" class="form-control input-sm" id="telephone" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="addTransaction" type="button" class="btn btn-success" data-dismiss="modal">
                            Salvesta
                        </button>
                        <button id="saveAndAddNew" type="button" class="btn btn-basic">Salvesta ja lisa uus</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Table -->

<script>
    $(document).ready(function()
        {
            $("#transactionsTable").tablesorter( {dateFormat: 'pt'} );
        }
    );

</script>


<div class="table-responsive">

    <table class="table tablesorter results"  id="transactionsTable">

        <thead  class="header" id="tableHeader">
        <tr title="Sorteeri tabelit veergude järgi">
            <th>Nimetus</th>
            <th class="price">Väärtus</th>
            <th>Ettevõte</th>
            <th>Kontaktisik</th>
            <th>E-mail</th>
            <th class="phone">Telefon</th>
            <th class="date">Tähtaeg</th>
            <th>Staatus</th>
            <th>Märkused</th>
        </tr>

        <tr class="warning no-result">
            <td colspan="1"><i class="fa fa-warning"></i>Tulemused puuduvad</td>
        </thead>

        <tbody>

        <?php foreach ($transactions as $transaction): ?>
            <tr id="<?= $transaction['ID'] ?>">
                <td class="transaction_name" contenteditable><?= $transaction['NAME'] ?></td>
                <td class="price" contenteditable><?= round($transaction['PRICE'], 2) . " €" ?></td>
                <td class="organisation_name" contenteditable><?= $transaction['ORGANISATION_NAME'] ?></td>
                <td class="contact_person_name" contenteditable><?= $transaction['CONTACT_PERSON_NAME'] ?></td>
                <td class="email" contenteditable><?= $transaction['EMAIL'] ?></td>
                <td class="phone" contenteditable><?= $transaction['PHONE'] ?></td>
                <td class="date" contenteditable><?= date("d-m-Y", strtotime($transaction['DEADLINE_DATE'])) ?></td>
                <td class="status" contenteditable><span><?= $transaction['STATUS'] ?></span></td>
                <td class="note" contenteditable><?= $transaction['NOTE'] ?></td>
                <td class="editAndDeleteTable">
                    <a title="Tehingu hulgimuutmine" class="editTableRow"><img src="assets/img/icon-edit.png"/></a>
                    <a title="Kogu tehingu kustutamine" class="deleteTableRow"><img src="assets/img/icon-delete.png"/></a>
                </td>
            </tr>
        <?php endforeach; ?>

        </tbody>

    </table>

</div>

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
                    location.reload();

                    $('#addTransactionSuccess').modal('show');


                } else {
                    location.reload();

                    $('#addTransactionError').modal('show');

                }
            });
        })


$("#saveAndAddNew").click(function () {
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

                    $(':input').val('');

                    $('body').click(function(){
                        location.reload();
                    })


                } else {
                    $('#addTransactionError').modal('show');
                    $(':input').val('');
                    $('body').click(function(){
                        location.reload();
                    })
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
                console.log("korras");
                $('#deleteTransactionSuccess').modal('show');
                $('body').click(function(){
                    location.reload();
                })


            } else {
                console.log("pole korras");
                $('body').click(function(){
                    location.reload();
                })
            }
        });
    });

    // edit table row


    $(".editTableRow").click(function () {
        var transaction_id = $(this).parent().parent().attr('id');
        $.post("projects/editTableRow", {
            transaction_id: transaction_id
        }).done(function (data) {
            if (data) {
                data = JSON.parse(data);
                console.log(data[0]);
                $("#name").text(data[0].NAME);
            } else {

                console.log("pole korras");
            }

            $('#editTableRowModal').modal('show');

        })
    });

</script>

<script>

    $("#organisationNameId").blur(function(){

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
        //var color = $(this).find('option:selected').val();
        $(this).removeClass('STATUS_UNKNOWN STATUS_WON STATUS_LOST').addClass($(this).find('option:selected').val());
    }).change();

</script>

<div class="modal fade" tabindex="-1" role="dialog" id="addTransactionSuccess" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body" id="addTransactionSuccessBody">
                <h2>Salvestatud!</h2>
                <h4>Sisestatud tehing on salvestatud.</h4>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="deleteTransactionSuccess" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body" id="deleteTransactionSuccessBody">
                <H2>Kustutatud!</H2>
                <h4>Sisestatud tehing on salvestatud.</h4>
            </div>
        </div>
    </div>
</div>


<script>

    $("#changeTableColumns").click(function(){
        $('#changeTableColumnsModal').modal('show');
    })

</script>

<!-- Modal -->
<div class="modal fade" id="changeTableColumnsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title">Muuda välju</h3>
            </div>
            <div class="modal-body">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="transactionName" checked>
                    <label class="form-check-label" for="transactionName">
                        Nimetus
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="transactionPrice" checked>
                    <label class="form-check-label" for="transactionPrice">
                        Väärtus
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="transactionCompany" checked>
                    <label class="form-check-label" for="transactionCompany">
                        Ettevõte
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="transactionContactPerson" checked>
                    <label class="form-check-label" for="transactionContactPerson">
                        Kontaktisik
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="transactionEmail" checked>
                    <label class="form-check-label" for="transactionEmail">
                        Email
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="transactionTelephone" checked>
                    <label class="form-check-label" for="defaultCheck1">
                        Telefon
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="transactionDate" checked>
                    <label class="form-check-label" for="transactionDate">
                        Tähtaeg
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="transactionStatus" checked>
                    <label class="form-check-label" for="transactionStatus">
                        Staatus
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="transactionNote" checked>
                    <label class="form-check-label" for="transactionNote">
                        Märkused
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button id="changeTableColumnsId" type="button" class="btn btn-success" data-dismiss="modal" checked>
                    Salvesta
                </button>
            </div>
        </div>
    </div>
</div>

<!-- editTableRowModal -->

<div class="modal fade" id="editTableRowModal" role="dialog" tabindex="-1">
    <div class="vertical-alignment-helper">
        <div class="modal-lg vertical-align-center">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Muuda tehingut</h3>
                </div>
                <div class="modal-body">
                    <div class="modal-body row">
                        <div class="col-lg-8">
                            <div class="col-lg-12">
                                <div class="form-group col-lg-8">
                                    <input id="name" placeholder="Tehingu nimetus" class="form-control input-lg">
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group col-lg-4">
                                    <label for="price">Hind:</label>
                                    <input type="text" class="form-control input-sm" id="price" placeholder="" value="<?= $transactions2['ID'] ?>">
                                </div>

                                <div class="form-group col-lg-4">
                                    <label for="datepicker">Tähtaeg:</label>
                                    <input type="text" class="form-control input-sm" id="datepicker" placeholder="">
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

                        <div class="col-lg-4">

                            <h4>Seosed</h4>
                            <hr>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Seosta ettevõttega"
                                       id="organisationNameId" list="organisation_name">
                                <datalist id="organisation_name">
                                    <?php foreach ($organisations as $organisation): ?>
                                        <option id="<?= $organisation['ID'] ?>"><?= $organisation['ORGANISATION_NAME'] ?></option>
                                    <?php endforeach; ?>
                                </datalist>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Seosta isikuga"
                                       id="contactPersonNameId" list="contact_person_name">
                                <datalist id="contact_person_name">
                                    <?php foreach ($contact_persons as $contact_person): ?>
                                        <option id="<?= $contact_person['ID'] ?>"><?= $contact_person['CONTACT_PERSON_NAME'] ?></option>
                                    <?php endforeach; ?>
                                </datalist>
                            </div>

                            <h4>Kontaktandmed</h4>
                            <hr>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" class="form-control input-sm" id="email" placeholder="">
                            </div>

                            <div class="form-group">
                                <label for="telephone">Telefon:</label>
                                <input type="text" class="form-control input-sm" id="telephone" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="addTransaction" type="button" class="btn btn-success" data-dismiss="modal">
                        Muuda
                    </button>
                </div>
            </div>

        </div>

    </div>

</div>






