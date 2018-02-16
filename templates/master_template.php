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





    <style>
        body {
            padding-top: 70px;
        }

        #user-picture {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            padding:4px;
        }

        #user-name, #user-picture {
            display: inline-block;
        }


        .nav.navbar-nav {
            padding-top: 18px;
        }


        #myDiv {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('assets/img/icon-loader.gif') 50% 50% no-repeat rgb(249, 249, 249);
            opacity: .90;
        }

        .container {
            width: 85%;
        }

        .navbar-default {
            border: none;
        }

        .navbar-default .navbar-nav>.active>a {
            background-color: #f8f8f8;
            font-weight: bold;
        }

        .status_won span {
            background-color: #e5f6d3;
            padding: 5px 10px 5px 10px;
            border-radius: 4px;
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

<div id = "myDiv"></div>

<script type = "text/javascript">
    setTimeout(function() {
        document.getElementById("myDiv").style.display="none";
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
            <a class="navbar-brand" href="#"><?= PROJECT_NAME ?></a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?= $controller == 'welcome' ? 'class="active"' : '' ?>><a href="#">Home</a></li>
                <li <?= $controller == 'halo' ? 'class="active"' : '' ?>><a href="halo">Halo admin</a></li>
                <li <?= $controller == 'projects' ? 'class="active"' : '' ?>><a href="projects">Tehingud</a></li>
                <li <?= $controller == 'tasks' ? 'class="active"' : '' ?>><a href="tasks">Tegevused</a></li>
                <li <?= $controller == 'statistics' ? 'class="active"' : '' ?>><a href="statistics">Statistika</a></li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <div class="user-account">
                    <img id="user-picture" src="assets/img/logo_Linda.jpg" />
                    <a id="user-name" href="#" class="dropdown-toggle account-section" data-toggle="dropdown"><?= $auth->name ?> <b class="caret"></b></a>
                </div>
                <li class="dropdown">

                    <ul class="dropdown-menu">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><? __('Action') ?></a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Lisa tegevus</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Lisa tehing</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Lisa vastutaja</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Lisa tegevuse nimetus</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Vaata kõiki tehinguid</a></li>
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
<!-- tablesorter JS -->

<script type="text/javascript" src="assets/js/jquery.tablesorter.min.js"></script>



<script src="assets/js/main.js?<?=COMMIT_HASH?>"></script>
</body>
</html>
<?php require 'system/error_translations.php' ?>
