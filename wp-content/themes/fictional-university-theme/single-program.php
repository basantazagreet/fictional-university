<?php

get_header();

while (have_posts()) {
  the_post(); ?>

  <!-- For Page banner -->
  <div class="page-banner">
    <div class="page-banner__bg-image"
      style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title">
        <?php the_title(); ?>
      </h1>
      <div class="page-banner__intro">
        <p>Find a course that suits for you</p>
      </div>
    </div>
  </div>


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
        ?>

        <div class="event-summary">
          <a class="event-summary__date t-center" href="<?php the_permalink(); ?>">
            <span class="event-summary__month">
              <?php
              $DateOfEvent = new DateTime(get_field('event_date'));
              echo $DateOfEvent->format('M');
              ?>
            </span>
            <span class="event-summary__day">
              <?php
              echo $DateOfEvent->format('d');
              ?>
            </span>
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            <p>
              <?php
              if (has_excerpt()) {
                echo get_the_excerpt();
              } else {
                echo wp_trim_words(get_the_content(), 20);
              }
              ?> <a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a>
            </p>
          </div>
        </div>
      <?php }
    }
    wp_reset_postdata(); ?>









  </div>

<?php }

get_footer();

?>