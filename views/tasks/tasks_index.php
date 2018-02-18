<style>

body {
    background-color: #F8F8F8;
}

    .column-l {
        width: 90%;
        display: inline-block;
        background-color: white;
        padding: 30px;
    }

    .column-r {
        width: 8%;
        display: inline-block;
        background-color: white;

    }

    #searchTasksInput {
        padding-right: 10%;
    }
</style>



<!-- search from tasks table-->

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

<!--use tooltips -->

<script>
    $( function() {
        $( document ).tooltip();
    } );
</script>


<!-- sort table -->

<script>
    $(document).ready(function()
        {
            $("#tasksTable").tablesorter( {dateFormat: 'pt'} );
        }
    );
</script>






<div class="row">

    <div class="column-l">

        <div class="row">

            <div class="column-left">
                <button type="button" class="btn btn-success" data-focus="false" data-toggle="modal" data-keyboard="true"
                        data-target="#myModal">Lisa tegevus
                </button>
            </div>

            <div class="column-right">

                <div class="input-group">
                    <input type="text" class="form-control input-md search" id="searchTasksInput"  placeholder="Otsi">
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
                                <h3 class="modal-title">Lisa tegevus</h3>
                            </div>
                            <div class="modal-body">
                                <div class="modal-body row">
                                    <div class="col-lg-8">

                                        <div class="form-group">
                                            <input type="text" class="form-control col-lg-8" placeholder="Tegevuse nimetus"
                                                   id="activityDescriptionId" list="activity_description">
                                            <datalist id="activity_description">
                                                <?php foreach ($activity_descriptions as $activity_description): ?>
                                                    <option id="<?= $activity_description['ID'] ?>"><?= $activity_description['DESCRIPTION'] ?></option>
                                                <?php endforeach; ?>
                                            </datalist>
                                        </div>

                                            <div class="form-group col-lg-4">
                                                <label for="datepicker">Tähtaeg:</label>

                                                <input type="text" class="form-control input-sm" id="datepicker" placeholder="Tähtaeg">

                                            </div>
                                    </div>

                                    <div class="col-lg-4">

                                        <h4>Seosed</h4>
                                        <hr/>

                                        <div class="form-group">
                                            <input title="Vali 'Võidetud' tehingute seast" type="text" class="form-control" placeholder="Seosta tehinguga"
                                                   id="transactionNameId" list="transaction_name">
                                            <datalist id="transaction_name">
                                                <?php foreach ($transactions as $transaction): ?>
                                                    <option id="<?= $transaction['ID'] ?>"><?= $transaction['NAME'] ?></option>
                                                <?php endforeach; ?>
                                            </datalist>
                                        </div>

                                        <h4>Määra vastutaja</h4>
                                        <hr/>

                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Vastutaja"
                                                   id="employeeId" list="employeeName">
                                            <datalist id="employeeName">
                                                <?php foreach ($employees as $employee): ?>
                                                    <option id="<?= $employee['ID'] ?>"><?= $employee['FIRST_NAME'] ." " . $employee['LAST_NAME'] ?></option>
                                                <?php endforeach; ?>
                                            </datalist>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="addTask" type="button" class="btn btn-success" data-dismiss="modal">
                                    Salvesta
                                </button>
                                <button id="saveTaskAndAddNew" type="button" class="btn btn-basic">Salvesta ja lisa uus</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="table-responsive">

                <table class="table tablesorter results"  id="tasksTable">

                    <thead  class="header" id="tableHeader">
                    <tr title="Sorteeri tabelit veergude järgi">
                        <th>Nimetus</th>
                        <th>Vastutaja</th>
                        <th>Seosta tehinguga</th>
                        <th>Tähtaeg</th>
                    </tr>

                    <tr class="warning no-result">
                        <td colspan="1"><i class="fa fa-warning"></i>Tulemused puuduvad</td>
                    </thead>

                    <tbody>

                    <?php foreach ($activities as $activity): ?>
                        <tr id="<?= $activity['ID'] ?>">
                            <td class="activity_description" contenteditable><?= $activity['DESCRIPTION'] ?></td>
                            <td class="employee_name" "<?= $activity['FIRST_NAME'] . " " . $activity['LAST_NAME'] ?>" contenteditable><?= $activity['FIRST_NAME'] . " " . $activity['LAST_NAME'] ?></td>
                            <td class="transaction_name" contenteditable><?= $activity['NAME'] ?></td>
                            <td class="date" contenteditable><?= date("d-m-Y", strtotime($activity['DEADLINE_DATE'])) ?></td>
                            <td class="editAndDeleteTable">
                                <a title="Kogu tegevuse kustutamine" class="deleteTableRow"><img src="assets/img/icon-delete.png"/></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    </tbody>

                </table>



            </div>
        </div>

    </div>


    <div class="column-r">

    </div>



</div>

<!-- add TASK SUCCESS-->

<div class="modal fade" tabindex="-1" role="dialog" id="addTaskSuccess" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">

            <div class="modal-body" id="addTaskSuccessBody">

                <h2>Salvestatud!</h2>
                <h4>Sisestatud tehing on edukalt salvestatud.</h4>

            </div>
        </div>
    </div>
</div>

<!-- delete TASK SUCCESS-->

<div class="modal fade" tabindex="-1" role="dialog" id="deleteTaskSuccess" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body" id="deleteTaskSuccessBody">
                <H2>Kustutatud!</H2>
                <h4>Tegevus on edukalt kustutatud.</h4>
            </div>
        </div>
    </div>
</div>



<!-- addTask -->

<script>
    $("#addTask").click(function () {
        var activityDescription = $("#activityDescriptionId").val();

        var deadlineDate = picker.toString();

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

                $('body').click(function(){
                    location.reload();
                })


            } else {
                console.log("pole korras");


                $('#addTransactionError').modal('show');

            }
        });
    })

</script>

<!-- picker -->

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

