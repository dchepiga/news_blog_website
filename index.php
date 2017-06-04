<?php
session_start();
require_once('app/config/config.php');


require_once('app/header.php');
require_once('app/tag_search.php');



if (array_key_exists('cat_id', $_GET)) {
    require_once('category.php');

}

elseif(array_key_exists('news_id', $_GET)){
    require_once('news.php');

}
elseif(array_key_exists('tag_id', $_GET)){
    require_once('tag.php');

}
else{
    require_once('app/main.php');

}

require_once('app/footer.php');