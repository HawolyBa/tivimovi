<?php get_header() ?>
  <?php while ( have_posts() ) : the_post(); ?>
    <main class="movie">
      <header class="details">
        <div class="poster">
          <img src="<?= get_the_post_thumbnail_url() ?>" alt="poster <?php the_title() ?>>"/>
        </div>
      </header>
    </main>
  <?php endwhile; ?>
<?php get_footer() ?>