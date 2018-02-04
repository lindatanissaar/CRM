<style>

    /*success modal*/

    #addTransactionSuccessBody {
        color: white;
        background-color: #5cb85c;
    }

    select.input-sm {
        color: white;
        line-height: 1.5;
        padding: 5px 15px;
        font-weight: bold;
        text-align: center;
    }

    .form-control:focus {
        box-shadow: none;
    }

    option {
        padding: 20px;
        font-size: 12px;
    }

    option:hover {
        background-color: transparent;
    }

    select option,
    select {
        background-color: white;
        /*color: white;*/
    }

    select option[value="STATUS_UNKNOWN"],
    select.STATUS_UNKNOWN {
        background-color: lightgrey;
    }

    select option[value="STATUS_WON"],
    select.STATUS_WON {
        background-color: #5cb85c;

    }

    select option[value="STATUS_LOST"],
    select.STATUS_LOST {
        background-color: red;

    }

    .modal-header {
        background-color: #e5e5e5;
    }

    hr {
        border: 1px solid #8c8b8b;
        margin-top: 15px;
    }

    .vertical-alignment-helper {
        display: table;
        height: 100%;
        width: 100%;
    }

    .vertical-align-center {
        /* To center vertically */
        display: table-cell;
        vertical-align: middle;
    }

    .modal-content {
        /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
        width: inherit;
        height: inherit;
        /* To center horizontally */
        margin: 0 auto;
    }

    .modal-header {
        background-color: #eee;
    }

    .modal-footer {
        background-color: #F0F0F0;
    }

    .modal-title {
        padding-left: 48px;
    }

    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        text-indent: 1px;
        text-overflow: '';
    }

    #organisationNameId {
        background: url(assets/img/icon-business.png) no-repeat scroll 7px 7px;
        padding-left:30px;
    }

    #email {
        background: url(assets/img/icon-email.png) no-repeat scroll 7px 7px;
        padding-left:30px;
    }

    #telephone {
        background: url(assets/img/icon-telephone.png) no-repeat scroll 7px 7px;
        padding-left:30px;
    }

    #contactPersonNameId {
        background: url(assets/img/icon-contactperson.png) no-repeat scroll 7px 7px;
        padding-left:30px;
    }





</style>

<div class="row">
    <button type="button" class="btn btn-success" data-focus="false" data-toggle="modal" data-keyboard="true"
            data-target="#myModal">Lisa tehing
    </button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog" data-keyboard="true" tabindex="-1">
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

<div class="table-responsive">

    <table class="table table-striped table-bordered">

        <thead>
        <tr>
            <th>Nimetus</th>
            <th>Väärtus</th>
            <th>Ettevõte</th>
            <th>Kontaktisik</th>
            <th>E-mail</th>
            <th>Telefon</th>
            <th>Tähtaeg</th>
            <th>Staatus</th>
            <th>Märkused</th>
        </tr>
        </thead>

        <tbody>

        <?php foreach ($transactions as $transaction): ?>
            <tr>
                <td contenteditable><?= $transaction['NAME'] ?></td>
                <td contenteditable><?= round($transaction['PRICE'], 2) . " €" ?></td>
                <td contenteditable><?= $transaction['ORGANISATION_NAME'] ?></td>
                <td contenteditable><?= $transaction['CONTACT_PERSON_NAME'] ?></td>
                <td contenteditable><?= $transaction['EMAIL'] ?></td>
                <td contenteditable><?= $transaction['PHONE'] ?></td>
                <td contenteditable><?= date("d-m-Y", strtotime($transaction['DEADLINE_DATE'])) ?></td>
                <td contenteditable><?= $transaction['STATUS'] ?></td>
                <td contenteditable><?= $transaction['NOTE'] ?></td>
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
                    $('#addTransactionSuccess').modal('show');

                } else {
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


                } else {
                    $('#addTransactionError').modal('show');
                    $(':input').val('');
                }
            });
        })


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
        var color = $(this).find('option:selected').val();

        $(this).removeClass('STATUS_UNKNOWN STATUS_WON STATUS_LOST').addClass($(this).find('option:selected').val());
    }).change();

</script>


<div class="modal fade" tabindex="-1" role="dialog" id="addTransactionSuccess" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-body" id="addTransactionSuccessBody">

                <H2>Salvestatud!</H2>
                <h4>Sisestatud tehing on salvestatud.</h4>

            </div>
        </div>
    </div>
</div>




