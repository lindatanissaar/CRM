<style>

    .column-l {
        width: 60%;
        margin-right: 3%;
        vertical-align: top;
    }

    .column-r {
        width: 35%;
        display: inline-block;
    }

    #daterangepicker {
        background-color: white;
        border: 1px solid #e7e7e7;
        text-align: center;
        border-radius: 4px;
        margin-bottom: 15px;
        margin-top: 10px;
    }

    #searchWonProjectsInput {
        display: inline-block;
    }

    #bar {
        width: 75%;
        margin: auto;

    }

    #pie, #bar {
        margin-bottom: 10%;
    }

    .bar, .pie {
        background-color: white;
    }

    svg {
        padding: 60px;
    }

    /* pagination */
    .pagination {
        display: inline-block;
        margin: 0;
    }

    .pagination a {
        color: black;
        float: left;
        padding: 5px 9px;
        text-decoration: none;
    }

    .pagination a.active {
        background-color: #38B87C;
        color: white;
    }

    .pagination a:hover:not(.active) { background-color: #ddd; }

    #btnApplyPagination {
        background-color: #dc4d5d;
        border-color: #dc4d5d;
    }

    #pg_unknownProjects {
        float: right;
    }

    .form-group {
        display: inline-block;
    }

    #pglmt {
        width:20%;
        text-align: center;
    }

    #pglmtLabel, #pglmt {
        display: inline-block;
    }

    .pglmt {
        text-align: center;
    }
    .pageLimit {
        float: right;
    }


</style>



<link href="node_modules/pizza-master/dist/css/pizza.css" media="screen, projector, print" rel="stylesheet" type="text/css" />
<script src="node_modules/moment/moment.js"></script>
<script type="text/javascript" src="node_modules/daterangepicker/daterangepicker.js"></script>
<link rel="stylesheet" type="text/css" href="node_modules/daterangepicker/daterangepicker.css"/>
<script src="node_modules/table-paging/jquery.table.hpaging.js"></script>


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

            if($("#searchTasksInput").val()== ""){
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


<!-- Table sort default by date -->

<script>
    $(document).ready(function () {

        var i = $("td.date").index();

        $("#unknownProjects").tablesorter({
            dateFormat: 'pt',
            sortList: [[i, 0]]
        });
    })

</script>

<div class="row">

    <div class="column-l">

    <h3>Pole teada tehingud</h3>

    <div class="table-responsive">

        <div class="input-group">
            <input type="text" class="form-control input-md" id="daterangepicker">
        </div>
        <div class="input-group">
            <input type="text" class="form-control input-md search" id="searchTasksInput" placeholder="Otsi">
        </div>
        <span class="counter"></span>

        <div class="pageLimit">
            <div class="form-group pglmt">
                <label id="pglmtLabel" for="pglmt">Näita: </label>
                <input id="pglmt" title="Ridade arv"  value="5" class="form-control input-sm">
                <div class="paginationResults"></div>
            </div>
        </div>

        <table class="table tablesorter results"  id="unknownProjects">

            <thead  class="header" id="tableHeader">
            <tr title="Sorteeri tabelit veergude järgi">
                <th>Ettevõtte nimetus</th>
                <th>Tehingu nimetus</th>
                <th class="price">Väärtus</th>
                <th class="date">Tähtaeg</th>
                <th>Märkus</th>
            </tr>

            <tr class="warning no-result">
                <td colspan="1"><i class="fa fa-warning"></i>Tulemused puuduvad</td>
            </thead>

            <tbody>

            <?php foreach ($transactions as $transaction): ?>
                <tr id="<?= $transaction['ID'] ?>">
                    <td class="organisation_name" contenteditable><?= $transaction['ORGANISATION_NAME'] ?></td>
                    <td class="transaction_name" contenteditable><?= $transaction['NAME'] ?></td>
                    <td class="price" contenteditable><?= round($transaction['PRICE'], 2) . " €" ?></td>
                    <td class="date"
                        contenteditable><?= date("d/m/Y", strtotime($transaction['DEADLINE_DATE'])) ?></td>
                    <td class="note" contenteditable><?= $transaction['NOTE'] ?></td>
                </tr>
            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>
    <div class="column-r">
        <div class="pie">
            <ul data-pie-id="pie"data-options='{animation_speed: 200,
  animation_type: "backin"}'>
                <?php foreach ($wonProjects as $wonProject): ?>

                    <li data-value="<?= (int)$wonProject['wonProjectsNumber'] ?>">Võidetud/töös tehingud (<?= (int)$wonProject['wonProjectsNumber'] ?>)</li>
                <?php endforeach; ?>

                <?php foreach ($completedProjects as $completedProject): ?>
                    <li data-value="<?= (int)$completedProject['completedProjectsNumber'] ?>">Võidetud/lõpetatud tehingud (<?= (int)$completedProject['completedProjectsNumber'] ?>)</li>
                <?php endforeach; ?>

                <?php foreach ($lostProjects as $lostProject): ?>

                    <li data-value="<?= (int)$lostProject['lostProjectsNumber'] ?>">Kaotatud tehingud (<?= (int)$lostProject['lostProjectsNumber'] ?>)</li>
                <?php endforeach; ?>

                <?php foreach ($unknownProjects as $unknownProject): ?>

                    <li data-value="<?= (int)$unknownProject['unknownProjectsNumber'] ?>">Pole teada tehingud (<?= (int)$unknownProject['unknownProjectsNumber'] ?>)</li>
                <?php endforeach; ?>

            </ul>
            <div id="pie"></div>
        </div>

        <div class="bar">
            <ul data-bar-id="bar">
                <?php foreach ($wonProjects as $wonProject): ?>

                    <li data-value="<?= (int)$wonProject['wonProjectsNumber'] ?>">Võidetud/töös tehingud (<?= (int)$wonProject['wonProjectsNumber'] ?>)</li>
                <?php endforeach; ?>

                <?php foreach ($completedProjects as $completedProject): ?>
                    <li data-value="<?= (int)$completedProject['completedProjectsNumber'] ?>">Võidetud/lõpetatud tehingud (<?= (int)$completedProject['completedProjectsNumber'] ?>)</li>
                <?php endforeach; ?>

                <?php foreach ($lostProjects as $lostProject): ?>

                    <li data-value="<?= (int)$lostProject['lostProjectsNumber'] ?>">Kaotatud tehingud (<?= (int)$lostProject['lostProjectsNumber'] ?>)</li>
                <?php endforeach; ?>

                <?php foreach ($unknownProjects as $unknownProject): ?>

                    <li data-value="<?= (int)$unknownProject['unknownProjectsNumber'] ?>">Pole teada tehingud (<?= (int)$unknownProject['unknownProjectsNumber'] ?>)</li>
                <?php endforeach; ?>
            </ul>

            <div class="large-8 small-8 columns">
                <div id="bar" style="height: 250px;"></div>
            </div>
        </div>
    </div>

