<?php get_header() ?>

<?php

$the_query = new WP_Query( array(
    'posts_per_page' => 4,
    'meta_key' => 'meta-checkbox',
    'meta_value' => 'yes'
  ));

$movies = new WP_Query(array(
	'posts_per_page'	=> 4,
  'post_type'			=> 'movies',
  'meta_key'			=> 'note',
  'orderby'			=> 'meta_value_num',
  'order'				=> 'DESC'
));

?>

<main class="home">
  <section class="grid">
<?php
  if ( $the_query->have_posts() ):
    while ( $the_query->have_posts() ): $the_query->the_post(); ?>
      <a href="<?= the_permalink() ?>" class="bloc" id="bloc1">
        <div class="photo square" style="background-image: url(<?= the_post_thumbnail_url() ?>)"></div>
        <div class="text square">
          <h2><?= the_title() ?></h2>  
          <p><?= substr(get_the_excerpt(), 0, 150) . '...' ?></p> 
        </div>
      </a>
    <?php endwhile;
    else: ?>
      <p>No posts found</p>
    <?php  endif;  
    wp_reset_postdata(); ?>
  </section>
  <section class="latest">
    <h3>Popular movies</h3>
    <div class="cards">
    <?php
      if ( $movies->have_posts() ):
        while ( $movies->have_posts() ): $movies->the_post(); 
        $directors = get_field('directors');
        $actors = get_field('actors');
        $directors_arr = [];
        $actors_arr = [];
        foreach ( $actors as $actor ): $actors_arr[] = $actor->name; endforeach;
        foreach ( $directors as $director ): $directors_arr[] = $director->name; endforeach;
        //var_dump(get_field('note'))
        ?>
          <a href="<?= the_permalink() ?>" class="card">
            <div class="bookmark"><?= $movies->current_post + 1 ?></div>
            <div class="poster">
              <img src="<?php the_post_thumbnail_url() ?>" alt="poster joker">
            </div>
            <div class="description">
              <h4><?= the_title() ?></h4>
              <span>Directed by: <?php echo implode(', ', $directors_arr) ?></span><br/>
              <span>With: <?php echo implode(', ', $actors_arr) ?></span>
              <p><?= substr(get_the_content(), 0, 150) . '...' ?></p>
              <div class="note"><?php the_field('note') ?></div>
            </div>
          </a>
        <?php endwhile;
        else: ?>
          <p>No posts found</p>
        <?php  endif;  
        wp_reset_postdata(); ?>
    </div>
  </section>
  <section class="news">
    <h3>Latest news</h3>
    <div class="news-bloc">
      <div class="thumbnail"></div>
      <div class="details">
        <div class="tag">Cinema</div>
        <h4>Lorem ipsum dolor sit amet consectetur</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga molestiae optio, fugiat sapiente cumque inventore distinctio nulla minima placeat vero officia, libero praesentium error expedita voluptatibus tempora rerum, veniam a...</p>
        <div class="meta">
          <div class="date"><i class="fas fa-calendar-alt"></i> 2019-12-20</div>
          <div class="comments"><i class="fas fa-comments"></i> 3 comments</div>
        </div>
      </div>
    </div>
    <div class="news-bloc">
      <div class="thumbnail"></div>
      <div class="details">
        <div class="tag">Cinema</div>
        <h4>Lorem ipsum dolor sit amet consectetur</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga molestiae optio, fugiat sapiente cumque inventore distinctio nulla minima placeat vero officia, libero praesentium error expedita voluptatibus tempora rerum, veniam a...</p>
        <div class="meta">
          <div class="date"><i class="fas fa-calendar-alt"></i> 2019-12-20</div>
          <div class="comments"><i class="fas fa-comments"></i> 3 comments</div>
        </div>
      </div>
    </div>
    <div class="news-bloc">
      <div class="thumbnail"></div>
      <div class="details">
        <div class="tag">Cinema</div>
        <h4>Lorem ipsum dolor sit amet consectetur</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga molestiae optio, fugiat sapiente cumque inventore distinctio nulla minima placeat vero officia, libero praesentium error expedita voluptatibus tempora rerum, veniam a...</p>
        <div class="meta">
          <div class="date"><i class="fas fa-calendar-alt"></i> 2019-12-20</div>
          <div class="comments"><i class="fas fa-comments"></i> 3 comments</div>
        </div>
      </div>
    </div>
    <div class="news-bloc">
      <div class="thumbnail"></div>
      <div class="details">
        <div class="tag">Cinema</div>
        <h4>Lorem ipsum dolor sit amet consectetur</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga molestiae optio, fugiat sapiente cumque inventore distinctio nulla minima placeat vero officia, libero praesentium error expedita voluptatibus tempora rerum, veniam a...</p>
        <div class="meta">
          <div class="date"><i class="fas fa-calendar-alt"></i> 2019-12-20</div>
          <div class="comments"><i class="fas fa-comments"></i> 3 comments</div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php get_footer() ?>