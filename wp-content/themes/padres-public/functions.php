<?php
/**
 * Padres Public functions and definitions
 *
 * @package Padres Public
 * @since Padres Public 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Padres Public 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'padres_public_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Padres Public 1.0
 */
function padres_public_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/extras.php' );

	/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Padres Public, use a find and replace
	 * to change 'padres_public' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'padres_public', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'padres_public' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
endif; // padres_public_setup
add_action( 'after_setup_theme', 'padres_public_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Padres Public 1.0
 */
function padres_public_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'padres_public' ),
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}

add_action( 'widgets_init', 'padres_public_widgets_init' );

function padres_public_widgets_init2() {
  register_sidebar( array(
    'name' => __( 'Bottom Sidebar', 'padres_public' ),
    'id' => 'bottom-sidebar',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h1 class="widget-title">',
    'after_title' => '</h1>',
  ) );
}
add_action( 'widgets_init', 'padres_public_widgets_init2' );

function padres_public_widgets_init3() {
  register_sidebar( array(
    'name' => __( 'Top Sidebar', 'padres_public' ),
    'id' => 'top-sidebar',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h1 class="widget-title">',
    'after_title' => '</h1>',
  ) );
}

add_action( 'widgets_init', 'padres_public_widgets_init3' );

/**
 * Enqueue scripts and styles
 */
function padres_public_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );

    // disables "menu" script since menu items are already well sized
	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'padres_public_scripts' );

/**
 * Implement the Custom Header feature
 */
//require( get_template_directory() . '/inc/custom-header.php' );

/************************************
* Add all post types to archive.php
*************************************/

function padres_public_add_custom_types( $query ) {
  if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'sacrifice-bunt', 'rjs-fro', 'son-of-a-duck', 'left-coast-bias', 'padres-trail', '400-in-94', 'avenging-jack-murphy', 'woe-doctor', 'padres-prospects', 'ghost-of-ray-kroc', 'vocal-minority', 'padres-and-pints'
        ));
      return $query;
    }
}
add_filter( 'pre_get_posts', 'padres_public_add_custom_types' );

/**********************************
* Adds all post types to rss
***********************************/
function myfeed_request($qv) {
    if (isset($qv['feed']) && !isset($qv['post_type']))
        $qv['post_type'] = get_post_types( array( 'public' => true ) );
    return $qv;
}
add_filter('request', 'myfeed_request');


/**********************************
* The excerpt customizations
***********************************/
// add_filter('the_excerpt', array($wp_embed, 'autoembed'), 9);

function improved_trim_excerpt($text) { // Fakes an excerpt if needed
  global $post;
  if ( '' == $text ) {
    $text = get_the_content('');
    $text = apply_filters('the_content', $text);
    $text = str_replace('\]\]\>', ']]&gt;', $text);
    /* removes javascript $text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text); */
    $text = strip_tags($text, '<p> <h2> <h3> <param> <object> <iframe> <div>');

    $excerpt_length = 100;
    $words = explode(' ', $text, $excerpt_length + 1);
    if (count($words)> $excerpt_length) {
      array_pop($words);
      array_push($words, ' ... <a href="'. get_permalink() . '" class="read-more">Read the full post</a>');
      $text = implode(' ', $words);
    }

  }

  $postcustom = get_post_custom_keys();
  if ($postcustom) {
    $i = 1;   foreach ($postcustom as $key) {
        if (strpos($key,'oembed')) {
            foreach (get_post_custom_values($key) as $video){
                if ($i == 1) {
                    $text = $video;
                }
                $i++;
            }
        }
    }
  }
return $text;
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'improved_trim_excerpt'); // tell wordpress to use our excerpt instead


// add category nicenames in body and post class
function category_id_class($classes) {
  global $post;
  foreach((get_the_category($post->ID)) as $category)
    $classes[] = $category->category_nicename;
  return $classes;
}
add_filter('post_class', 'category_id_class');
add_filter('body_class', 'category_id_class');




/***********************************
* Custom Padres Public Post Types
***********************************/

//show custom post types on the home page
add_action( 'pre_get_posts', 'add_my_custom_post_type' );

function add_my_custom_post_type( $query ) {
	if ( is_home() && $query->is_main_query() )
		$query->set( 'post_type', array( 'post', 'sacrifice-bunt', 'rjs-fro', 'son-of-a-duck', 'left-coast-bias', 'padres-trail', '400-in-94', 'avenging-jack-murphy', 'woe-doctor', 'padres-prospects', 'ghost-of-ray-kroc', 'vocal-minority', 'padres-and-pints' ) );
	return $query;
}


