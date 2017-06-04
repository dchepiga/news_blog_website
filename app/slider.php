<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
<?php

        require_once 'config/config.php';
        $slideNews = getSliderNews();
        $aa = true;
        foreach ($slideNews as $title) {
            if ($aa==true){
                echo '<div class="item active">';
                $aa=false;
            } else {
                echo '<div class="item">';
            }

            echo '<img src="uploads/'.$title['image'].'" alt="..." height="145px">';

            echo '<div class="carousel-caption">';

            echo '<h3><a href="?news_id='.$title['id'].'">' . $title['title'] . '</a></h3>';
            echo '</div>';

            echo '</div>';

        }
      ?>


    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>





