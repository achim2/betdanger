<?php $result = count($this->get_results); ?>
<?php $options = $this->options; ?>

<div class="title-wrapper">
    <h2>Searched for: <?php echo $this->uri->segment(2); ?></h2>
    <h6>Search result<?php echo ($result > 1) ? 's (' . $result . ')' : ' (' . $result . ')'; ?></h6>
</div>

<div class="container">
    <div class="row">
        <?php foreach ($this->get_results as $content) : ?>
            <?php if ($content): ?>

                <div class="col-sm-6 col-lg-3">
                    <div class="card">

                        <?php if ($options['image'] == 1): ?>
                            <a href="<?php echo base_url("/page/$content->slug"); ?>" class="card-img-wrapper">
                                <img class="card-img-top"
                                     src="/assets/images/uploaded/<?php echo $content->image_name; ?>"
                                     alt="<?php echo $content->image_name; ?>">
                            </a>
                        <?php endif; ?>

                        <div class="card-body">
                            <?php if ($options['tags'] == 1): ?>
                                <div class="card-tags">
                                    <?php if (is_array($content->tag_names) && !empty($content->tag_names)): ?>
                                        <?php foreach ($content->tag_names as $name): ?>
                                            <a class="tag-name" href="<?php echo base_url("/tag/$name") ?>">#<?php echo $name; ?> </a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <h5 class="card-title"><?php echo $content->title; ?></h5>

                            <?php if ($options['short_description'] == 1): ?>
                                <p class="card-text"><?php echo character_limiter($content->body, 65); ?></p>
                            <?php endif; ?>

                            <a href="<?php echo base_url("/page/$content->slug"); ?>" class="btn-card">Read me!</a>
                        </div>
                    </div>
                </div>

            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
