<?php get_header(); ?>
<?php pageBanner(array(
    'title' => 'All events',
    'subtitle' => 'See what is going on in the world.',
))?>



<div class="container container--narrow page-section">
<?php

$args= array(
    'post_type' => 'event',
    'posts_per_page' => 10,

);

$eventQuery = new WP_Query($args);
while ($eventQuery->have_posts()) {
  $eventQuery->the_post();
  get_template_part('template-parts/content','event');


}
wp_reset_postdata();
 paginate_links(); ?>

<p>Looking for past events? <a href="<?php echo site_url('/past-events')?>">Click here</a></p>
</div>





<?php get_footer(); ?>