</div>

<!-- pagination -->

<script>

    $(function () {
        var lmt = Cookies.get('unknownProjectsLimit');
        console.log(lmt);
        if (lmt == undefined) {
            $("#unknownProjects").hpaging({"limit": 5});
        } else {
            $("#unknownProjects").hpaging({"limit": lmt});
        }

        if (lmt != undefined) {
            $('#pglmt').attr('value', lmt);
        }
    });

    $("#pglmt").keyup(function () {
        var lmt = $(this).val();
        if (lmt == "" || lmt == "0") {
        } else {
            $("#unknownProjects").hpaging("newLimit", lmt);
        }

        var numOfVisibleRows = $('tbody tr:visible').length;

        var allResults = $('tbody tr').length;

        $('.paginationResults').text(numOfVisibleRows + ' rida ' + allResults + "-st");
    });

    $("#pglmt").blur(function () {
        var lmt = $(this).val();
        if (lmt == "" || lmt == "0") {
        } else {
            Cookies.set('unknownProjectsLimit', lmt);
        }
    });
</script>


<script>

    $(function(){
        Pizza.init();
    })


</script>

<script>

    function applyDateRange() {

        var startDate = $('#daterangepicker').data('daterangepicker').startDate._d;
        var endDate = $('#daterangepicker').data('daterangepicker').endDate._d;

        var dateFormatStart = GetDateFormat(startDate);
        var dateFormatEnd = GetDateFormat(endDate);

        dateStartDate = formatStringToDate(dateFormatStart);
        dateEndDate = formatStringToDate(dateFormatEnd);

        dateStart = getDateFormatMysql(dateStartDate);
        dateEnd = getDateFormatMysql(dateEndDate);

        $.post("unknownProjects/changeTable", {
            dateStart: dateStart,
            dateEnd: dateEnd
        }).done(function (data) {
            if (data == "success") {
                console.log("korras");
                location.reload();

            } else {
                console.log("pole korras");
            }
        });
    }

    function GetDateFormat(date) {
        var month = (date.getMonth() + 1).toString();
        month = month.length > 1 ? month : '0' + month;
        var day = date.getDate().toString();
        day = day.length > 1 ? day : '0' + day;
        return day + '/' + month + '/' + date.getFullYear();
    }

    function getDateFormatMysql(date){
        var month = (date.getMonth() + 1).toString();
        month = month.length > 1 ? month : '0' + month;
        var day = date.getDate().toString();
        day = day.length > 1 ? day : '0' + day;
        return date.getFullYear() + '-' + month + '-' + day;
    }

    function formatStringToDate(dateString) {

        var dateParts = dateString.split("/");

        var dateObject = new Date(dateParts[2], dateParts[1] - 1, dateParts[0]); // month is 0-based

        return dateObject;
    }

    function formatDate (input) {
        var datePart = input.match(/\d+/g),
            year = datePart[0].substring(2), // get only two digits
            month = datePart[1], day = datePart[2];

        return day+'/'+month+'/'+year;
    }



</script>

<script>

    $(function () {
        if(Cookies.get("dateStartUnknownProjects") == undefined || Cookies.get("dateEndUnknownProjects")== undefined){
            console.log("siin");
            start = moment().subtract(46, 'days');
            end = moment().add(46, 'days');
            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
        }else {
            console.log("siin2");
            start = Cookies.get("dateStartUnknownProjects");
            end = Cookies.get("dateEndUnknownProjects");
            console.log(start);
            console.log(end);
            start = formatDate(start);
            end = formatDate(end);
            function cb(start, end) {
                $('#reportrange span').html(start + ' - ' + end);
            }
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


