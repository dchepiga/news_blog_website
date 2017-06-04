<?php
include_once('config/config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once 'db.php';
    if (array_key_exists('selected', $_POST)) {
        $ids = $_POST['selected'];
        foreach($ids as $key =>$value){
            approveComment($value);
        }

    }


}
header("Location: http://" . $_SERVER['HTTP_HOST'] . PROJECT_ROOT.'/admin.php');

