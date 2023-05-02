<?php

get_header();

while (have_posts()) {
  the_post(); 
  pageBanner();
  ?>


  <div class="container container--narrow page-section">



    <!-- Breadcrumb icons and meta box for individual posts  -->

    <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo site_url('/programs') ?>"><i class="fa fa-home"
            aria-hidden="true"></i> Back to Programs
        </a> <span class="metabox__main">
          <?php the_title(); ?> on
        </span></p>
    </div>



    <div class="generic-content">

      <?php the_content(); ?>
    </div>

    <!-- To pull up professors teaching this program -->

    <?php


    $taughtby = new WP_QUERY(
      array(
        'orderby' => 'title',
        'order' => 'ASC',
        'posts_per_page' => -1,
        'post_type' => 'professor',
        'meta_query' => array(
          array(
            'key' => 'related_programs',
            'value' => '"' . get_the_ID() . '"',
            'compare' => 'LIKE',
          )
        )
      )
    );

    if ($taughtby->have_posts()) {

      ?>
      <hr class="section-break" />
      <h2 class="headline headline--medium">
        <?php the_title(); ?> Professors
      </h2>
      <ul class="link-list min-list">
        <?php

        while ($taughtby->have_posts()) {
          $taughtby->the_post();
          ?>
          <li class="professor-card__list-item">
            <a class="professor-card" href="<?php the_permalink(); ?>">
              <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape') ?>">
              <span class="professor-card__name">
                <?php the_title(); ?>
              </span>
            </a>
          </li>



        <?php }
        ?>
      </ul>
      <?php
    }
    wp_reset_postdata(); ?>











    <!-- To pull up upcoming events related to this program -->

    <?php



    $today = date('Ymd');

    $homepageEvents = new WP_QUERY(
      array(
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'posts_per_page' => 2,
        'post_type' => 'event',
        'meta_query' => array(
          array(
            'key' => 'related_programs',
            'value' => '"' . get_the_ID() . '"',
            'compare' => 'LIKE',
          )
        )
      )
    );

    if ($homepageEvents->have_posts()) {

      ?>
      <hr class="section-break" />
      <h2 class="headline headline--medium">Upcoming
        <?php the_title(); ?> related events
      </h2>

      <?php

      while ($homepageEvents->have_posts()) {
        $homepageEvents->the_post();
        
        get_template_part('template-parts/content','event');
        
       }
    }
    wp_reset_postdata(); ?>

  </div>

<?php }

get_footer();

?>