<?php
session_start();
require_once('app/config/config.php');
require_once('app/db.php');

require_once('app/header.php');
?>

<div class="jumbotron"></div>
<div class="container" id="admin-panel">
    <?php
    $user = $_SESSION['auth'];
    if (isAdmin($user)):
    ?>

    <ul class="nav nav-tabs" role="tablist" id="myTabs">
        <li role="presentation" class="active"><a href="#category" aria-controls="category" role="tab"
                                                  data-toggle="tab">Category</a></li>
        <li role="presentation"><a href="#news" aria-controls="news" role="tab" data-toggle="tab">News</a></li>
        <li role="presentation"><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab">Comments</a>
        </li>
        <li role="presentation"><a href="#comments_to_be_approved" aria-controls="comments_to_be_approved" role="tab"
                                   data-toggle="tab">Comments to be approved</a>
        </li>
        <li role="presentation"><a href="#ads" aria-controls="ads" role="tab" data-toggle="tab">Ads</a>
        </li>
        <li role="presentation"><a href="#menu" aria-controls="menu" role="tab" data-toggle="tab">Menu</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="category">
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <form action="app/addCategory.php" method="post">
                        <div class="form-group">
                            <label for="catName">Add category</label>
                            <input type="text" class="form-control" name="catName" placeholder="Category name" required>
                        </div>

                        <button type="submit" class="btn btn-default">Add</button>
                    </form>
                </div>
            </div>
            <hr>
        </div>
        <div role="tabpanel" class="tab-pane" id="news">
            <hr>
            <div class="row">
                <div class="col-md-8">
                    <form action="app/addNews.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="titleNews">Title</label>
                            <input type="text" class="form-control" name="titleNews" placeholder="Title" required>
                        </div>
                        <div class="form-group">
                            <label for="textNews">Text</label>
                            <textarea rows="10" type="text" class="form-control" name="textNews" placeholder="Text"
                                      required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="imageNews">Image for news</label>
                            <input type="file" name="imageNews">

                            <p class="help-block">Upload only .jpg images, size < 3Mb</p>

                        </div>
                        <div class="form-group">
                            <label>Select category</label>

                            <select class="form-control" name="catNews">

                                <?php $categories = getAllCategories();
                                foreach ($categories as $id => $title): ?>
                                    <option value="<?= $id ?>"><?= $title ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select tags</label>

                            <select class="form-control" multiple name="tagsNews[]">

                                <?php $tags = getAllTags();
                                foreach ($tags as $id => $title): ?>
                                    <option value="<?= $id ?>"><?= $title ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <button type="submit" class="btn btn-default">Add</button>
                    </form>
                </div>
            </div>
            <hr>
        </div>
        <div role="tabpanel" class="tab-pane" id="comments">
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="comId">Enter comment id to edit</label>
                        <input id="comId" type="text" class="form-control" name="comId" placeholder="Comment Id"
                               required>
                    </div>

                    <button id="inputSearchComment" class="btn btn-default">Search</button>
                    <hr>
                    <div id="result-search">

                    </div>
                </div>
            </div>
            <hr>
        </div>
        <div role="tabpanel" class="tab-pane" id="comments_to_be_approved">
            <hr>
            <button id="approveComments" class="btn btn-default">Approve</button>
            <div id="result-search">

            </div>
            <hr>

            <div class="form-group" id="checkboxes">

                <?php $comments = getUnapprovedComments();
                foreach ($comments as $item) :?>
                    <label class="check">
                    <input id="approveBoxes" type="checkbox" value="<?=$item['id']?>">
                    <div class="panel panel-default">
                        <div class="panel-heading">#<?=$item['id']?>: <strong><?=$item['username']?></strong> wrote at <?=$item['created_at']?> :</div>
                        <div class="panel-body">
                            <?=$item['comment']?>
                        </div>
                    </div>
                </label>
                <hr>
                <?php endforeach;?>




            </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="ads">...</div>
        <div role="tabpanel" class="tab-pane" id="menu">...</div>
        <?php else: ?>
            <p class="bg-danger">You don't have an access to this page.</p>
            <?php
        endif;
        require_once('app/footer.php'); ?>
