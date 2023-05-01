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
    'post_type' => 'event',
    'posts_per_page' => 10,

);

$eventQuery = new WP_Query($args);
while ($eventQuery->have_posts()) {
  $eventQuery->the_post(); ?>


  <div class="event-summary">
  <a class="event-summary__date t-center" href="<?php the_permalink();?>">
    <span class="event-summary__month"><?php $DateOfEvent = new DateTime(get_field('event_date'));
              echo $DateOfEvent->format('M');?></span>
    <span class="event-summary__day"><?php echo $DateOfEvent->format('d');?></span>
  </a>
  <div class="event-summary__content">
    <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>
    <p><?php echo wp_trim_words(get_the_content(), 20);?> <a href="<?php the_permalink();?>"
        class="nu gray">Learn more</a></p>
  </div>
</div>



 


<?php
}
wp_reset_postdata();
 paginate_links(); ?>

<p>Looking for past events? <a href="<?php echo site_url('/past-events')?>">Click here</a></p>
</div>





<?php get_footer(); ?>