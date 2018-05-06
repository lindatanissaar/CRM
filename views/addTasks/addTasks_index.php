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
                <div class="form-group">
                    <input type="text" class="form-control input-lg"
                           placeholder="Tegevuse nimetus"
                           id="activityDescriptionId" list="activity_description">
                    <datalist id="activity_description">
                        <?php foreach ($activity_descriptions as $activity_description): ?>
                            <option id="<?= $activity_description['ID'] ?>"><?= $activity_description['DESCRIPTION'] ?></option>
                        <?php endforeach; ?>
                    </datalist>
                </div>

                <input type="text" class="form-control input-sm" id="datepicker2"
                       placeholder="Tähtaeg">

            </div>

            <div class="right">
                <div class="form-group">
                    <input title="Vali 'Võidetud' tehingute seast" type="text"
                           class="form-control input-lg" placeholder="Seosta tehinguga"
                           id="transactionNameId" list="transaction_name">
                    <datalist id="transaction_name">
                        <?php foreach ($transactions as $transaction): ?>
                            <option id="<?= $transaction['ID'] ?>"><?= $transaction['NAME'] ?></option>
                        <?php endforeach; ?>
                    </datalist>
                </div>

                <div class="form-group">
                    <input type="text" class="form-control input-sm" placeholder="Vastutaja"
                           id="employeeId" list="employeeName">
                    <datalist id="employeeName">
                        <?php foreach ($employees as $employee): ?>
                            <option id="<?= $employee['ID'] ?>"><?= $employee['FIRST_NAME'] . " " . $employee['LAST_NAME'] ?></option>
                        <?php endforeach; ?>
                    </datalist>
                </div>
            </div>

        </div>

        <div class="modal-footer">
            <button id="addTask" type="button" class="btn btn-success" data-dismiss="modal">
                Salvesta
            </button>
        </div>
    </div>

</div>

<!-- addTask -->

<script>
    $("#addTask").click(function () {
        var activityDescription = $("#activityDescriptionId").val();

        var deadlineDate = picker2.toString();

        var transactionName = $("#transactionNameId").val();

        var employeeName = $("#employeeId").val();


        // make $.post query
        $.post("tasks/addTask", {
            activityDescription: activityDescription,
            deadlineDate: deadlineDate,
            transactionName: transactionName,
            employeeName: employeeName
        }).done(function (data) {
            // if response from users/addingAdmins is successful, write "Uus kasutaja on lisatud", otherwise alert error
            if (data == "success") {

                $('#addTaskSuccess').modal('show');

                $('body').click(function () {
                    location.reload();
                })


            } else {
                console.log("pole korras");


                $('#addTransactionError').modal('show');

            }
        });
    })

</script>

<script>
    var picker2 = new Pikaday(
        {
            field: document.getElementById('datepicker2'),
            firstDay: 1,
            minDate: new Date(),
            maxDate: new Date(2020, 12, 31),
            yearRange: [2000, 2050],
            format: 'DD/MM/YYYY'
        });
</script>




