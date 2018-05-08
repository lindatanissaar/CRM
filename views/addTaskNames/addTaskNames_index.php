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



</div>

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
                    <input type="text" class="form-control input-md" id="taskName" placeholder="Tegevuse liik">
                </div>
            </div>

            <div class="activity_description">
                <?php foreach ($activity_descriptions as $activity_description): ?>
                    <div class="activity_desc"
                         id="<?= $activity_description['ID'] ?>"><?= $activity_description['DESCRIPTION'] ?><img
                                class="deleteTaskName" src="assets/img/icon-cross.png"/>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="modal-footer addTask">
                <button id="addTaskDesc" type="button" class="btn btn-success" data-dismiss="modal">
                    Salvesta
                </button>
            </div>
        </div>
    </div>

</div>


<!-- add task description -->

<script>

    $("#addTaskDesc").click(function(){
        var activityDescription = $("#taskName").val();


        // make $.post query
        $.post("admins/addTaskName", {
            activityDescription: activityDescription
        }).done(function (data) {
            if (data == "success") {
                location.reload();

            } else {
                console.log("pole korras");
            }
        });
    })

    $(".deleteTaskName").click(function () {
        var taskDescId = $(this).parent().attr('id');
        // make $.post query
        $.post("admins/deleteTaskDesc", {
            taskDescId: taskDescId
        }).done(function (data) {
            if (data == "success") {
                $('#deleteTaskNameSuccess').modal('show');
                location.reload();


            } else if (data == "notEmpty") {
                $('#deleteTaskNameerrorNotEmpty').modal('show');

            }
        });
    });

</script>


<!-- MODALS -->

<!-- deleteTaskNameerrorNotEmpty -->


<div id="deleteTaskNameerrorNotEmpty" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">VIGA tegevuse nime kustutamisel</h4>
            </div>
            <div class="modal-body">
                <p>Tegevuse nime ei saa kustutada. Tegevuse nimi on seotud tegevusega.</p>
            </div>
            <div class="modal-footer modal-footer-white">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Sulge</button>
            </div>
        </div>
    </div>
</div>

<!-- deleteTaskNameSuccess  -->

<div class="modal fade" tabindex="-1" role="dialog" id="deleteTaskNameSuccess" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body modal-body-delete-success">
                <h3>Kustutatud</h3>
                <h4>Tegevuse nimi on kustutatud.</h4>
            </div>
        </div>
    </div>
</div>



