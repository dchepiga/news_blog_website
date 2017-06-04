<div class="container">
    <?php
    if (array_key_exists('cat_id', $_GET)) {
        $id = $_GET['cat_id'];
        require_once('app/db.php');
        $paginationTemplate = file_get_contents('app/pagination.html');


        $page = empty($_GET['page']) ? 1 : $_GET['page'];
        $messagesCount = count(getNewsByCat($id));

        $offset = ($page - 1) * $messagesPerPage;
        $limit = $messagesPerPage;
        $news = getNewsByCat($id, $limit, $offset);

        echo '<div class="row">';
        $catName = getCatById($id);


        echo ' <div class="col-md-4">';
        echo '<h2> ' . $catName['title'] . '</a></h2>';
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
            $str .= '<li><a href="?cat_id='.$id.'&page=' . $i . '">' . $i . '</a></li>';
        }
        echo str_replace("%pages%", $str, $paginationTemplate);


    }

    ?>



