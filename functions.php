<?php 


define( 'THEME_PATH', get_template_directory() );
define( 'THEME_URI', get_template_directory_uri() );

wp_enqueue_style( 'style', get_stylesheet_uri() );
add_action( 'wp_enqueue_scripts', 'yourtheme_enqueue_scripts' );
function yourtheme_enqueue_scripts() {
  wp_enqueue_style( 'font-awesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.2/css/all.min.css' );
}

add_theme_support( 'post-thumbnails' );

/**
 * Saves the custom meta input
 */
function sm_meta_save( $post_id ) {
  // Checks save status
  $is_autosave = wp_is_post_autosave( $post_id );
  $is_revision = wp_is_post_revision( $post_id );
  $is_valid_nonce = ( isset( $_POST[ 'sm_nonce' ] ) && wp_verify_nonce( $_POST[ 'sm_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

  // Exits script depending on save status
  if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
      return;
  }

  // Checks for input and saves
  if( isset( $_POST[ 'meta-checkbox' ] ) ) {
    update_post_meta( $post_id, 'meta-checkbox', 'yes' );
  } else {
    update_post_meta( $post_id, 'meta-checkbox', '' );
  }

}
add_action( 'save_post', 'sm_meta_save' );

function sm_custom_meta() {
  add_meta_box( 'sm_meta', __( 'Featured Posts', 'sm-textdomain' ), 'sm_meta_callback', 'post' );
}


function sm_meta_callback( $post ) {
  $featured = get_post_meta( $post->ID );
  ?>

<p>
  <div class="sm-row-content">
      <label for="meta-checkbox">
          <input type="checkbox" name="meta-checkbox" id="meta-checkbox" value="yes" <?php if ( isset ( $featured['meta-checkbox'] ) ) checked( $featured['meta-checkbox'][0], 'yes' ); ?> />
          <?php _e( 'Featured this post', 'sm-textdomain' )?>
      </label>
      
  </div>
</p>

  <?php
}
add_action( 'add_meta_boxes', 'sm_custom_meta' );

function wpm_custom_post_type() {

	// On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
	$labels = array(
		// Le nom au pluriel
		'name'                => _x( 'Movies', 'Movies'),
		// Le nom au singulier
		'singular_name'       => _x( 'Movie', 'Movie'),
		// Le libellé affiché dans le menu
		'menu_name'           => __( 'Movies'),
		// Les différents libellés de l'administration
		'all_items'           => __( 'All Movies'),
		'view_item'           => __( 'See movies'),
		'add_new_item'        => __( 'Add a new movie'),
		'add_new'             => __( 'Add'),
		'edit_item'           => __( 'Edit movie'),
		'update_item'         => __( 'Update movie'),
		'search_items'        => __( 'Search a movie'),
		'not_found'           => __( 'Not found'),
		'not_found_in_trash'  => __( 'Not found in trash'),
	);
	
	// On peut définir ici d'autres options pour notre custom post type
	
	$args = array(
		'label'               => __( 'Movies'),
		'description'         => __( 'All the movies'),
		'labels'              => $labels,
		// On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		/* 
		* Différentes options supplémentaires
		*/
		'show_in_rest' => true,
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => true,
		'rewrite'			  => array( 'slug' => 'movie'),

	);
	
	// On enregistre notre custom post type qu'on nomme ici "serietv" et ses arguments
	register_post_type( 'movies', $args );

}

add_action( 'init', 'wpm_custom_post_type', 0 );

function create_directors_taxonomy() {
// Labels part for the GUI

  $labels = array(
    'name' => _x( 'Directors', 'taxonomy general name' ),
    'singular_name' => _x( 'Director', 'taxonomy singular name' ),
    'search_items' => __( 'Search Directors' ),
    'popular_items' =>__( 'Popular Directors' ),
    'all_items' => __( 'All Directors' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Director' ),
    'update_item' => __( 'Update Director' ),
    'add_new_item' => __( 'Add New Director' ),
    'new_item_name' => __( 'New Director Name' ),
    'separate_items_with_commas' => __( 'Separate directors with commas' ),
    'add_or_remove_items' => __( 'Add or remove directors' ),
    'choose_from_most_used' => __( 'Choose from the most used directors' ),
    'menu_name' => __( 'Directors' ),
  );

// Now register the non-hierarchical taxonomy like tag
  register_taxonomy('directors','movies',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'director' ),
  ));
}

//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'create_directors_taxonomy', 0 );

function create_actors_taxonomy() {
  // Labels part for the GUI
  
    $labels = array(
      'name' => _x( 'Actors', 'taxonomy general name' ),
      'singular_name' => _x( 'Actor', 'taxonomy singular name' ),
      'search_items' => __( 'Search Actors' ),
      'popular_items' =>__( 'Popular Actors' ),
      'all_items' => __( 'All Actors' ),
      'parent_item' => null,
      'parent_item_colon' => null,
      'edit_item' => __( 'Edit Actor' ),
      'update_item' => __( 'Update Actor' ),
      'add_new_item' => __( 'Add New Actor' ),
      'new_item_name' => __( 'New Actor Name' ),
      'separate_items_with_commas' => __( 'Separate actors with commas' ),
      'add_or_remove_items' => __( 'Add or remove actors' ),
      'choose_from_most_used' => __( 'Choose from the most used actors' ),
      'menu_name' => __( 'Actors' ),
    );
  
  // Now register the non-hierarchical taxonomy like tag
    register_taxonomy('actors','movies',array(
      'hierarchical' => false,
      'labels' => $labels,
      'show_ui' => true,
      'show_admin_column' => true,
      'update_count_callback' => '_update_post_term_count',
      'query_var' => true,
      'rewrite' => array( 'slug' => 'actor' ),
    ));
  }
  
  //hook into the init action and call create_book_taxonomies when it fires
  add_action( 'init', 'create_actors_taxonomy', 0 );

?>