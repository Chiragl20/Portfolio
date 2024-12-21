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
            ?> <!-- This will display the title of the current project if on a single project page -->
        </p>
    </div>

    <div class="project-header">
        <!-- Dynamic Dropdown for Project Types -->
        <select name="project-filter" id="filter">
            <option value="select">Category</option>
            <?php 
            // Fetch terms for the 'project_type' taxonomy
            $terms = get_terms(array(
                'taxonomy' => 'project_type', // Correct taxonomy name
                'orderby' => 'name', // Order terms alphabetically
                'order' => 'ASC',  // Ascending order
                'hide_empty' => false, // Show even empty terms
            ));

            // Check if terms are retrieved successfully
            if (!empty($terms) && !is_wp_error($terms)) :
                foreach ($terms as $term) : ?>
                    <option value="<?php echo esc_attr($term->slug); ?>">
                        <?php echo esc_html($term->name); ?>
                    </option>
                <?php endforeach; 
            else : ?>
                <option value="" disabled>No categories found</option>
            <?php endif; ?>
        </select>


        <!-- Sorting Dropdown -->
        <select name="project-sort" id="sort">
            <option value="select">Sort By</option>
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select>

        <!-- Clear Button -->
        <button id="clear-filter" style="display:none; margin-left: 10px;">Clear</button>
    </div>

    <div id="projects-container">
        <?php
        // Pagination setup
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'project', // Adjust this to your post type
            'posts_per_page' => 2, // Number of posts per page
            'paged' => $paged,
        );

        // Apply sorting logic
        if (isset($_GET['project-sort']) && $_GET['project-sort'] == 'asc') {
            $args['order'] = 'ASC';
        } elseif (isset($_GET['project-sort']) && $_GET['project-sort'] == 'desc') {
            $args['order'] = 'DESC';
        }

        // Apply category filtering logic
        if (isset($_GET['project_type']) && !empty($_GET['project_type'])) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'project', // Custom taxonomy
                    'field'    => 'slug',
                    'terms'    => $_GET['project_type'],
                    'operator' => 'IN',
                ),
            );
        }

        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post(); ?>
                <div class="project-item">
                    <h1><?php echo wp_trim_words(get_the_title(), 5, '...'); ?></h1>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="project-image">
                            <?php the_post_thumbnail(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php
                    // Display related project types (taxonomy terms)
                    $project_types = get_the_terms(get_the_ID(), 'project_type');

                    if (!empty($project_types) && !is_wp_error($project_types)) :
                        echo '<div class="project-types">';
                        $project_type_names = array();

                        foreach ($project_types as $project_type) {
                            $project_type_names[] = $project_type->name;
                        }

                        echo implode(', ', $project_type_names);
                        echo '</div>';
                    endif;
                    ?>
                    
                    <div class="project-excerpt">
                        <?php echo wp_trim_words(get_the_excerpt(), 10, '...'); ?>
                    </div>
                    <div class="read-more">
                        <a href="<?php the_permalink(); ?>">Read More</a>
                    </div>
                </div>
            <?php endwhile;           

        wp_reset_postdata();
        ?>
    </div><?php
    // Pagination Links
            echo '<div class="pagination">';
            echo paginate_links(array(
                'total' => $query->max_num_pages,
                'current' => $paged,
                'prev_text' => __('« Previous'),
                'next_text' => __('Next »'),
            ));
            echo '</div>';

        else :
            echo '<p>No projects found.</p>';
        endif;?>
</div>

<script>
document.getElementById('filter').addEventListener('change', function() {
    var selectedCategory = this.value;
    
    // Show the Clear button only if a category is selected
    if (selectedCategory !== 'select') {
        document.getElementById('clear-filter').style.display = 'inline-block';
    } else {
        document.getElementById('clear-filter').style.display = 'none';
    }

    // Use AJAX to fetch the filtered results
    var data = {
        'action': 'filter_projects',
        'project_type': selectedCategory,
        'project_sort': document.getElementById('sort').value
    };

    jQuery.ajax({
        url: '<?php echo admin_url( "admin-ajax.php" ); ?>',
        type: 'GET',
        data: data,
        success: function(response) {
            // Update the projects container with the new content
            document.getElementById('projects-container').innerHTML = response;
        }
    });
});

// Sorting functionality
document.getElementById('sort').addEventListener('change', function() {
    var selectedSort = this.value;
    
    // Use AJAX to fetch the sorted results
    var data = {
        'action': 'filter_projects',
        'project_sort': selectedSort,
        'project_type': document.getElementById('filter').value
    };

    jQuery.ajax({
        url: '<?php echo admin_url( "admin-ajax.php" ); ?>',
        type: 'GET',
        data: data,
        success: function(response) {
            // Update the projects container with the new content
            document.getElementById('projects-container').innerHTML = response;
        }
    });
});



// Clear filter button functionality
document.getElementById('clear-filter').addEventListener('click', function() {
    // Reset the dropdowns to the default options
    document.getElementById('filter').value = 'select';
    document.getElementById('sort').value = 'select';

    // Hide the Clear button again
    document.getElementById('clear-filter').style.display = 'none';

    // Use AJAX to fetch the original unfiltered results
    var data = {
        'action': 'filter_projects',
        'project_type': '',
        'project_sort': ''
    };

    jQuery.ajax({
        url: '<?php echo admin_url( "admin-ajax.php" ); ?>',
        type: 'GET',
        data: data,
        success: function(response) {
            // Update the projects container with the original content
            document.getElementById('projects-container').innerHTML = response;
        }
    });
});
</script>

<?php get_footer(); ?>

<style>
.pagination {
    margin: 50px;
}

.pagination a, .pagination span {
    margin: 0 5px;
    padding: 8px 12px;
    background-color: #0073e6;
    color: #fff;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.pagination a:hover {
    background-color: #005bb5;
}

.pagination .current {
    background-color: #005bb5;
}

/* Container styling */
#projects-container {
    display: flex;
    margin: 30px;
}

