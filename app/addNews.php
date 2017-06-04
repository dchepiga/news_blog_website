<?php
include_once('config/config.php');

require_once('db.php');

var_dump($_POST);
var_dump($_FILES);

if (!empty($_POST)) {
    if (array_key_exists('titleNews', $_POST)) {

        $image = null;

        if ($_FILES['imageNews']['size'] <= 3145728 || $_FILES['imageNews']['type'] == 'image/jpeg') {
            $filename = mb_convert_encoding(basename($_FILES['imageNews']['name']), "UTF-8");

            $uploadfile = $uploaddir . $filename;
            if (move_uploaded_file($_FILES['imageNews']['tmp_name'], $uploadfile)) {
                $image = basename($_FILES['imageNews']['name']);
            }
        }

        $id = addNews($_POST['titleNews'], $_POST['textNews'], $image, $_POST['catNews']);
        foreach($_POST['tagsNews'] as $key => $tag){
            addTagsToNews($tag,$id);
        }



    }
}
header("Location: http://" . $_SERVER['HTTP_HOST'] . PROJECT_ROOT . '/admin.php');
