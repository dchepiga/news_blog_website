<?php
include_once('config/config.php');

require_once('db.php');

if (!empty($_POST)) {
    if (array_key_exists('catName', $_POST)) {
        $title = $_POST['catName'];
        addCategory($title);
    }
}
header("Location: http://" . $_SERVER['HTTP_HOST'] . PROJECT_ROOT.'/admin.php');
