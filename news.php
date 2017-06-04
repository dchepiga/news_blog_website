<div class="container">
    <?php
    if (array_key_exists('news_id', $_GET)) {
        $id = $_GET['news_id'];
        require_once('app/db.php');


        echo '<div class="row">';
        $newsName = getNewsById($id);
        $tags = getTagsByNews($id);


    }
    ?>
    <h2><?= $newsName['title'] ?></h2>
    <h4><?= $newsName['created_at'] ?></h4>


    <?php if (!is_null($newsName['image'])): ?>
        <img id="news" src="uploads/<?= $newsName['image'] ?>" alt="...">
    <?php endif; ?>

    <?php
    require_once 'app/config/config.php';

    if ($newsName['category_id'] == $categoryAnaliticaId) {

        if (isset($_SESSION['auth'])) {
            echo '<p>' . $newsName['article'] . '</p>';
        } else {
            $modified = preg_split('/(?<=[.?!])\s+(?=[a-z])/i', $newsName['article']);
            $modified = array_slice($modified, 0, 4);
            $modified = implode(' ', $modified);

            echo '<p>' . $modified . '</p>';
            echo '<p>...</p>';


        }
    }
    else{
        echo '<p>' . $newsName['article'] . '</p>';

    }


    foreach ($tags as $id => $tag):?>

        <span class="label label-info"><a href="?tag_id=<?= $tag['id'] ?>"><?= $tag['title'] ?></a></span>

        <?php
    endforeach;
    ?>
    <input id="news_id" type="hidden" value="<?= $newsName['id'] ?>">


    <div class="pull-right">
        Currently read <span id="current" class="badge">0</span>
    </div>
    <br>

    <div class=" pull-right">
        Overally viewed <span id="overall" class="badge"><?= $newsName['viewed'] ?></span>
    </div>



