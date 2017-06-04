<div class="container">
<?php
if (array_key_exists('tag_id', $_GET)) {
    $id = $_GET['tag_id'];
    require_once('app/db.php');
    $paginationTemplate = file_get_contents('app/pagination.html');


    $page = empty($_GET['page']) ? 1 : $_GET['page'];
    $messagesCount = count(getNewsByTag($id));

    $offset = ($page - 1) * $messagesPerPage;
    $limit = $messagesPerPage;
    $news = getNewsByTag($id, $limit, $offset);

    echo '<div class="row">';
    $tagName = getTagById($id);


    echo ' <div class="col-md-4">';
    echo '<h2> ' . $tagName['title'] . '</a></h2>';
    echo '<p><ul>';
    foreach ($news as $key => $value) {
        echo '<li><p><a href="?news_id='.$key.'"> ' . $value . '</a></p></li>';
    }
    echo '</ul></p>';
    echo '</div>';


    echo '</div>';

    $numberOfPages = ($messagesCount <= $messagesPerPage) ? 1 : ceil($messagesCount / $messagesPerPage);
    $str = '';

    for ($i = 1; $i <= $numberOfPages; $i++) {
        $str .= '<li><a href="?tag_id='.$id.'&page=' . $i . '">' . $i . '</a></li>';
    }
    echo str_replace("%pages%", $str, $paginationTemplate);


}

