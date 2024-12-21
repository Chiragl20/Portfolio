<!DOCTYPE html> 
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <?php
    $font_family = get_theme_mod( 'body_font_family', 'Roboto' );
    ?>
    <link href="https://fonts.googleapis.com/css2?family=<?php echo urlencode( $font_family ); ?>:wght@400;700&display=swap" rel="stylesheet">
    <style>
    body {
        font-size: <?php echo get_theme_mod( 'body_font_size', 16 ); ?>px;
        font-family: '<?php echo esc_attr( $font_family ); ?>', sans-serif;
    }

    h1 {
        font-size: <?php echo get_theme_mod( 'heading_h1_size', 32 ); ?>px;
    }

    h2 {
        font-size: <?php echo get_theme_mod( 'heading_h2_size', 28 ); ?>px;
    }

    .site-header {
        background-color: #fff;
        padding: 15px 20px;
        border-bottom: 1px solid #ddd;
    }

    .site-header .container {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .logo img {
        height: 50px;
    }

    .menu-toggle{
        display: none;
    }

    .main-menu .menu {
        list-style: none;
        display: flex;
        margin: 0;
        padding: 0;
    }

    .main-menu .menu li {
        position: relative;
        margin: 0 15px;
    }

    .main-menu .menu li a {
        text-decoration: none;
        color: #333;
        font-weight: 600;
    }

    .main-menu .menu li:hover > .sub-menu {
        display: block;
    }

    .main-menu .menu .sub-menu {
        display: none;
        position: absolute;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-top: 10px;
        padding: 10px;
        border-radius: 4px;
    }

    .main-menu .menu .sub-menu li {
        margin: 0;
    }

    .main-menu .menu .sub-menu li a {
        color: #555;
        padding: 5px 10px;
        display: block;
    }

    .header-button .btn {
        background-color: #0073e6;
        color: #fff;
        padding: 10px 20px;
        text-decoration: none;
        font-weight: 600;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    .header-button .btn:hover {
        background-color: #005bb5;
    }

    /* Responsive Styles */
    @media screen and (max-width: 768px) {
        .header-button .btn{
            display:none;
        }
        .site-header .container {
        flex-direction: row;
        align-items: center;
        }

        /* Hide menu links by default on mobile */
        .main-menu .menu {
            display: none;
            flex-direction: column;
            width: 100%;
            padding: 0;
            margin-top: 10px;
        }

        .main-menu .menu li {
            margin: 10px 0;
        }

        .main-menu .menu li a {
            padding: 10px;
            font-size: 16px;
        }

        .logo img {
            height: 40px;
        }

        .header-button .btn {
            margin-top: 10px;
        }

        /* Show toggle button on mobile only */
        .menu-toggle {
            display: block;
            background: none;
            border: none;
            font-size: 30px;
            cursor: pointer;
            margin-top: -8px;
        }

        /* Show menu when active */
        .main-menu .menu.active {
            display: flex;
        }

        /* Hide the toggle on desktop */
        @media screen and (min-width: 769px) {
            .menu-toggle {
                display: none;
            }

            /* Make sure menu is visible on desktop */
            .main-menu .menu {
                display: flex;
            }
        }
    }
    </style>
</head>

<body <?php body_class(); ?>>

<header class="site-header">
    <div class="container">
        <!-- Logo -->
        <div class="logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <h1><?php bloginfo( 'name' ); ?></h1>
                <?php endif; ?>
            </a>
        </div>

        <!-- Navigation Menu -->
        <nav class="main-menu">
            <?php 
            wp_nav_menu( array(
                'theme_location' => 'header-menu',
                'menu_class'     => 'menu',
                'container'      => false,
            ) );
            ?>
        </nav>

        <!-- Mobile Hamburger Button -->
        <button class="menu-toggle">&#9776;</button>

        <!-- Header Button -->
        <div class="header-button">
            <a href="<?php echo esc_url( home_url( '/get-started' ) ); ?>" class="btn">Get Started</a>
        </div>

        
    </div>
</header>

<?php wp_body_open(); ?>
<script>
    // Toggle mobile menu
    const menuToggle = document.querySelector('.menu-toggle');
    const menu = document.querySelector('.main-menu .menu');

    menuToggle.addEventListener('click', () => {
        menu.classList.toggle('active');
    });
</script>
</body>
</html>
