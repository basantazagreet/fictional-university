<?php

get_header();

while (have_posts()) {
    the_post(); ?>

    <!-- For Page banner -->
    <?php pageBanner(); ?>


    <div class="container container--narrow page-section">



        <!-- Breadcrumb icons and meta box for individual posts  -->





        <div class="generic-content">
            <div class="row group">

                <div class="one-third">
                    <?php the_post_thumbnail('professorPortrait'); ?>
                </div>

                <div class="two-thirds">
                    <?php the_content(); ?>
                </div>

            </div>


        </div>

        <?php $relatedPrograms = get_field('related_programs');

        if ($relatedPrograms) { ?>


            <hr class="section-break">
            </hr>
            <h2 class="headline headline-Medium">Related Programs</h2>
            <ul class="link-list min-list">

                <?php
                foreach ($relatedPrograms as $program) {
                    ?>
                    <li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title($program); ?><a></li>
                    <?php
                }
        }
        ?>

    </div>

<?php }

get_footer();

?>