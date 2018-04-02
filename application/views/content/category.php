<div class="container">
    <h2><?php echo ucfirst($this->get_category->name); ?></h2>

    <div class="row">
        <?php foreach ($this->get_content as $content) : ?>
            <?php if ($content): ?>

                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card">
                        <a href="<?php echo base_url("/page/$content->slug"); ?>" class="card-img-wrapper">
                            <img class="card-img-top"
                                 src="/assets/images/uploaded/<?php echo $content->image_name; ?>"
                                 alt="<?php echo $content->image_name; ?>">
                        </a>

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $content->title; ?></h5>
                            <p class="card-text"><?php echo character_limiter($content->body, 65); ?></p>
                            <a href="<?php echo base_url("/page/$content->slug"); ?>"
                               class="btn-card btn btn-primary">Read me!</a>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
        <?php endforeach; ?>
    </div>

</div>
