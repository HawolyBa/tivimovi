<?php get_header() ?>

<?php
$the_query = new WP_Query( array(
    'posts_per_page' => 4,
    'meta_key' => 'meta-checkbox',
    'meta_value' => 'yes'
  ));

$movies = new WP_Query(array(
	'posts_per_page'	=> 4,
	'post_type'			=> 'movies'
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
        ?>
          <a href="<?= the_permalink() ?>" class="card">
            <div class="bookmark">1</div>
            <div class="poster">
              <img src="https://images-na.ssl-images-amazon.com/images/I/71wbalyU7tL._AC_SY606_.jpg" alt="poster joker">
            </div>
            <div class="description">
              <h4><?= the_title() ?></h4>
              <p>Directed by: <?php foreach( $directors as $director ): echo $director->name; endforeach ?></p>
              <p>With: <?php foreach( $actors as $actor ): echo explode(',',$actor_name); endforeach ?></p>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni dolor eos quam quo porro praesentium iusto, voluptate vero ad, id pariatur optio aspernatur quod magnam minus laboriosam at quasi esse.</p>
              <div class="note">10</div>
            </div>
          </a>
        <?php endwhile;
        else: ?>
          <p>No posts found</p>
        <?php  endif;  
        wp_reset_postdata(); ?>
      <div class="card">
        <div class="bookmark">2</div>
        <div class="poster">
          <img src="https://images-na.ssl-images-amazon.com/images/I/815BZqTNrsL._AC_SY679_.jpg" alt="poster ouatih">
        </div>
        <div class="description">
          <h4>Once Upon A Time....In Hollywood</h4>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni dolor eos quam quo porro praesentium iusto, voluptate vero ad...</p>
          <div class="note">9</div>
        </div>
      </div>
      <div class="card">
        <div class="bookmark">3</div>
        <div class="poster">
          <img src="http://fr.web.img3.acsta.net/pictures/19/04/19/09/29/4029006.jpg" alt="poster joker">
        </div>
        <div class="description">
          <h4>Aladdin</h4>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni dolor eos quam quo porro praesentium iusto, voluptate vero ad, id pariatur optio aspernatur quod magnam minus laboriosam at quasi esse.</p>
          <div class="note">6</div>
        </div>
      </div>
      <div class="card">
        <div class="bookmark">4</div>
        <div class="poster">
          <img src="https://junkiexperience.com/wp-content/uploads/2019/04/The-Lion-King-2.jpg" alt="poster ouatih">
        </div>
        <div class="description">
          <h4>The Lion King</h4>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni dolor eos quam quo porro praesentium iusto, voluptate vero ad...</p>
          <div class="note">7</div>
        </div>
      </div>
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