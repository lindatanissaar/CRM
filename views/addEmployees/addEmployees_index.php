<style>
    #cssmenu {
        display: inline-block;
        background-color: white;
    }

    .transactionModal {
        display: inline-block;
        background-color: white;
        margin-left: 5%;
        width: 40%;
        padding: 2%;
        vertical-align: top;
    }

    .row {
        background-color: #F8F8F8;
    }

    .left {
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
                    <input type="text" class="form-control input-md" id="firstName" placeholder="Eesnimi">
                    <input type="text" class="form-control input-md" id="lastName" placeholder="Perenimi">
                </div>
            </div>

            <div class="newEmployee">
                <?php foreach ($employees as $employee): ?>
                    <div class="employees"
                         id="<?= $employee['ID'] ?>"><?= $employee['FIRST_NAME'] . " " . $employee['LAST_NAME'] ?>
                        <img
                                class="deleteEmployee" src="assets/img/icon-cross.png"/>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="modal-footer addTask">
            <button id="addNewEmployee" type="button" class="btn btn-success" data-dismiss="modal">
                Salvesta
            </button>
        </div>
    </div>
</div>

<!-- add new employee -->

<script>

    $("#addNewEmployee").click(function () {
        var firstName = $("#firstName").val();
        var lastName = $("#lastName").val();


        // make $.post query
        $.post("admins/addNewEmployee", {
            firstName: firstName,
            lastName: lastName
        }).done(function (data) {
            if (data == "success") {
                location.reload();

            } else {
                console.log("pole korras");
            }
        });
    })

    $(".deleteEmployee").click(function () {
        var employeeId = $(this).parent().attr('id');

        // make $.post query
        $.post("admins/deleteEmployee", {
            employeeId: employeeId
        }).done(function (data) {
            if (data == "success") {
                $('#deleteEmployeeSuccess').modal('show');
                    location.reload();

            } else if (data == "notEmpty") {
                $('#deleteEmployeeErrorNotEmpty').modal('show');

            }
        });
    });

</script>


<!-- MODALS -->

<!-- deleteEmployeeErrorNotEmpty -->


<div id="deleteEmployeeErrorNotEmpty" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">VIGA töötaja kustutamisel</h4>
            </div>
            <div class="modal-body">
                <p>Töötajat ei saa kustutada. Töötaja on seotud tegevusega.</p>
            </div>
            <div class="modal-footer modal-footer-white">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Sulge</button>
            </div>
        </div>
    </div>
</div>

<!-- deleteEmployeeSuccess  -->

<div class="modal fade" tabindex="-1" role="dialog" id="deleteEmployeeSuccess" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body modal-body-delete-success">
                <h3>Kustutatud</h3>
                <h4>Töötaja on kustutatud.</h4>
            </div>
        </div>
    </div>
</div>


