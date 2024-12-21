<?php
/**
 * Theme Functions File
 *
 * This file adds custom functionality to the WordPress theme.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Enqueue styles and scripts.
 */
function my_theme_enqueue_assets() {
    // Enqueue theme stylesheet.
    wp_enqueue_style( 'portfolio-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

    // Enqueue additional styles.
    wp_enqueue_style( 'portfolio-custom-style', get_template_directory_uri() . 'style.css', array( 'portfolio-style' ), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_assets' );

/* Code Start From Here */

// Enable featured image support 
add_theme_support('post-thumbnails');

/* Custom Post Type Start */
function create_project_cpt() {
    // Register the Projects Custom Post Type
    register_post_type('project',
        // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Projects' ),
                'singular_name' => __( 'Project' ),
                'add_new' => __( 'Add New' ),
                'add_new_item' => __( 'Add New Project' ),
                'edit_item' => __( 'Edit Project' ),
                'new_item' => __( 'New Project' ),
                'view_item' => __( 'View Project' ),
                'search_items' => __( 'Search Projects' ),
                'not_found' => __( 'No projects found' ),
                'not_found_in_trash' => __( 'No projects found in Trash' ),
                'menu_name' => __( 'Projects' ),
            ),
            'public' => true,
            'has_archive' => true,
            'show_in_rest' => true, // Enable Gutenberg editor support
            'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
            'taxonomies' => array('project_type'), // Adding custom taxonomy
            'menu_icon' => 'dashicons-portfolio', // Icon for the CPT
            'rewrite' => array('slug' => 'projects'),
        )
    );
}
add_action('init', 'create_project_cpt');
/* Custom Post Type End */

/* Custom Taxonomy Start */
function create_project_taxonomy() {
    // Register the Project Type custom taxonomy
    $args = array(
        'hierarchical' => true,
        'labels' => array(
            'name' => 'Project Types',
            'singular_name' => 'Project Type',
            'search_items' => 'Search Project Types',
            'all_items' => 'All Project Types',
            'parent_item' => 'Parent Project Type',
            'parent_item_colon' => 'Parent Project Type:',
            'edit_item' => 'Edit Project Type',
            'update_item' => 'Update Project Type',
            'add_new_item' => 'Add New Project Type',
            'new_item_name' => 'New Project Type Name',
            'menu_name' => 'Project Type',
        ),
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_rest' => true, // Enable Gutenberg block editor support
        'query_var' => true,
        'rewrite' => array('slug' => 'project-type'),
    );
    register_taxonomy('project_type', array('project'), $args);
}
add_action('init', 'create_project_taxonomy');
/* Custom Taxonomy End */

/* Shortcode For Display Projects with Read More Option */
function display_projects_shortcode( $atts ) {
    ob_start();
    $args = array(
        'post_type' => 'project',
        'posts_per_page' => 10,
    );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) : ?>
        <div class="projects-grid">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="project-item">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail( 'medium' ); ?>
                        </a>
                    <?php endif; ?>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="project-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="read-more-btn">Read More</a>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <p>No projects found.</p>
    <?php endif;
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode( 'display_projects', 'display_projects_shortcode' );
/*Shortcode For Display Projects End*/

/* Custom Header Menu Setup Start */
function custom_theme_setup() {
    register_nav_menus( array(
        'header-menu' => __( 'Header Menu', 'text-domain' ),
    ) );
}
add_action( 'after_setup_theme', 'custom_theme_setup' );
/* Custom Header Menu Setup End */

/* Custom Logo Setup Start */
function custom_theme_logo_setup() {
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
}
add_action( 'after_setup_theme', 'custom_theme_logo_setup' );
/* Custom Logo Setup End */

/* Custom Typography Option Start */
function theme_customize_register( $wp_customize ) {

    // Global Typography Section
    $wp_customize->add_section( 'global_typography_section', array(
        'title'    => __( 'Global Typography', 'text-domain' ),
        'priority' => 20,
    ) );

    // Add Global Font Settings (Body Font)
    $wp_customize->add_setting( 'body_font_size', array(
        'default'           => '16',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'body_font_size', array(
        'type'    => 'number',
        'section' => 'global_typography_section', // Correct section
        'label'   => __( 'Body Font Size (px)', 'text-domain' ),
        'priority' => 20,
    ) );

    // Heading Font Size (H1)
    $wp_customize->add_setting( 'heading_h1_size', array(
        'default'           => '32',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'heading_h1_size', array(
        'type'    => 'number',
        'section' => 'global_typography_section', // Correct section
        'label'   => __( 'H1 Font Size (px)', 'text-domain' ),
        'priority' => 20,
    ) );

    // Heading Font Size (H2)
    $wp_customize->add_setting( 'heading_h2_size', array(
        'default'           => '28',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'heading_h2_size', array(
        'type'    => 'number',
        'section' => 'global_typography_section', // Correct section
        'label'   => __( 'H2 Font Size (px)', 'text-domain' ),
        'priority' => 30,
    ) );

    // Heading Font Size (H3)
    $wp_customize->add_setting( 'heading_h3_size', array(
        'default'           => '24',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'heading_h3_size', array(
        'type'    => 'number',
        'section' => 'global_typography_section', // Correct section
        'label'   => __( 'H3 Font Size (px)', 'text-domain' ),
        'priority' => 40,
    ) );

    // Heading Font Size (H4)
    $wp_customize->add_setting( 'heading_h4_size', array(
        'default'           => '20',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'heading_h4_size', array(
        'type'    => 'number',
        'section' => 'global_typography_section', // Correct section
        'label'   => __( 'H4 Font Size (px)', 'text-domain' ),
        'priority' => 50,
    ) );

    // Heading Font Size (H5)
    $wp_customize->add_setting( 'heading_h5_size', array(
        'default'           => '18',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'heading_h5_size', array(
        'type'    => 'number',
        'section' => 'global_typography_section', // Correct section
        'label'   => __( 'H5 Font Size (px)', 'text-domain' ),
        'priority' => 60,
    ) );

    // Heading Font Size (H6)
    $wp_customize->add_setting( 'heading_h6_size', array(
        'default'           => '16',
        'sanitize_callback' => 'absint',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'heading_h6_size', array(
        'type'    => 'number',
        'section' => 'global_typography_section', // Correct section
        'label'   => __( 'H6 Font Size (px)', 'text-domain' ),
        'priority' => 70,
    ) );
  

    // Fetch Google Fonts
    $google_fonts = theme_enqueue_google_fonts();

    // Add Font Family Setting
    $wp_customize->add_setting( 'body_font_family', array(
        'default'           => 'Roboto',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'body_font_family', array(
        'type'     => 'select',
        'section'  => 'global_typography_section', // Correct section
        'label'    => __( 'Body Font Family', 'text-domain' ),
        'choices'  => $google_fonts,
        'priority' => 10,
    ) );
}
add_action( 'customize_register', 'theme_customize_register' );

/* Custom Typography Option End */

// Enqueue Google Fonts
function theme_enqueue_google_fonts() {
    $fonts = array(
        'Roboto'          => 'Roboto',
        'Open Sans'       => 'Open Sans',
        'Lato'            => 'Lato',
        'Montserrat'      => 'Montserrat',
        'Oswald'          => 'Oswald',
        'Poppins'         => 'Poppins',
        'Source Sans Pro' => 'Source Sans Pro',
        'Playfair Display'=> 'Playfair Display',
        'Nunito'          => 'Nunito',
        // Add more fonts here or dynamically load them
    );

    return $fonts;
}


// Output Custom CSS
function theme_custom_typography_css() {
    $body_font_size  = get_theme_mod('body_font_size', 16);
    $heading_h1_size = get_theme_mod('heading_h1_size', 32);
    $heading_h2_size = get_theme_mod('heading_h2_size', 28);
    $body_font_family = get_theme_mod('body_font_family', 'Roboto');

    $custom_css = "
        body {
            font-family: '{$body_font_family}', sans-serif;
            font-size: {$body_font_size}px;
        }
        h1 {
            font-size: {$heading_h1_size}px;
        }
        h2 {
            font-size: {$heading_h2_size}px;
        }
    ";

    wp_add_inline_style('theme-google-fonts', $custom_css);
}
add_action('wp_enqueue_scripts', 'theme_custom_typography_css');

// Enqueue Customizer Live Preview Script
function theme_customizer_live_preview() {
    wp_enqueue_script(
        'theme-customizer',
        get_template_directory_uri() . '/js/theme-customizer.js',
        array('jquery', 'customize-preview'),
        null,
        true
    );
}
add_action('customize_preview_init', 'theme_customizer_live_preview');


/*Filter project type start*/
// Enqueue jQuery
function enqueue_ajax_filter_script() {
    wp_enqueue_script( 'jquery' );
}
add_action( 'wp_enqueue_scripts', 'enqueue_ajax_filter_script' );

// Handle the AJAX request for filtering projects
function filter_projects() {
    // Get the selected project type
    $project_type = isset($_GET['project_type']) ? $_GET['project_type'] : '';
    
    // Get the current page number for pagination
    $paged = isset($_GET['paged']) ? $_GET['paged'] : 1;

    // Define the query arguments for filtering and pagination
    $args = array(
        'post_type' => 'project',  // Replace 'project' with your custom post type
        'posts_per_page' => 2,     // Set the number of posts per page
        'paged' => $paged,         // Add pagination support
    );

    // If a project type is selected, filter by taxonomy
    if (!empty($project_type)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'project_type', // Custom taxonomy name
                'field'    => 'slug',
                'terms'    => $project_type,
            ),
        );
    }

    // Custom query for fetching projects
    $projects = new WP_Query($args);

    ?>
    
    <div class="breadcrumbs">
    <p id="breadcrumbs">
        <a href="<?php echo esc_url(home_url()); ?>">Home</a>
        <?php
        if (is_singular('project')) {
            // If we are on a single project page, add the "Projects" link
            echo ' &raquo; <a href="' . esc_url(get_post_type_archive_link('project')) . '">Projects</a>';
        } elseif (is_post_type_archive('project')) {
            // If we are on the "Projects" archive page, no need to add the "Projects" link
            echo ' &raquo; Projects';
        }
        ?> <!-- This will display the title of the current project if on a single project page -->
    </p>
</div>

    <?php 

    // Start the output buffer
    if ($projects->have_posts()) :
        while ($projects->have_posts()) : $projects->the_post(); ?>
            <div class="project-item">
                <h1><?php echo wp_trim_words(get_the_title(), 5, '...'); ?></h1>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="project-image">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <?php
            // Display custom taxonomy terms (Project Types)
            $terms = get_the_terms( get_the_ID(), 'project_type' );
            if ( $terms && ! is_wp_error( $terms ) ) :
                echo '<div class="project-types">';
                foreach ( $terms as $term ) {
                    echo '<span>' . esc_html( $term->name ) . '</span> ';
                }
                echo '</div>';
            endif;
            ?>
                <?php endif; ?>
                <div class="project-excerpt">
                    <?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?>
                </div>
                <div class="read-more">
                    <a href="<?php the_permalink(); ?>">Read More</a>
                </div>
            </div>
        <?php endwhile;

        // Pagination
        echo '<div class="pagination" style="display:none;">';
        echo paginate_links(array(
            'total' => $projects->max_num_pages, // Total number of pages
            'current' => $paged,                 // Current page number
            'prev_text' => __('« Previous'),     // Text for previous page link
            'next_text' => __('Next »'),         // Text for next page link
        ));
        echo '</div>';

    else :
        echo 'No projects found.';
    endif;

    // Reset post data
    wp_reset_postdata();

    // End the request
    die();
}
add_action( 'wp_ajax_filter_projects', 'filter_projects' );
add_action( 'wp_ajax_nopriv_filter_projects', 'filter_projects' );


// Add Duplicate Post Link to Project CPT
function add_duplicate_post_link($actions, $post) {
    if ($post->post_type === 'project') {
        $duplicate_link = admin_url('admin.php?action=duplicate_post&post=' . $post->ID);
        $actions['duplicate'] = '<a href="' . esc_url($duplicate_link) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
    }
    return $actions;
}
add_filter('post_row_actions', 'add_duplicate_post_link', 10, 2);

// Handle Duplicate Post Action
function handle_duplicate_post() {
    if (!isset($_GET['action']) || $_GET['action'] !== 'duplicate_post' || !isset($_GET['post'])) {
        return;
    }

    $post_id = absint($_GET['post']);
    $original_post = get_post($post_id);

    if (!$original_post || $original_post->post_type !== 'project') {
        wp_die('Invalid post to duplicate.');
    }

    // Duplicate Post Data
    $new_post_data = [
        'post_title'    => $original_post->post_title . ' (Copy)',
        'post_content'  => $original_post->post_content,
        'post_status'   => 'draft',
        'post_type'     => $original_post->post_type,
        'post_author'   => get_current_user_id(),
    ];

    $new_post_id = wp_insert_post($new_post_data);

    // Duplicate Post Metadata
    $meta_data = get_post_meta($post_id);
    foreach ($meta_data as $key => $values) {
        foreach ($values as $value) {
            add_post_meta($new_post_id, $key, $value);
        }
    }

    // Duplicate Taxonomies
    $taxonomies = get_object_taxonomies($original_post->post_type);
    foreach ($taxonomies as $taxonomy) {
        $terms = wp_get_object_terms($post_id, $taxonomy, ['fields' => 'ids']);
        wp_set_object_terms($new_post_id, $terms, $taxonomy);
    }

    // Redirect to the new post's edit screen
    wp_redirect(admin_url('post.php?action=edit&post=' . $new_post_id));
    exit;
}
add_action('admin_action_duplicate_post', 'handle_duplicate_post');

