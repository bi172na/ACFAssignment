<?php
/**
 * practical functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package practical
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function practical_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on practical, use a find and replace
		* to change 'practical' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'practical', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'practical' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'practical_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'practical_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function practical_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'practical_content_width', 640 );
}
add_action( 'after_setup_theme', 'practical_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function practical_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'practical' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'practical' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'practical_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function practical_scripts() {
	wp_enqueue_style( 'practical-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'practical-style', 'rtl', 'replace' );

	wp_enqueue_script( 'practical-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script('main-js',
        get_template_directory_uri() . '/js/main.js',
        ['jquery'],
        null,
        true
    );
	wp_enqueue_style(
        'practical-google-fonts',
        'https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap',
        array(),
        null
    );

    wp_localize_script('main-js', 'ajax_object', [
        'ajax_url' => admin_url('admin-ajax.php')
    ]);
}
add_action( 'wp_enqueue_scripts', 'practical_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

if ( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'  => 'Theme Options',
        'menu_title'  => 'Theme Options',
        'menu_slug'   => 'theme-options',
        'capability'  => 'edit_posts',
        'redirect'    => false
    ));

}
function practical_register_property_cpt() {

    $labels = array(
        'name'               => _x( 'Properties', 'post type general name', 'practical' ),
        'singular_name'      => _x( 'Property', 'post type singular name', 'practical' ),
        'menu_name'          => __( 'Properties', 'practical' ),
        'name_admin_bar'     => __( 'Property', 'practical' ),
        'add_new'            => __( 'Add New', 'practical' ),
        'add_new_item'       => __( 'Add New Property', 'practical' ),
        'new_item'           => __( 'New Property', 'practical' ),
        'edit_item'          => __( 'Edit Property', 'practical' ),
        'view_item'          => __( 'View Property', 'practical' ),
        'all_items'          => __( 'All Properties', 'practical' ),
        'search_items'       => __( 'Search Properties', 'practical' ),
        'not_found'          => __( 'No properties found.', 'practical' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'menu_icon'          => 'dashicons-building',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'properties' ),
        'show_in_rest'       => true,
    );

    register_post_type( 'property', $args );


    // Taxonomy
    $tax_labels = array(
        'name'          => __( 'Property Types', 'practical' ),
        'singular_name' => __( 'Property Type', 'practical' ),
        'search_items'  => __( 'Search Property Types', 'practical' ),
        'all_items'     => __( 'All Property Types', 'practical' ),
        'edit_item'     => __( 'Edit Property Type', 'practical' ),
        'update_item'   => __( 'Update Property Type', 'practical' ),
        'add_new_item'  => __( 'Add New Property Type', 'practical' ),
        'menu_name'     => __( 'Property Types', 'practical' ),
    );

    $tax_args = array(
        'labels'            => $tax_labels,
        'hierarchical'      => true,
        'public'            => true,
        'rewrite'           => array( 'slug' => 'property-type' ),
        'show_admin_column' => true,
        'show_in_rest'      => true,
    );

    register_taxonomy( 'property_type', array( 'property' ), $tax_args );
}

add_action( 'init', 'practical_register_property_cpt' );
/**
 * Bed Icon SVG
 */
function practical_icon_bed() {
    return '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2c7fb8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M2 10h20v7H2z"/>
        <path d="M4 10V6h6v4"/>
        <path d="M14 10V7h6v3"/>
    </svg>';
}

/**
 * Bath Icon SVG
 */
function practical_icon_bath() {
    return '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2c7fb8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 10h18"/>
        <path d="M5 10v4a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4v-4"/>
        <path d="M7 10V6a2 2 0 0 1 4 0"/>
    </svg>';
}

/**
 * Area Icon SVG
 */
function practical_icon_area() {
    return '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#2c7fb8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <rect x="3" y="3" width="18" height="18" rx="2"/>
        <path d="M9 3v18M3 9h18"/>
    </svg>';
}

function practical_load_properties() {

    $paged = $_POST['page'];
    $term  = $_POST['term'];

    $args = [
        'post_type' => 'property',
        'posts_per_page' => 6,
        'paged' => $paged,
        'tax_query' => [
            [
                'taxonomy' => 'property_type',
                'field'    => 'slug',
                'terms'    => $term,
            ]
        ]
    ];

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();

    $property_id = get_field('property_id');
    $address     = get_field('address');
    $beds        = get_field('bedrooms');
    $baths       = get_field('bathrooms');
    $area        = get_field('area');
    $price       = get_field('price');
    $status      = get_field('status');
    ?>

    <div class="property-card">

        <div class="property-image">
            <?php the_post_thumbnail('large'); ?>

            <?php if ($status): ?>
                <span class="property-status">
                    <?php echo esc_html($status); ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="property-content">

            <h4 class="property-id">
                #<?php echo esc_html($property_id); ?>
            </h4>

            <p class="property-address">
                <?php echo esc_html($address); ?>
            </p>

           <div class="property-meta">

    <span class="meta-item">
        <?php echo practical_icon_bed(); ?>
        <?php echo esc_html( $beds ); ?> Beds
    </span>

    <span class="meta-item">
        <?php echo practical_icon_bath(); ?>
        <?php echo esc_html( $baths ); ?> Baths
    </span>

    <span class="meta-item">
        <?php echo practical_icon_area(); ?>
        <?php echo esc_html( $area ); ?> Sq.Ft.
    </span>

</div>

            <div class="property-price">
                $<?php echo number_format($price); ?>
            </div>

        </div>

    </div>

<?php endwhile;

    endif;

    wp_die();
}

add_action('wp_ajax_load_properties', 'practical_load_properties');
add_action('wp_ajax_nopriv_load_properties', 'practical_load_properties');
