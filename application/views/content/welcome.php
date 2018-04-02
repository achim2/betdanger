<div class="title-wrapper">
    <h2>Welcome at betdanger.com</h2>
</div>

<?php foreach ($this->get_category as $category) : ?>
    <?php if ($category->id != 1): ?>

        <div class="container">
            <h3><a href="<?php echo base_url("/category/$category->name"); ?>"><?php echo ucfirst($category->name); ?></a></h3>

            <div class="row">
                <?php $x = 0; ?>
                <?php foreach ($this->contents as $content) : ?>
                    <?php if ($content->category_id == $category->id): ?>
                        <?php if ($x < 4) : ?>
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
                        <?php $x++; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

        </div>
    <?php endif; ?>
<?php endforeach; ?>
