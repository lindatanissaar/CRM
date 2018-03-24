<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?= BASE_URL ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/assets/ico/favicon.png">

    <title><?= PROJECT_NAME ?></title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/components/bootstrap/css/bootstrap.min.css?<?=COMMIT_HASH?>" rel="stylesheet">

    <!-- jQuery UI core CSS -->
    <link href="vendor/components/jqueryui/themes/base/jquery-ui.min.css?<?=COMMIT_HASH?>" rel="stylesheet">

    <!-- Site core CSS -->
    <link href="assets/css/main.css?<?=COMMIT_HASH?>" rel="stylesheet">

    <!-- Pikaday CSS -->

    <link href="node_modules/pikaday/css/pikaday.css" rel="stylesheet">

    <!-- Animate modal CSS -->

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.0/animate.min.css">






    <style>
        body {
            padding-top: 70px;
        }

        body {
            background-color: #F8F8F8;
        }

        .btn-basic {
            background-color: transparent;
            border-color: transparent;
            font-weight: 600;
        }

        .btn-success {
            background-color: #38B87C;
            border-color: #38B87C;
            -webkit-transition: background-color 1s, border-color 1s ; /* Safari */
            transition: background-color 1s, border-color 1s;
        }

        .btn-success:hover {
            background-color: #2c9363;
            border-color: #2c9363;
        }

        .btn-success:focus {
            background-color: #2c9363;
            border-color: #2c9363;
            outline: none;
        }

        .btn-success:active {
            background-color: #2c9363;
            border-color: #2c9363;
        }

        .column-l {
            width: 90%;
            display: inline-block;
            background-color: white;
            padding: 30px;
            box-shadow: 0 4px 6px 0 hsla(0, 0%, 0%, 0.2);

        }

        .content {
            width: 90%;
            background-color: white;
            padding: 30px;
            margin: auto;
            margin-top: 5%;
            box-shadow: 0 4px 6px 0 hsla(0, 0%, 0%, 0.2);

        }

        .pie, .bar {
            box-shadow: 0 4px 6px 0 hsla(0, 0%, 0%, 0.2);

        }

        .column-r {
            width: 8%;
            display: inline-block;
        }

        .container {
            width: 85%;
        }

        .nav.navbar-nav {
            padding-top: 18px;
        }

        .navbar-default {
            border: none;
            background-color: #F0F0F0;
        }

        .navbar-default .navbar-nav>.active>a {
            background-color: #F0F0F0;
            font-weight: bold;
        }

        #loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('assets/img/icon-loader.gif') 50% 50% no-repeat rgb(128, 128, 128);
            opacity: .98;
        }

        .row {
            margin-top: 30px;
            padding-left: 15px;
            padding-right: 15px;
        }


        .column-right {
            float: right;
            display: inline-block;
        }

        .column-left {
            display: inline-block;
        }

        #displayTunnel, #displayTable, #changeTableColumns {
            margin-left: 20px;
        }

        /* Kasutaja profiil, nimi, pilt*/

        #user-picture {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            padding:4px;
        }

        #user-name, #user-picture {
            display: inline-block;
        }

        .user-account {
            display: inline-block;
        }

        /* transaction modal*/

        #name {
            font-size: 14px;
        }

        h4 {
            font-size: 14px;
            color: hsl(0, 0%, 13%);
            font-weight: 700;
        }

        label {
            font-weight: 600;
            color: hsl(0, 0%, 29%);

        }

        .right-side {
            margin-top: 50px;
        }


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

        .form-control {
            box-shadow: none;
            border-color: #e7e7e7;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #e7e7e7;
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
            background-color: hsl(220, 12%, 95%);
            border-bottom: none;
        }

        .modal-footer {
            background-color: hsl(220, 12%, 95%);
            border-top: none;
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


        /*TABLE *>
        /* table sorting CSS*/

        th.header {
            cursor: pointer;
            background-repeat: no-repeat;
            background-position: right center;
            padding-left: 60px;
            margin-left: -1px;
            background-size: 18px;
        }

        th.headerSortUp {
            background-image: url('assets/img/asc.png') !important;
            background-color: #eee;
            background-size: 18px;

        }

        th.headerSortDown {
            background-image: url('assets/img/desc.png') !important;
            background-color: #eee;
            background-size: 18px;

        }

        /* table css*/

        .table {
            font-family: Verdana;
        }

        th.header {
            border-right: 0;
            color: grey;
            font-weight: 500;
        }

        .price {
            text-align: right;
            background-position: left center !important;

        }

        .table>tbody>tr>td {
            padding: 16px;
            border-top: 1px solid #eee;
        }

        .editAndDeleteTable {
            border-top: 0 !important;
        }


        .table>thead>tr>th {
            border-bottom: 3px solid #eee;
            padding: 16px;
        }

        .table>thead:first-child>tr:first-child>th {
            border-top: 3px solid #eee;

        }

        .editAndDeleteTable, .date, .phone {
            width: 10%;
        }

        .organisation_name, .note {
            width: 15%;
        }


        .editTableRow {
            -webkit-filter: grayscale(100%);
            opacity: 0.2;
        }

        .editTableRow:hover {
            -webkit-filter: grayscale(0%);
            opacity: 1;

            -webkit-transition: all 0.2s ease;
            -moz-transition: all 0.2s ease;
            -o-transition: all 0.2s ease;
            -ms-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        .deleteTableRow {
            -webkit-filter: grayscale(100%);
            opacity: 0.2;
        }

        .deleteTableRow:hover {
            -webkit-filter: grayscale(0%);
            opacity: 1;

            -webkit-transition: all 0.2s ease;
            -moz-transition: all 0.2s ease;
            -o-transition: all 0.2s ease;
            -ms-transition: all 0.2s ease;
            transition: all 0.2s ease;
        }

        /* table statuses*/

        .status_won span {
            background-color: #38B87C;
            padding: 5px 10px 5px 10px;
            border-radius: 4px;
            color: white;
        }

        .status_lost span {
            background-color: #f6ccd1;
            padding: 5px 10px 5px 10px;
            border-radius: 4px;
            color: #dc4d5d;
        }

        .status_unknown span {
            background-color: #CDD5D1;
            padding: 5px 10px 5px 10px;
            border-radius: 4px;
        }


        /* search transactions*/

        .results tr[visible='false'],
        .no-result{
            display:none;
        }

        .results tr[visible='true']{
            display:table-row;
        }

        .counter{
            padding:8px;
            color:#ccc;
            display: inline-block !important;
        }

        .paginationResults {
            padding:8px;
            color:#303030;
            display: inline-block !important;
        }

        #pglmtLabel {
            font-weight: 500;
            color: #303030;
        }

        .search {
            display: inline-block !important;
            background: url(assets/img/icon-search.png) no-repeat scroll 7px 7px;
            padding-left:40px;
            border-radius: 6px !important;

        }

        .table>thead>tr.warning>td {
            background-color: white;
            color: #dc4d5d;
        }

        #filterTableNoResults {
            float: right;
            background-color: #5cb85c;
            display: none;
            height: 40px;
            margin: 0;
        }


    </style>




    <!-- jQuery -->
    <script src="vendor/components/jquery/jquery.min.js?<?=COMMIT_HASH?>"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js?<?=COMMIT_HASH?>"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js?<?=COMMIT_HASH?>"></script>
    <![endif]-->


