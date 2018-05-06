<style>
    #cssmenu {
        display: inline-block;
        background-color: white;
    }

    .transactionModal {
        display: inline-block;
        background-color: white;
        margin-left: 5%;
        width: 60%;
        padding: 2%;
        vertical-align: top;
    }

    .row {
        background-color: #F8F8F8;
    }

    .left, .right {
        display: inline-block;
        width: 40%;
        margin: 2%;
    }

    .left {
        vertical-align: top;
    }

    input, label, select, textarea {
        margin-top: 3%;
    }

</style>

<script src="node_modules/moment/moment.js"></script>
<script src="node_modules/pikaday/pikaday.js"></script>


<div class="row">
    <div id='cssmenu'>
        <ul>
            <li <?= $controller == 'addProjects' ? 'class="active"' : '' ?>><a href="addProjects"><span>Lisa tehing</span></a></li>
            <li <?= $controller == 'addTasks' ? 'class="active"' : '' ?>><a href="addTasks"><span>Lisa tegevus</span></a></li>
            <li <?= $controller == 'addTaskNames' ? 'class="active"' : '' ?>><a href='addTaskNames'><span>Lisa tegevuse nimetus</span></a></li>
            <li <?= $controller == 'addEmployees' ? 'class="active"' : '' ?>><a href='addEmployees'><span>Lisa vastutaja</span></a></li>
            <li <?= $controller == 'showProjects' ? 'class="active"' : '' ?> class='last'><a href='showProjects'><span>Vaata kõiki tehinguid</span></a></li>
        </ul>
    </div>

    <!-- adminTransactionModal -->
    <div class="transactionModal">
        <div class="modalRow">
            <div class="left">
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

            <div class="right">

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


