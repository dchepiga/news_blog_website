<div class="container">
    <!-- Example row of columns -->
    <?php
    require_once('app/db.php');

    $categories = getAllCategories();
    echo '<div class="row">';
    $i = 0;
    foreach ($categories as $id => $category) {
        $news = getNewsByCat($id, 5);

        echo ' <div class="col-md-4">';
        echo '<h2><a href="?cat_id=' . $id . '"> ' . $category . '</a></h2>';
        echo '<p><ul>';
        foreach ($news as $key => $value) {
            echo '<li><p><a href="?news_id='.$key.'">' . $value . '</a></p></li>';
        }
        echo '</ul></p>';
        echo '</div>';
        $i++;
        if ($i == 3) {
            echo '</div><div class="row">';
        }
    }
    echo '</div>';

    ?>


    <hr>



 <?php require_once 'slider.php'?>





    </div>
