<div class="container">
    <h2 class="mb-3"><?php echo "Content Welcome"; ?></h2>
    <?php foreach ($this->categories as $categories) : ?>
        <div class="row">
            <?php
            foreach ($this->get_content as $content) :
                if ($categories == $content->category):
                    ?>

                    <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                        <div class="card">
                            <img class="card-img-top"
                                 src="/assets/images/uploaded/<?php echo $content->front_img; ?>"
                                 alt="Card image cap">

                            <div class="card-body">
                                <h5 class="card-title"><?php echo $content->title; ?></h5>
                                <p class="card-text"><?php echo character_limiter($content->body, 75); ?></p>
                                <a href="<?php echo base_url("/$content->category/$content->slug"); ?>"
                                   class="btn btn-primary">Read me!</a>
                            </div>
                        </div>
                    </div>


                <?php endif; ?>
            <?php endforeach; ?>
        </div>

    <?php endforeach; ?>

</div>
