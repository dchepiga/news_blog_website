<?php
require_once 'db.php';
include_once('config/config.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once 'db.php';

    $text = $_POST['comText'];
    $id = $_POST['comId'];
    editComment($id,$text);

}
header("Location: http://" . $_SERVER['HTTP_HOST'] . PROJECT_ROOT.'/admin.php');

