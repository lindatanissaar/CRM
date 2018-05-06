<style>

    #searchTasksInput {
        padding-right: 10%;
        border: 1px solid #e7e7e7;
    }

    .searchTasksInput {
        display: inline-block !important;
    }

    #daterangepicker {
        background-color: white;
        border: 1px solid #e7e7e7;
        text-align: center;
        border-radius: 4px;
    }

    .daterange {
        display: inline-block !important;
    }

    .displayNone {
        display: none;
    }

    .column-l {
        -webkit-box-shadow: 0 4px 2px -2px #777;
        -moz-box-shadow: 0 4px 2px -2px #777;
        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.2), 0 5px 19px 0 rgba(0, 0, 0, 0.19);
        border-radius: 10px;
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

    .pageLimit {
        float: left;
    }

    #pg_tasksTable {
        float: left;
    }

    .form-group {
        display: inline-block;
    }

    #pglmtTask {
        width: 20%;
        text-align: left;
    }

    #pglmtLabel, #pglmtTask {
        display: inline-block;
    }

    .pglmt {
        text-align: left;
    }


</style>

<script src="node_modules/table-paging/jquery.table.hpaging.js"></script>
<script src="node_modules/moment/moment.js"></script>
<script src="node_modules/pikaday/pikaday.js"></script>


<!--use tooltips -->

<script>

    $(function () {
        $(document).tooltip();
    });

</script>


<!-- sort table -->

<script>
    $(document).ready(function () {

            var i = $("td.date").index();

            $("#tasksTable").tablesorter({
                dateFormat: 'pt',
                sortList: [[i, 0]]
            });
        }
    )
</script>


<!-- filter table no results-->

<div class="content">
    <div class="row">

        <div class="column-left">

            <div class="input-group searchTasksInput">
                <input type="text" class="form-control input-md search" id="searchTasksInput" placeholder="Otsi">
            </div>
            <span class="counter"></span>

            <div class="input-group daterange">
                <input type="text" class="form-control input-md" id="daterangepicker">
            </div>
        </div>

        <div class="column-right">

            <a title="Muuda tabeli veerge"><img id="changeTableColumns" src="assets/img/icon-add.png"/></a>



            <button type="button" class="btn btn-basic addTaskButton" data-focus="false" data-toggle="modal"
                    data-keyboard="true"
                    data-target="#myModal">Lisa tegevus
            </button>

            <button type="button" id="updateTaskTable" class="btn btn-success" data-focus="false" data-toggle="modal"
                    data-keyboard="true">Salvesta
            </button>

        </div>

    </div>

    <div class="row">
        <div class="table-responsive">
            <div class="pageLimit">
                <div class="form-group pglmt">
                    <label id="pglmtLabel" for="pglmtTask">Näita: </label>
                    <input id="pglmtTask" title="Ridade arv" value="5" class="form-control input-sm">
                    <div class="paginationResults"></div>
                </div>
            </div>

            <table class="table tablesorter results" id="tasksTable">

                <thead class="header" id="tableHeader">
                <tr>
                    <th class="activityDescription">Nimetus</th>
                    <th class="employeeName">Vastutaja</th>
                    <th class="taskTransactionName">Seosta tehinguga</th>
                    <th class="date">Tähtaeg</th>
                </tr>

                <tr class="warning no-result">
                    <td colspan="1"><i class="fa fa-warning"></i>Tulemused puuduvad</td>
                </thead>

                <tbody class="tasksTableBody">

                <?php foreach ($activities as $activity): ?>
                    <tr id="<?= $activity['ID'] ?>">
                        <td class="activityDescription" contenteditable><?= $activity['DESCRIPTION'] ?></td>
                        <td class="employeeName"
                        "<?= $activity['FIRST_NAME'] . " " . $activity['LAST_NAME'] ?>"
                        contenteditable><?= $activity['FIRST_NAME'] . " " . $activity['LAST_NAME'] ?></td>
                        <td class="taskTransactionName" contenteditable><?= $activity['NAME'] ?></td>
                        <td class="date"
                            contenteditable><?= date("d/m/Y", strtotime($activity['DEADLINE_DATE'])) ?></td>
                        <td class="editAndDeleteTable">
                            <a title="Kogu tegevuse kustutamine" class="deleteTableRow"><img
                                        src="assets/img/icon-delete.png"/></a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>

            </table>


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
                                            <input type="text" class="form-control col-lg-8"
                                                   placeholder="Tegevuse nimetus"
                                                   id="activityDescriptionId" list="activityDescription">
                                            <datalist id="activityDescription">
                                                <?php foreach ($activity_descriptions as $activity_description): ?>
                                                    <option id="<?= $activity_description['ID'] ?>"><?= $activity_description['DESCRIPTION'] ?></option>
                                                <?php endforeach; ?>
                                            </datalist>
                                        </div>

                                        <div class="form-group col-lg-4">
                                            <label for="datepicker">Tähtaeg:</label>

                                            <input type="text" class="form-control input-sm" id="datepicker"
                                                   placeholder="Tähtaeg">

                                        </div>
                                    </div>

                                    <div class="col-lg-4">

                                        <h4>Seosed</h4>
                                        <hr/>

                                        <div class="form-group">
                                            <input title="Vali 'Võidetud' tehingute seast" type="text"
                                                   class="form-control" placeholder="Seosta tehinguga"
                                                   id="transactionNameId" list="taskTransactionNameDatalist">
                                            <datalist id="taskTransactionNameDatalist">
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
                                                    <option id="<?= $employee['ID'] ?>"><?= $employee['FIRST_NAME'] . " " . $employee['LAST_NAME'] ?></option>
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
                                <button id="saveTaskAndAddNew" type="button" class="btn btn-basic">Salvesta ja lisa
                                    uus
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

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

                $('body').click(function () {
                    location.reload();
                })


            } else {
                console.log("pole korras");


            }
        });
    })

