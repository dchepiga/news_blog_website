<div class="jumbotron">
    <div class="container">

        <div class="row">
            <div class="col-lg-6">
                <div id="block-search" class="input-group">
                    <input type="text" class="form-control" placeholder="Find news by tag..." name="q"
                           id="input-search" aria-describedby="basic-addon2">
                    <span class=" input-group-addon" id="basic-addon2">@</span>

                    <div id="block-search-result">

                        <ul id="list-search-result">


                        </ul>

                    </div>
                </div>

                <?php
                require_once 'db.php';
                $tags = getAllTags();
                echo '<p id="hint">';
                foreach ($tags as $key => $tag) {
                    echo $tag." | ";
                }
                echo '</p>';

                ?>

            </div>

        </div>
    </div>
</div>