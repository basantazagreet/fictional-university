<?php get_header(); ?>




<!-- For Page banner -->
<div class="page-banner">
    <div class="page-banner__bg-image"
        style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title">
            <?php
            //Generic Archive title
            the_archive_title();
            ?>
        </h1>
        <div class="page-banner__intro">
            <p>
                <?php the_archive_description(); ?>
            </p>
        </div>
    </div>
</div>


<div class="container container--narrow page-section">



    <?php 
    
    $args= array(
        'post_type' => 'event',
        'posts_per_page' => 10,
    
    );
    
    $eventQuery = new WP_Query($args);
    
    while ($eventQuery->have_posts()) {
        $eventQuery->the_post(); ?>

        <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

        <div class="metabox">

            <p>Posted by
                <?php the_author_posts_link(); ?> on
                <?php the_time('n.j.y'); ?> in
                <?php echo get_the_category_list(', '); ?>
            </p>
        </div>

        <?php echo the_excerpt(); ?>
        <a class="btn btn--blue" href="<?php the_permalink(); ?>">Continue reading &raquo;</a>

        <?php
    } ?>
    <?php paginate_links(); ?>
</div>





<?php get_footer(); ?>