</script>


<!-- picker -->


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

<script type="text/javascript" src="node_modules/daterangepicker/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="node_modules/daterangepicker/daterangepicker.css"/>

<script>

    function applyDateRange() {

        var dateStartDate = $('#daterangepicker').data('daterangepicker').startDate;
        var dateEndDate = $('#daterangepicker').data('daterangepicker').endDate;

        var startDate = $('#daterangepicker').data('daterangepicker').startDate._d;
        var endDate = $('#daterangepicker').data('daterangepicker').endDate._d;


        var dateFormatStart = GetDateFormat(startDate);
        var dateFormatEnd = GetDateFormat(endDate);

        dateStartDate = formatStringToDate(dateFormatStart);
        dateEndDate = formatStringToDate(dateFormatEnd);

        var count;


        $(".tasksTableBody").find("tr").each(function () { //get all rows in table

            var dateValue = $(this).find('.date').text();

            dateValue = formatStringToDate(dateValue);
            console.log(dateStartDate);
            console.log(dateEndDate);
            console.log(dateValue);

            if (dateValue >= dateStartDate && dateValue <= dateEndDate) {
                $(this).removeClass("displayNone");

            } else {
                $(this).addClass("displayNone");
            }


            if (!$(this).hasClass("displayNone")) {
                count++;
            }

        })

        if (count != 0) {

            $("#filterTableNoResults").show("slide", {direction: "right"}, 1000);

            $("#filterTableNoResults").delay(1000);

            $("#filterTableNoResults").hide("slide", {direction: "right"}, 1000);

        }
    }

    function GetDateFormat(date) {
        var month = (date.getMonth() + 1).toString();
        month = month.length > 1 ? month : '0' + month;
        var day = date.getDate().toString();
        day = day.length > 1 ? day : '0' + day;
        return day + '/' + month + '/' + date.getFullYear();
    }

    function formatStringToDate(dateString) {

        var dateParts = dateString.split("/");

        var dateObject = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]); // month is 0-based

        return dateObject;

    }


</script>

<script>

    $(function () {

        var start;
        var end;
        start = moment().subtract(29, 'days');
        end = moment();
        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }

        $('#daterangepicker').daterangepicker({
            startDate: start,
            endDate: end,

            "locale": {
                "format": "DD/MM/YYYY",
                "separator": " - ",
                "applyLabel": "Rakenda",
                "cancelLabel": "Katkesta",
                "fromLabel": "Alates",
                "toLabel": "Kuni",
                "customRangeLabel": "Custom",
                "daysOfWeek": [
                    "P",
                    "E",
                    "T",
                    "K",
                    "N",
                    "R",
                    "L"
                ],
                "monthNames": [
                    "Jaanuar",
                    "Veebruar",
                    "Märts",
                    "Aprill",
                    "Mai",
                    "Juuni",
                    "Juuli",
                    "August",
                    "September",
                    "Oktoober",
                    "November",
                    "Detsember"
                ],
                "firstDay": 1
            }

        }, cb);

        cb(start, end);


    })

</script>


<script>
    $(".deleteTableRow").click(function () {
        var activity_id = $(this).parent().parent().attr('id');

        // make $.post query
        $.post("tasks/deleteTableRow", {
            activity_id: activity_id
        }).done(function (data) {
            if (data == "success") {
                console.log("korras");
                location.reload();
                $('#deleteTransactionSuccess').modal('show');
                $('body').click(function () {
                    location.reload();
                })


            } else {
                console.log("pole korras");
                $('body').click(function () {
                    location.reload();
                })
            }
        });
    });
</script>


<!-- pagination -->

<script>

    $(function () {
        var lmt = Cookies.get('taskLimit');
        if (lmt == undefined) {
            $("#tasksTable").hpaging({"limit": 5});
        } else {
            $("#tasksTable").hpaging({"limit": lmt});
        }

        if (lmt != undefined) {
            $('#pglmtTask').attr('value', lmt);
        }


    });


    $("#pglmtTask").keyup(function () {
        var lmt = $(this).val();
        if (lmt == "" || lmt == "0") {
            console.log("siin");
        } else {
            $("#tasksTable").hpaging("newLimit", lmt);
        }

        var numOfVisibleRows = $('tbody tr:visible').length;

        var allResults = $('tbody tr').length;

        $('.paginationResults').text(numOfVisibleRows + ' rida ' + allResults + "-st");
    });

    $("#pglmtTask").blur(function () {
        var lmt = $(this).val();
        if (lmt == "" || lmt == "0") {
        } else {
            Cookies.set('taskLimit', lmt);
        }
    });