/* Son Of A duck */
function post_type_son_of_a_duck() {
  $labels = array(
    'name' => 'Son Of A Duck',
    'add_new_item' => 'Add New Son Of A Duck Post',
    'new_item' => 'New Son Of A Duck Post',
    'all_items' => 'All Son Of A Duck Posts',
    'view_item' => 'View Son Of A Duck Post',
    'search_items' => 'Search Son Of A Duck Posts',
    'not_found' =>  'No Son Of A Duck Posts found',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'son-of-a-duck' ),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 4,
    'taxonomies' => array( 'category', 'post_tag' ),
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions' )
  );

  register_post_type( 'son-of-a-duck', $args );
}
add_action( 'init', 'post_type_son_of_a_duck' );



/* Sacrifice Bunt */
function post_type_sacrifice_bunt() {
  $labels = array(
    'name' => 'The Sacrifice Bunt',
    'add_new_item' => 'Add New Sacrifice Bunt Post',
    'new_item' => 'New Sacrifice Bunt Post',
    'all_items' => 'All Sacrifice Bunt Posts',
    'view_item' => 'View Sacrifice Bunt Post',
    'search_items' => 'Search Sacrifice Bunt Posts',
    'not_found' =>  'No Sacrifice Bunt Posts found',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'sacrifice-bunt' ),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 4,
    'taxonomies' => array( 'category', 'post_tag' ),
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions' )
  );

  register_post_type( 'sacrifice-bunt', $args );
}
add_action( 'init', 'post_type_sacrifice_bunt' );


/* RJ's Fro */
function post_type_rjs_fro() {
  $labels = array(
    'name' => 'RJs Fro',
    'add_new_item' => 'Add New RJs Fro Post',
    'new_item' => 'New RJs Fro Post',
    'all_items' => 'All RJs Fro Posts',
    'view_item' => 'View RJs Fro Post',
    'search_items' => 'Search RJs Fro Posts',
    'not_found' =>  'No RJs Fro Posts found',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'rjs-fro' ),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 4,
    'taxonomies' => array( 'category', 'post_tag' ),
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions')
  );

  register_post_type( 'rjs-fro', $args );
}
add_action( 'init', 'post_type_rjs_fro' );


/* Avenging Jack Murphy */
function post_type_avenging_jack_murphy() {
  $labels = array(
    'name' => 'Avenging Jack Murphy',
    'add_new_item' => 'Add New Avenging Jack Murphy Post',
    'new_item' => 'New Avenging Jack Murphy Post',
    'all_items' => 'All Avenging Jack Murphy Posts',
    'view_item' => 'View Avenging Jack Murphy Post',
    'search_items' => 'Search Avenging Jack Murphy Posts',
    'not_found' =>  'No Avenging Jack Murphy post found',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'avenging-jack-murphy' ),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 4,
    'taxonomies' => array( 'category', 'post_tag' ),
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions')
  );

  register_post_type( 'avenging-jack-murphy', $args );
}
add_action( 'init', 'post_type_avenging_jack_murphy' );


/* Ghost of Ray Kroc */
function post_type_ghost_of_ray_kroc() {
  $labels = array(
    'name' => 'Ghost of Ray Kroc',
    'add_new_item' => 'Add New Ghost of Ray Kroc Post',
    'new_item' => 'New Ghost of Ray Kroc Post',
    'all_items' => 'All Ghost of Ray Kroc Posts',
    'view_item' => 'View Ghost of Ray Kroc Post',
    'search_items' => 'Search Ghost of Ray Kroc Posts',
    'not_found' =>  'No Ghost of Ray Kroc post found',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'ghost-of-ray-kroc' ),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 4,
    'taxonomies' => array( 'category', 'post_tag' ),
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions')
  );

  register_post_type( 'ghost-of-ray-kroc', $args );
}
add_action( 'init', 'post_type_ghost_of_ray_kroc' );


/* 400 in 94 */
function post_type_400_in_94() {
  $labels = array(
    'name' => '.400 in 94',
    'add_new_item' => 'Add New .400 in 94 Post',
    'new_item' => 'New .400 in 94 Post',
    'all_items' => 'All .400 in 94 Posts',
    'view_item' => 'View .400 in 94 Post',
    'search_items' => 'Search .400 in 94 Posts',
    'not_found' =>  'No .400 in 94 post found',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => '400-in-94' ),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 4,
    'taxonomies' => array( 'category', 'post_tag' ),
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions')
  );

  register_post_type( '400-in-94', $args );
}
add_action( 'init', 'post_type_400_in_94' );


