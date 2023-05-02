<?php get_header(); ?>

<?php pageBanner(array(
    'title' => 'All programs',
    'subtitle' => 'All of our campus programs.',
))?>





<div class="container container--narrow page-section">
<?php

$args= array(
    'post_type' => 'program',
    'posts_per_page' => 10,

);


?><ul> <?php
$eventQuery = new WP_Query($args);
while ($eventQuery->have_posts()) {
  $eventQuery->the_post(); ?>

<li><h4><a href="<?php the_permalink();?>"><?php the_title();?><a></h4></li>



<?php
}
wp_reset_postdata();
 paginate_links(); ?>
 </ul>
</div>





<?php get_footer(); ?>