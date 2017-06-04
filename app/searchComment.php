<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once 'db.php';

    $search = $_POST['comId'];

    $result = getCommentById($search);
    if (!empty($result)) {
        echo $result[0]['comment'];
    } else {
        echo 'empty';
    }
}