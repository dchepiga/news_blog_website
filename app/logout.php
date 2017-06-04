<?php
include_once('config/config.php');
session_start();
session_destroy();
header("Location: http://".$_SERVER['HTTP_HOST'].PROJECT_ROOT);