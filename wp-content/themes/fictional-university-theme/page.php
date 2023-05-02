<?php

  get_header();

  while(have_posts()) {
    the_post(); 
    
    //for page banner provide args
    pageBanner(array(
            'title' =>"About our university",
            'subtitle' => 'Best University in the world.',
        )); ?>

  <div class="container container--narrow page-section">
    


  <!-- Breadcrumb icons parent and child  -->
    <?php
    //check if we are in child page, otherwise no breadcrumb
      $theParent = wp_get_post_parent_id(get_the_ID());
      if ($theParent) { ?>
        <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); ?></a> <span class="metabox__main"><?php the_title(); ?></span></p>
    </div>
      <?php }
    ?>

    
    
  <!-- For sidenav -->
    <?php 
    //Check if it is a parent page
    $testArray = get_pages(array(
      'child_of' => get_the_ID()
    ));

    //If it is parent page or child page, show sidenav
    if ($theParent or $testArray) { ?>
    <div class="page-links">
      <!-- Parent page shown in header of sidenav -->
      <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent); ?></a></h2>
      <ul class="min-list">
        <?php
        // Children of parent page or children of current page displayed
          if ($theParent) {
            $findChildrenOf = $theParent;
          } else {
            $findChildrenOf = get_the_ID();
          }

          wp_list_pages(array(
            'title_li' => NULL,
            'child_of' => $findChildrenOf,
            'sort_column' => 'menu_order'
          ));
        ?>
      </ul>
    </div>
    <?php } ?>
    

    <div class="generic-content">
      <?php the_content(); ?>
    </div>

  </div>
    
  <?php }

  get_footer();

?>