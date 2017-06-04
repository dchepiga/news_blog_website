<?php
require_once 'app/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once 'app/db.php';

    $search = $_POST['q'];

    $result = getTagsByTitle($search);
    if (count($result) > 0) {

        foreach ($result as $key => $title) {

            echo '

<li>
    <div class="block-title-price">
        <a href="?tag_id='.$key.'">' . $title . '</a>
    </div>

</li>
';
        }


    } else {

        echo '
<center>
    <a id="search-noresult">Ничего не найдено</a>
</center>
';
    }
}