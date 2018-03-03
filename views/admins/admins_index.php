<style>


    /*sidebar menu*/
    #cssmenu {
        background: white;
        list-style: none;
        margin: 0;
        padding: 0;
        width: 25em;
        -webkit-box-shadow: 0 10px 6px -6px #777;
        -moz-box-shadow: 0 10px 6px -6px #777;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    #cssmenu li {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    #cssmenu a {
        background:  white;
        border-bottom: 1px solid white;
        color: #666;
        display: block;
        margin: 0;
        padding: 30px 34px;
        text-decoration: none;
        font-weight: bold;
        font-size: 1.5rem;
    }

    #cssmenu a:hover {
        background: white url("assets/img/hover.gif") left center no-repeat;
        color: #dc4d5d;
        padding-bottom: 30px;
        background-color: #F8F8F8;
    }

    .row {
        background-color: white;
        width: 25em;
    }

    #adminArea, #cssmenu {
        display: inline-block;
    }

    .modal-backdrop {
        background: none;
    }

    .modal-content {
        box-shadow: none;
        border: none;
        float: right;

    }

    .modal-lg {
        top:10%;
        left: 10%;
        outline: none;
    }

    .modal-footer {
        background-color: white;
        padding: 15px;
        text-align: right;
        border-top: 1px solid white;
    }

    select.input-sm {
        color: black;
    }


</style>


<div class="row">

    <div id='cssmenu'>
        <ul>
            <li class='active'><a id="addTransactionModal" href="#adminTransactionModal" data-toggle="modal"><span>Lisa tehing</span></a></li>
            <li><a data-toggle="modal" href="#adminTaskModal"><span>Lisa tegevus</span></a></li>
            <li><a data-toggle="modal" href='#adminTaskNameModal'><span>Lisa tegevuse nimetus</span></a></li>
            <li><a data-toggle="modal" href='#addSupervisorModel'><span>Lisa vastutaja</span></a></li>
            <li class='last'><a data-toggle="modal" href='#displayAllTransactions'><span>Vaata kõiki tehinguid</span></a></li>
        </ul>
    </div>

</div>


<!-- adminTransactionModal -->
<div id="adminTransactionModal" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-body">

                    <div class="col-lg-6">

                        <input id="name" placeholder="Tehingu nimetus" class="form-control input-lg">

                        <label for="price">Hind:</label>
                        <input type="text" class="form-control input-sm" id="price" placeholder="">

                        <label for="datepicker">Tähtaeg:</label>
                        <input type="text" class="form-control input-sm" id="datepicker" placeholder="">

                        <label for="status">Staatus:</label>

                        <div class="form-group">
                            <select name="item-0-status" id="id_item-0-status"
                                    class="form-control input-sm">
                                <option value="STATUS_UNKNOWN">Pole teada</option>
                                <option value="STATUS_WON">Võidetud</option>
                                <option value="STATUS_LOST">Kaotatud</option>
                            </select>
                        </div>

                        <label for="note">Märkus:</label>
                        <textarea class="form-control" rows="6" id="note"></textarea>

                    </div>

                    <div class="col-lg-6">

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
                <div class="modal-footer">
                    <button id="addTransaction" type="button" class="btn btn-success" data-dismiss="modal">
                        Salvesta
                    </button>
                    <button id="saveAndAddNew" type="button" class="btn btn-basic">Salvesta ja lisa uus</button>
                </div>
            </div>
    </div>
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


<!-- adminTaskModal -->
<div id="adminTaskModal" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
            </div>
        </div>

    </div>
</div>


<!-- adminTaskNameModal -->
<div id="adminTaskNameModal" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
            </div>
        </div>

    </div>
</div>


<!-- addSupervisorModel -->
<div id="addSupervisorModel" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <h2>Lisa uus töötaja</h2>
                <p></p>
            </div>
            <div class="modal-footer">
            </div>
        </div>

    </div>
</div>


<!-- displayAllTransactions -->
<div id="displayAllTransactions" class="modal" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
            </div>
        </div>

    </div>
</div>





<!-- addTransaction -->

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


</script>









