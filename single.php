<?php get_header() ?>

<main class="main-content post-content">
  <?php while ( have_posts() ) : the_post(); ?>
  <div 
    class="featured-image" 
    style="background-image: url(<?= the_post_thumbnail_url() ?>)">
  </div>
  <div class="content">
    <h2><?= the_title() ?></h2>
    <p><?php the_content(); ?></p>
  </div>
  <?php endwhile ?>
</main>


<?php get_footer() ?>