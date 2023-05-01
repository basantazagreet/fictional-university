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
            <p><?php the_archive_description();?></p>
        </div>
    </div>
</div>


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