<?php

get_header();

while (have_posts()) {
    the_post(); ?>

    <!-- For Page banner -->
    <div class="page-banner">
        <div class="page-banner__bg-image"
            style="background-image: url(<?php $pagebanner = get_field('page_banner_background_image'); echo $pagebanner['sizes']['pageBanner'] ?>);"></div>
        <div class="page-banner__content container container--narrow">
            <h1 class="page-banner__title">
                <?php the_title(); ?>
            </h1>
            <div class="page-banner__intro">
                <p><?php echo get_field('page_banner_subtitle')?></p>
            </div>
        </div>
    </div>


    <div class="container container--narrow page-section">



        <!-- Breadcrumb icons and meta box for individual posts  -->





        <div class="generic-content">
            <div class="row group">

                <div class="one-third">
                    <?php the_post_thumbnail('professorPortrait');?>
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