/* Left Coast Bias */
function post_type_left_coast_bias() {
  $labels = array(
    'name' => 'Left Coast Bias',
    'add_new_item' => 'Add New Left Coast Bias Post',
    'new_item' => 'New Left Coast Bias Post',
    'all_items' => 'All Left Coast Bias Posts',
    'view_item' => 'View Left Coast Bias Post',
    'search_items' => 'Search Left Coast Bias Posts',
    'not_found' =>  'No Left Coast Bias Post found',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'left-coast-bias' ),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 4,
    'taxonomies' => array( 'category', 'post_tag' ),
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions')
  );

  register_post_type( 'left-coast-bias', $args );
}
add_action( 'init', 'post_type_left_coast_bias' );


/* Padres Prospects */
function post_type_padres_prospects() {
  $labels = array(
    'name' => 'Padres Prospects',
    'add_new_item' => 'Add New Padres Prospects Post',
    'new_item' => 'New Padres Prospects Post',
    'all_items' => 'All Padres Prospects Posts',
    'view_item' => 'View Padres Prospects Post',
    'search_items' => 'Search Padres Prospects Posts',
    'not_found' =>  'No Padres Prospects Post found',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'padres-prospects' ),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 4,
    'taxonomies' => array( 'category', 'post_tag' ),
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions')
  );

  register_post_type( 'padres-prospects', $args );
}
add_action( 'init', 'post_type_padres_prospects' );



/* Padres Trail */
function post_type_padres_trail() {
  $labels = array(
    'name' => 'Padres Trail',
    'add_new_item' => 'Add New Padres Trail Post',
    'new_item' => 'New Padres Trail Post',
    'all_items' => 'All Padres Trail Posts',
    'view_item' => 'View Padres Trail Post',
    'search_items' => 'Search Padres Trail Posts',
    'not_found' =>  'No Padres Trail Post found',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'padres-trail' ),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 4,
    'taxonomies' => array( 'category', 'post_tag' ),
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions')
  );

  register_post_type( 'padres-trail', $args );
}
add_action( 'init', 'post_type_padres_trail' );


/* Vocal Minority */
function post_type_vocal_minority() {
  $labels = array(
    'name' => 'Vocal Minority',
    'add_new_item' => 'Add New Vocal Minority Post',
    'new_item' => 'New Vocal Minority Post',
    'all_items' => 'All Vocal Minority Posts',
    'view_item' => 'View Vocal Minority Post',
    'search_items' => 'Search Vocal Minority Posts',
    'not_found' =>  'No Vocal Minority Post found',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'vocal-minority' ),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 4,
    'taxonomies' => array( 'category', 'post_tag' ),
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions')
  );

  register_post_type( 'vocal-minority', $args );
}
add_action( 'init', 'post_type_vocal_minority' );


/* Woe Doctor */
function post_type_woe_doctor() {
  $labels = array(
    'name' => 'Woe Doctor',
    'add_new_item' => 'Add New Woe Doctor Post',
    'new_item' => 'New Woe Doctor Post',
    'all_items' => 'All Woe Doctor Posts',
    'view_item' => 'View Woe Doctor Post',
    'search_items' => 'Search Woe Doctor Posts',
    'not_found' =>  'No Woe Doctor Post found',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'woe-doctor' ),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 4,
    'taxonomies' => array( 'category', 'post_tag' ),
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions')
  );

  register_post_type( 'woe-doctor', $args );
}
add_action( 'init', 'post_type_woe_doctor' );

/* Padres and Pints */
function post_type_padres_and_pints() {
  $labels = array(
    'name' => 'Padres and Pints',
    'add_new_item' => 'Add New Padres and Pints Post',
    'new_item' => 'New Padres and Pints Post',
    'all_items' => 'All Padres and Pints Posts',
    'view_item' => 'View Padres and Pints Post',
    'search_items' => 'Search Padres and Pints Posts',
    'not_found' =>  'No Padres and Pints Post found',
  );

  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'padres-and-pints' ),
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => 4,
    'taxonomies' => array( 'category', 'post_tag' ),
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions')
  );

  register_post_type( 'padres-and-pints', $args );
}
add_action( 'init', 'post_type_padres_and_pints' );