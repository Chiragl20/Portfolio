<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme. It is used to display a page when no other specific template matches a query.
 *
 * @package YourThemeName
 */

get_header(); ?>

<style>
#main{
    padding: 50px;
} </style>

<main id="main" class="site-main">
    <?php if ( have_posts() ) : ?>
        <header class="page-header">
        </header><!-- .page-header -->

        <?php
        // Start the Loop
        while ( have_posts() ) : the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                <div class="entry-content">
                    <?php
                    the_content();

                    // Display pagination for multi-page posts
                    wp_link_pages();
                    ?>
                </div><!-- .entry-content -->

               
            </article><!-- #post-<?php the_ID(); ?> -->

        <?php endwhile; // End of the loop. ?>

    <?php else : ?>
        <p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'portfolio' ); ?></p>
    <?php endif; ?>
</main><!-- #main -->

<?php
get_footer();
