<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Jumbotron Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?= PROJECT_ROOT ?>/assets/css/bootstrap.min.css">


    <!-- Custom styles for this template -->
    <link href="<?= PROJECT_ROOT ?>/assets/css/jumbotron.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?= PROJECT_ROOT ?>/assets/css/search.css"/>
    <link rel="stylesheet" type="text/css" href="<?= PROJECT_ROOT ?>/assets/css/style.css"/>




</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="<?= PROJECT_ROOT ?>">Home</a></li>
            </ul>

            <?php if (!array_key_exists('auth', $_SESSION)): ?>

                <form method="post" action="app/login.php" class="navbar-form navbar-right">
                    <div class="form-group">
                        <input type="email" placeholder="Email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" placeholder="Password" class="form-control" name="passwd" required>
                    </div>
                    <button type="submit" class="btn btn-success">Sign in</button>
                </form>
            <?php else:

                ?>
                <a id="logout" href="app/logout.php" class="btn btn-success pull-right btn-header">
                    <?= $_SESSION['auth'] . ' (Logout)' ?></a>
                <?php
                require_once 'db.php';
                $user = $_SESSION['auth'];
                if (isAdmin($user)):?>
                    <a id="admin-button" href="admin.php" class="btn btn-success pull-right btn-header">
                        Admin panel</a>

                    <?php
                endif;

            endif; ?>

        </div><!--/.navbar-collapse -->
    </div>
</nav>
