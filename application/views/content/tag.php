<div class="title-wrapper">
    <h2>#<?php echo $this->uri->segment(2); ?></h2>
</div>

<div class="container">
    <div class="row">
        <?php foreach ($this->contents as $content) : ?>
            <?php if ($content): ?>

                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <a href="<?php echo base_url("/page/$content->slug"); ?>" class="card-img-wrapper">
                            <img class="card-img-top"
                                 src="/assets/images/uploaded/<?php echo $content->image_name; ?>"
                                 alt="<?php echo $content->image_name; ?>">
                        </a>

                        <div class="card-body">
                            <h5 class="card-title"><?php echo $content->title; ?></h5>
                            <div class="">
                                <?php if (is_array($content->tag_names) && !empty($content->tag_names)): ?>
                                    <?php foreach ($content->tag_names as $name): ?>
                                        <a class="tag-name" href="<?php echo base_url("/tag/$name") ?>">#<?php echo $name; ?> </a>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <p class="card-text"><?php echo character_limiter($content->body, 65); ?></p>
                            <a href="<?php echo base_url("/page/$content->slug"); ?>"
                               class="btn-card">Read me!</a>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
