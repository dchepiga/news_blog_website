<?php

function init()
{
    include('config/db_config.php');
    $dsn = 'mysql:host=' . $db_config['host'] . '; dbname=' . $db_config['db_name'].';charset=utf8';
    $user = $db_config['user'];
    $password = $db_config['pwd'];
    try {
        $dbh = new PDO($dsn, $user, $password);
        return $dbh;

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function isAdmin($email)
{
    $dbh = init();
    try {
        $sth = $dbh->prepare('SELECT is_admin FROM users where email like :email ');
        $params = ['email' => $email];
        $sth->execute($params);
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);
        $res = ($res[0]['is_admin']) ? true : false;

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $res;
}

function getAllNewsNum()
{
    $dbh = init();
    try {
        $sth = $dbh->query('SELECT * FROM news')->rowCount();

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $sth;
}

function getAllCategories()
{
    $dbh = init();
    try {
        $sth = $dbh->query('SELECT * FROM category')->fetchAll(PDO::FETCH_KEY_PAIR);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $sth;
}

function getCatById($cat_id)
{
    $dbh = init();
    try {
        $sth = $dbh->prepare('SELECT title FROM category WHERE id = :cat_id ');
        $params = ['cat_id' => $cat_id];
        $sth->execute($params);
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);


    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $res[0];
}

function getNewsById($news_id)
{
    $dbh = init();
    try {
        $sth = $dbh->prepare('SELECT * FROM news WHERE id = :news_id ');
        $params = ['news_id' => $news_id];
        $sth->execute($params);
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);


    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $res[0];
}

function getTagById($tag_id)
{
    $dbh = init();
    try {
        $sth = $dbh->prepare('SELECT * FROM tags WHERE id = :tag_id ');
        $params = ['tag_id' => $tag_id];
        $sth->execute($params);
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);


    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $res[0];
}

function getTagsByNews($news_id)
{
    $dbh = init();
    try {
        $sth = $dbh->prepare('SELECT tags.id, tags.title FROM tags_news,tags WHERE news_id = :news_id and tags_news.tag_id = tags.id ');
        $params = ['news_id' => $news_id];
        $sth->execute($params);
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);


    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $res;
}

function getNewsByCat($cat_id, $limit = null, $offset = 0)
{
    $dbh = init();

    $limit = (is_null($limit)) ? '' : ' LIMIT ' . $offset . ',' . $limit;

    try {
        $sth = $dbh->prepare('SELECT id, title FROM news WHERE category_id = :cat_id' . $limit);
        $params = ['cat_id' => $cat_id];
        $sth->execute($params);
        $res = $sth->fetchAll(PDO::FETCH_KEY_PAIR);


    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $res;
}

function getNewsByTag($tag_id, $limit = null, $offset = 0)
{
    $dbh = init();

    $limit = (is_null($limit)) ? '' : ' LIMIT ' . $offset . ',' . $limit;

    try {
        $sth = $dbh->prepare('SELECT news.id, title FROM news,tags_news WHERE news_id=news.id and tag_id = :tag_id' . $limit);
        $params = ['tag_id' => $tag_id];
        $sth->execute($params);
        $res = $sth->fetchAll(PDO::FETCH_KEY_PAIR);


    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $res;
}

function getSliderNews()
{
    $dbh = init();
    try {
        $sth = $dbh->query('select id, title, image from news order by created_at desc limit 4')->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $sth;
}

function getTagsByTitle($title)
{
    $dbh = init();

    try {
        $sth = $dbh->prepare("SELECT * FROM tags WHERE title like :title");
        $params = ['title' => '%' . $title . '%'];
        $sth->execute($params);
        $res = $sth->fetchAll(PDO::FETCH_KEY_PAIR);


    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $res;
}

function getUserByEmail($email)
{
    $dbh = init();

    try {
        $sth = $dbh->prepare("SELECT * FROM users WHERE email like :email");
        $params = ['email' => $email];
        $sth->execute($params);
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);


    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $res[0];
}

function addCategory($title)
{
    $dbh = init();

    try {
        $sth = $dbh->prepare("INSERT INTO category (title) VALUES (:title)");
        $sth->bindParam(':title', $title);
        return $sth->execute();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}

function addNews($title, $text, $image, $cat_id)
{
    $dbh = init();

    try {
        $sth = $dbh->prepare("INSERT INTO news (title,article,image, category_id) VALUES (:title,:text,:image, :category_id)");
        $sth->bindParam(':title', $title);
        $sth->bindParam(':text', $text);
        $sth->bindParam(':image', $image);
        $sth->bindParam(':category_id', $cat_id);
        $sth->execute();
        return $dbh->lastInsertId('id');
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}

function getAllTags()
{
    $dbh = init();
    try {
        $sth = $dbh->query('SELECT * FROM tags')->fetchAll(PDO::FETCH_KEY_PAIR);

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $sth;
}


function addTagsToNews($tag_id, $news_id)
{
    $dbh = init();
    var_dump($tag_id);
    try {
        $sth = $dbh->prepare('INSERT INTO tags_news (tag_id,news_id) VALUES (:tag_id,:news_id)');
        $params = [
            ':tag_id' => $tag_id,
            ':news_id' => $news_id
        ];

        return $sth->execute($params);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}

function getCommentById($id)
{
    $dbh = init();
    try {
        $sth = $dbh->prepare('SELECT * FROM comments WHERE id = :id');
        $params = ['id' => $id];
        $sth->execute($params);
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    return $res;
}

function editComment($id, $text)
{
    $dbh = init();
    try {
        $sth = $dbh->prepare('UPDATE `comments` SET comment=:text WHERE id =:id');
        $params = ['id' => $id, 'text' => $text];
        $sth->execute($params);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function getUnapprovedComments()
{
    $dbh = init();
    try {

        $sth = $dbh->query('SELECT comments.id, comment, created_at, username FROM comments,users WHERE comments.user_id=users.id and  approved = 0')->fetchAll(PDO::FETCH_ASSOC);
        return $sth;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function approveComment($id)
{
    $dbh = init();
    try {
        $sth = $dbh->prepare('UPDATE `comments` SET approved=1 WHERE id =:id');
        $params = ['id' => $id];
        $sth->execute($params);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function readOverall($id, $viewed)
{
    $dbh = init();
    try {
        $sth = $dbh->prepare('UPDATE news SET viewed=:viewed WHERE id =:id');
        $params = ['id' => $id, 'viewed' => $viewed];
        $sth->execute($params);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


