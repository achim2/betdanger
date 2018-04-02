<div class="container">
    <?php foreach ($this->get_category as $category) : ?>
        <?php if ($category->id != 1): ?>
            <h2><a href="<?php echo base_url("/category/$category->name"); ?>"><?php echo ucfirst($category->name); ?></a></h2>

            <div class="row">
                <?php $x = 0; ?>
                <?php foreach ($this->get_content as $content) : ?>
                    <?php if ($content->category_id == $category->id): ?>
                        <?php if ($x < 3) : ?>
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
                        <?php $x++; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

        <?php endif; ?>
    <?php endforeach; ?>
</div>
