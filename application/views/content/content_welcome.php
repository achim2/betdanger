<div class="container">
    <div class="row">
        <div class="col-xl-9">
            <main>

                <?php
                foreach ($this->categories as $categories) {
                    ?>

                    <div class="categories">
                        <h2 class="section-name"><?php
                            if ($categories == 'news') {
                                echo "News";
                            } elseif ($categories == 'previews') {
                                echo "Previews";
                            } else {
                                echo "Blog posts";
                            }
                            ?></h2>
                        <div class="cat-inner">
                            <?php
                            foreach ($this->get_content as $content) {
                                if ($categories == $content->category) {
                                    ?>

                                    <a class="welcome-short-article" href="<?php echo base_url("/$content->category/$content->slug"); ?>">
                                        <img class="img-fluid" src="/assets/images/uploaded/<?php echo $content->front_img; ?>" alt="mockup">

                                        <div class="short-article-inner">
                                            <p class="title"><?php echo $content->title; ?></p>
                                            <p class="body"><?php echo character_limiter($content->body, 75); ?></p>
                                            <p class="bottom-info">
                                                <span><?php echo $content->created_at; ?></span>
                                                <span><?php echo $content->username; ?></span>
                                            </p>
                                        </div>
                                    </a>

                                    <?php
                                }
                            } ?>
                        </div>
                    </div>

                    <?php
                }
                ?>

            </main>
        </div>
        <div class="col-xl-3">
            <aside>
                <div class="categories">
                    <h4 class="section-name">daily bets</h4>
                    <ul>
                        <li><a href="#">Maecenas</a></li>
                        <li><a href="#">Pellentesque</a></li>
                    </ul>
                </div>

                <div class="categories">
                    <h4 class="section-name">useful tools</h4>
                    <ul>
                        <li><a href="#">Maecenas</a></li>
                        <li><a href="#">Pellentesque</a></li>
                        <li><a href="#">Donec</a></li>
                        <li><a href="#">Etiam</a></li>
                        <li><a href="#">Integer</a></li>
                        <li><a href="#">Lorem</a></li>
                        <li><a href="#">Proin</a></li>
                    </ul>
                </div>

            </aside>
        </div>
    </div>
</div>