.project-single {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    font-family: Arial, sans-serif;
}

/* Header for the project filter */
.project-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

/* Dropdown styling */
#filter, #sort {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    width: 200px;
    transition: all 0.3s ease;
    margin: 0 20px;
}

/* Clear button styling */
#clear-filter {
    background-color: #ff5e5e;
    color: white;
    padding: 8px 15px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

#clear-filter:hover {
    background-color: #e04f4f;
}

/* Individual project block styling */
.project-item {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin: 10px;
    padding: 20px;
    box-sizing: border-box;
    transition: box-shadow 0.3s ease, transform 0.3s ease;
    display: block;
    width: 50%;
}

/* Project block hover effect */
.project-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Project title */
.project-item h1 {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    margin: 10px 0;
}

/* Project image */
.project-item .project-image img {
    max-width: 100%;
    border-radius: 5px;
    height: auto;
    margin-bottom: 15px;
}

/* Project excerpt styling */
.project-item .project-excerpt {
    font-size: 16px;
    color: #666;
    line-height: 1.5;
    margin-bottom: 20px;
}

/* Read more button */
.project-item .read-more a {
    color: #0073e6;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

.project-item .read-more a:hover {
    color: #005bb5;
}

/* Media Queries for responsiveness */
@media (max-width: 768px) {
    #projects-container {
    display: flex;
    margin: 0px !important;
    flex-direction: column;
}
    /* Make projects stack vertically on small screens */
    .project-item {
        margin: 0px 0px 15px 0px;
        width: 100%;
    }

    /* Adjust dropdown and button width for smaller screens */
    #filter {
        width: 100%;
    }
}

/* Styling for Clear button when visible */
#clear-filter {
    display: inline-block;
    margin-left: 10px;
}

</style>
