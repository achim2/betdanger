<div class="container">
    <div class="row">

<!--        <h2>--><?php //echo $this->title; ?><!--</h2>-->

        <?php
        foreach ($this->get_content as $content) {
            ?>

            <div class="col-lg-6 col-xl-4 d-flex justify-content-center">
                <a href="<?php echo base_url('/blog/post/' . $content->slug); ?>" class="bigger_block">
                    <!--image-->
                    <div class="img_wrapper">
                        <img class="" src="/assets/images/uploaded/<?php echo $content->front_img; ?>" alt="mockup">
                        <!--it shows after hovering-->
                        <div class="project_data">
                            <img class="rarrow" src="/assets/images/rarrow.png">
                            <p class="readit">Read me!<br> Right now!</p>
                        </div>
                    </div>
                    <!--text-->
                    <div class="para_wrapper">
                        <p><?php echo $content->title; ?></p>
                    </div>
                </a>
            </div>

            <?php
        }
        ?>

    </div>
</div>