</head>

<body>


<div id = "loader"></div>

<script type = "text/javascript">
    setTimeout(function() {
        document.getElementById("loader").style.display="none";
    }, 1000);  // 5 seconds
</script>



<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="assets/img/logo-kodulehekoolitused.png"/></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav mx-auto">
                <li <?= $controller == 'welcome' ? 'class="active"' : '' ?>><a href="#">Home</a></li>
                <li <?= $controller == 'halo' ? 'class="active"' : '' ?>><a href="halo">Halo admin</a></li>
                <li <?= $controller == 'projects' ? 'class="active"' : '' ?>><a href="projects">Tehingud</a></li>
                <li <?= $controller == 'tasks' ? 'class="active"' : '' ?>><a href="tasks">Tegevused</a></li>
                <li class="dropdown">

                    <a href="statistics" class="dropdown-toggle account-section" data-toggle="dropdown">Statistika<b class="caret"></b></>
                    <ul class="dropdown-menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="wonProject">Võidetud pojektid</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="lostProjects">Kaotatud pojektid </a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="unknownProjects">Pole teada pojektid</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="completedProjects">Lõpetatud pojektid</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <div class="user-account">
                        <img id="user-picture" src="assets/img/logo_Linda.jpg" />
                    </div>
                    <a id="user-name" href="#" class="dropdown-toggle account-section" data-toggle="dropdown"><?= $auth->name ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="admins"><? __('Action') ?></a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="admins">Profiili seaded</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="admins">Admin tegevused</a></li>
                        <li role="presentation" class="divider"></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="logout">Logi välja</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</nav>

<div class="container">





    <!-- Main component for a primary marketing message or call to action -->
    <?php if (!file_exists("views/$controller/{$controller}_$action.php")) error_out('The view <i>views/' . $controller . '/' . $controller . '_' . $action . '.php</i> does not exist. Create that file.'); ?>
    <?php @require "views/$controller/{$controller}_$action.php"; ?>
    
</div>
<!-- /container -->

<?php require 'templates/partials/error_modal.php'; ?>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="vendor/components/bootstrap/js/bootstrap.min.js?<?=COMMIT_HASH?>"></script>
<script src="vendor/components/jqueryui/jquery-ui.min.js?<?=COMMIT_HASH?>"></script>
<script type="text/javascript" src="assets/js/jquery.tablesorter.min.js"></script>
<script src="node_modules/pizza-master/dist/js/pizza.js"></script>
<script src="node_modules/pizza-master/dist/js/vendor/modernizr.js"></script>
<script src="node_modules/pizza-master/dist/js/vendor/dependencies.js"></script>
<script src="node_modules/pizza-master/js/pizza/pie.js"></script>
<script src="node_modules/pizza-master/js/pizza/line.js"></script>
<script src="node_modules/pizza-master/js/pizza/bar.js"></script>

<script src="node_modules/js-cookie/src/js.cookie.js"></script>








<script src="assets/js/main.js?<?=COMMIT_HASH?>"></script>


</body>
</html>
<?php require 'system/error_translations.php' ?>
