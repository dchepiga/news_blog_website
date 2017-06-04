<?php
session_start();
include_once('config/config.php');

require_once('db.php');

if(!empty($_POST))
{
    if(array_key_exists('email',$_POST)){
        $user  = getUserByEmail($_POST['email']);
        var_dump($user);

        if (($user['email'] == $_POST['email'])
            && ($user['passwd'] == $_POST['passwd'])
        ) {
            $_SESSION['auth'] = $user['email'];
        }
    }
}
header("Location: http://" . $_SERVER['HTTP_HOST'] . PROJECT_ROOT);
