<?php get_header(); ?>
<div class="project-single">
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
            ?> &raquo; <?php the_title(); ?><!-- This will display the title of the current project if on a single project page -->
        </p>
    </div>
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post(); ?>
            <h1><?php the_title(); ?></h1>
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
            <div class="project-content">
                <?php the_content(); ?>
            </div>
        <?php endwhile;
    endif;
    ?>
</div>
<?php get_footer(); ?>

<style>
/* General Reset */
body {
    margin: 0;
    font-family: Arial, sans-serif;
    line-height: 1.6;
    color: #333;
    background-color: #f9f9f9;
}

.project-single {
    margin: 50px;
    padding: 20px;
    background: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}

/* Project Title */
.project-single h1 {
    font-size: 2.2em;
    font-weight: bold;
    color: #222;
    margin-bottom: 20px;
}

/* Featured Image */
.project-image {
    margin-bottom: 20px;
}

.project-image img {
    width: auto;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Project Content */
.project-content {
    font-size: 1.1em;
    line-height: 1.15;
    margin-bottom: 20px;
    color: #555;
}

.project-content p {
    margin-bottom: 15px;
}

/* Project Types */
.project-types {
    margin-top: 30px;
    padding: 10px;
    background: #f1f1f1;
    border-left: 4px solid #0073aa;
    border-radius: 5px;
}

.project-types strong {
    font-weight: bold;
    color: #0073aa;
}

.project-types span {
    background: #0073aa;
    color: #fff;
    padding: 4px 8px;
    margin-right: 8px;
    border-radius: 3px;
    font-size: 0.9em;
}

/* Responsive Design */
@media (max-width: 768px) {
    .project-single {
        padding: 15px;
    }

    .project-single h1 {
        font-size: 1.8em;
    }

    .project-content {
        font-size: 1em;
    }

    .project-types span {
        font-size: 0.8em;
    }
}
</style>