</script>

<script>


    $("#changeTableColumns").click(function () {
        if (Cookies.get('activityDescription') == "none") {
            $("#taskName").prop('checked', false);
        } else {
            $("#taskName").prop('checked', true);
        }

        if (Cookies.get('employeeName') == "none") {
            $("#supervisor").prop('checked', false);
        } else {
            $("#supervisor").prop('checked', true);
        }

        if (Cookies.get('taskTransactionName') == "none") {
            $("#transaction").prop('checked', false);
        } else {
            $("#transaction").prop('checked', true);
        }

        if (Cookies.get('taskDate') == "none") {
            $("#taskDate").prop('checked', false);
        } else {
            $("#taskDate").prop('checked', true);
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
                    <input class="form-check-input" type="checkbox" value="" id="taskName">
                    <label class="form-check-label" for="taskName">
                        Nimetus
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="supervisor">
                    <label class="form-check-label" for="supervisor">
                        Vastutaja
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="transaction">
                    <label class="form-check-label" for="transaction">
                        Seosta tehinguga
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="taskDate">
                    <label class="form-check-label" for="taskDate">
                        Tähtaeg
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- search from tasks table-->

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

            } else {
                $('.counter').text(jobCount + ' tulemust');

            }

            if ($("#searchTasksInput").val() == "") {
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
        if (Cookies.get('taskTransactionName') == "none") {
            $(".taskTransactionName").hide();
        } else {
            $(".taskTransactionName").show();
        }

        if (Cookies.get('activityDescription') == "none") {
            $(".activityDescription").hide();
        } else {
            $(".activityDescription").show();
        }

        if (Cookies.get('employeeName') == "none") {
            $(".employeeName").hide();
        } else {
            $(".employeeName").show();
        }

        if (Cookies.get('taskDate') == "none") {
            $(".date").hide();
        } else {
            $(".date").show();
        }

        $("#taskName").blur(function () {
            if ($("#taskName").is(":checked")) {
                $(".activityDescription").show();
                Cookies.set('activityDescription', 'display');


            } else {
                $(".activityDescription").hide();
                Cookies.set('activityDescription', 'none');

            }
        })

    })

    $("#supervisor").blur(function () {
        if ($("#supervisor").is(":checked")) {
            $(".employeeName").show();
            Cookies.set('employeeName', 'display');

        } else {
            $(".employeeName").hide();
            Cookies.set('employeeName', 'none');

        }
    })

    $("#transaction").blur(function () {
        if ($("#transaction").is(":checked")) {
            $(".taskTransactionName").show();
            Cookies.set('taskTransactionName', 'display');


        } else {
            $(".taskTransactionName").hide();
            Cookies.set('taskTransactionName', 'none');
        }
    })

    $("#taskDate").blur(function () {
        if ($("#taskDate").is(":checked")) {
            $(".date").show();
            Cookies.set('taskDate', 'display');


        } else {
            $(".date").hide();
            Cookies.set('taskDate', 'none');


        }
    })

</script>


<!-- edit table data -->

<script>

    $(function () {
        var activityDescription = {};
        var employeeName = {};
        var taskTransactionName = {};
        var date = {};
        $('.activityDescription').each(function () {
            $(this).blur(function () {
                activityDescription[$(this).parent().attr("id")] = $(this).text();
                $("#updateTaskTable").addClass("opacitySaveButton");
            })
        })

        $('.employeeName').each(function () {
            $(this).blur(function () {
                employeeName[$(this).parent().attr("id")] = $(this).text();
                $("#updateTaskTable").addClass("opacitySaveButton");
            })
        });

        $('.taskTransactionName').each(function () {
            $(this).blur(function () {
                taskTransactionName[$(this).parent().attr("id")] = $(this).text();
                $("#updateTaskTable").addClass("opacitySaveButton");
            })
        });

        $('.date').each(function () {
            $(this).blur(function () {
                date[$(this).parent().attr("id")] = $(this).text();
                $("#updateTaskTable").addClass("opacitySaveButton");
            })
        });

        $('#updateTaskTable').click(function () {
            activityDescription = JSON.stringify(activityDescription);
            taskTransactionName = JSON.stringify(taskTransactionName);
            employeeName = JSON.stringify(employeeName);
            date = JSON.stringify(date);
            // make $.post query
            $.post("tasks/updateTaskTable", {
                data: {activityDescription: activityDescription,
                    taskTransactionName: taskTransactionName,
                    date: date,
                    employeeName: employeeName
                }
            }).done(function (data) {
                if (data == "success") {
                    console.log("korras");
                    location.reload();
                    $('#deleteTransactionSuccess').modal('show');
                    $('body').click(function () {
                        location.reload();
                    })

                } else {
                    console.log("pole korras");
                    $('body').click(function () {
                        location.reload();
                    })
                }
            });
        });
    })


</script>


















