<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once 'db.php';
    if (array_key_exists('red', $_POST)) {
        $red = $_POST['red'];
        $id = $_POST['id'];
        readOverall($id,$red);



    }


}

