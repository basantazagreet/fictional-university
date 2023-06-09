<?php get_header(); 
 pageBanner(array(
    'title' => 'List of all our blogs',
    'subtitle' => 'You will find all our blog posts here',
))?>








<div class="container container--narrow page-section">

    <?php while (have_posts()) {
        the_post(); ?>

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