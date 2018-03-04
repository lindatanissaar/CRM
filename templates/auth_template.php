<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?= BASE_URL ?>">
    <title><?= PROJECT_NAME ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="vendor/components/bootstrap/css/bootstrap.min.css?<?=COMMIT_HASH?>">
    <link rel="stylesheet" href="vendor/components/bootstrap/css/bootstrap-theme.min.css?<?=COMMIT_HASH?>">
    <script src="vendor/components/jquery/jquery.min.js?<?=COMMIT_HASH?>"></script>
    <script src="vendor/components/bootstrap/js/bootstrap.min.js?<?=COMMIT_HASH?>"></script>

    <style>
        body {
            padding-top: 50px;
            background: url("assets/img/test.jpg") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        .alert-danger {
            background-image: none;
            border: none;
        }

        .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }

        .form-signin .form-signin-heading,
        .form-signin .checkbox {
            margin-bottom: 10px;
        }

        .form-signin .checkbox {
            font-weight: normal;
        }

        .form-control, .form-control:focus {
            border-top: none;
            border-left: none;
            border-right: none;
            box-shadow: none;
            border-bottom: solid 2px #d4d4d4;

        }

        .form-signin .form-control {
            position: relative;
            font-size: 16px;
            height: auto;
            padding: 10px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .btn-primary {
            background-color: #38B87C;
            background-image: none;
            border-color: #38B87C;
        }

        .modal-input input[type="text"] {
            margin-bottom: -1px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        .modal-input input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        span.input-group-addon {
            width: 50px;
        }

        div.input-group {
            width: 100%;
        }

        form.form-signin {
            background-color: #ffffff;
        }

        body {
            padding: 0;
        }

        .header {
            height: 15px;
            background-color: #38B87C;
        }

        .container {
            padding-top: 100px;
        }

        #user {
            background: url(assets/img/icon-contactperson.png) no-repeat scroll 7px 7px;
            padding-left:30px;
        }

        #pass {
            background: url(assets/img/key.png) no-repeat scroll 7px 7px;
            padding-left:30px;
        }


    </style>
</head>

<body>

<div class="header"></div>

<div class="container">

    <form class="form-signin" method="post">

        <h2 class="form-signin-heading"><?= __('Log in') ?></h2>

        <?php if (isset($errors)) {
            foreach ($errors as $error): ?>
                <div class="alert alert-danger">
                    <?= $error ?>
                </div>
            <?php endforeach;
        } ?>



        <div class="input-group">
            <input id="user" name="email" type="text" class="form-control" placeholder="Username" autofocus>
        </div>

        <br/>


        <div class="input-group">
            <input id="pass" name="password" type="password" class="form-control" placeholder="Password">
        </div>

        <br/>

        <button class="btn btn-lg btn-primary btn-block" type="submit"><?= __('Sign in') ?></button>
    </form>

</div>
<!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
</body>
</html>
