<?php 
/**
 * Footer Template
 *
 * This is the template for the footer of the website.
 *
 * @package WordPress
 * @subpackage portfolio
 * @since 1.0
 */

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
/* Basic Styling */
body {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
}

h1 {
  font-size: 2.5em;
  margin-bottom: 5px;
}

p {
  font-size: 16px;
  margin-bottom: 15px;
}

/* Footer Row */
.footer-row {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  padding: 20px 0;
}

/* Social Icons */
.social-icons {
  display: inline-block;
  margin: 10px auto;
}

ul.social-links {
    display: flex;
    justify-content: space-between;
    width: 30%;
}

ul.social-links li {
    margin-right: 10px;
}

.social-icons a {
  display: inline-block;
  margin: 0 5px;
  color: #fff;
  font-size: 1.5em;
  transition: color 0.3s;
}

.social-icons a:hover {
  color: #ddd; 
}

/* Navigation */
nav {
  padding: 15px;
  text-align: center;
}

nav ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

nav li {
  display: inline-block;
  margin: 0 20px;
}

nav a {
  color: #fff;
  text-decoration: none;
  transition: color 0.3s;
}

nav a:hover {
  color: #ddd; 
}

/* Contact Information */
.contact {
  padding: 20px;
}

.contact-info {
  display: inline-block;
  margin: 10px;
}

.contact-info h3 {
  margin-top: 0;
}

.contact-info p {
  margin-bottom: 5px;
}

/* Services */
.services {
  padding: 20px;
}

.services ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

.services li {
  margin-bottom: 10px;
}

/* Footer */
footer {
  background-color: #000;
  padding: 50px 50px 10px 50px;
  color: #fff;
}

footer ul {
  list-style: none;
  padding: 0; 
  margin: 0;
}

footer li {
  margin-bottom: 10px;
}

footer a {
  color: #fff;
  text-decoration: none;
  transition: color 0.3s;
}

footer a:hover {
  color: #ddd;
}

.footer-menu,.footer-services{
  margin-left:50px;
}

footer img.custom-logo {
    background: #fff;
    width: 150px;
    height: auto;
    padding: 14px;
    border-radius: 14px;
}
 

/* Back to Top Button */
.back-to-top {
  display: block;
  text-align: center;
  margin-top: 20px;
  color: #fff;
  font-size: 1.2em;
  transition: color 0.3s;
}

.back-to-top:hover {
  color: #ddd; 
}

.col-md-4 {
    width: 25%;
}

/*Footer text */
.footer-text {
    font-size: 14px;
    width: 70%;
}

.logo img {
    height: 50px;
    width: auto;
}

/* Icon Styling */
.footer-contact p i {
    margin-right: 10px;
    color: #fff; /* Icon color */
    font-size: 1.2em; /* Adjust size if needed */
    vertical-align: middle;
}

/* Responsive Design */
@media (max-width: 768px) {
  footer {
    background-color: #000;
    padding: 50px 20px 10px 20px;
    color: #fff;
  }
  .footer-row {
    flex-direction: column;
    align-items: flex-start;
  }

  .col-md-4 {
    width: 100%;
    margin-bottom: 20px;
  }

  .footer-menu, .footer-services {
    margin-left: 0;
  }

  .footer-logo, .footer-contact, .footer-services {
    text-align: left;
  }

  ul.social-links {
    justify-content: flex-start;
    gap: 10px;
    width: auto;
  }
}
</style>

<footer class="footer">
    <div class="footer_container">
        <div class="footer-row">
            <div class="col-md-4">
                <div class="footer-logo">
                    <p>
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <?php 
                        if ( has_custom_logo() ) {
                            the_custom_logo();
                        } else {
                            echo '<img src="'.get_template_directory_uri().'/images/logo.png" alt="'.get_bloginfo('name').'">'; 
                        }
                        ?>
                    </a>
                    </p>
                    <p class="footer-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    <ul class="social-links">
                        <li><a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-menu">
                    <h4>Page</h4>
                    <ul>
                        <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e( 'Home', 'portfolio' ); ?></a></li>
                        <li><a href="<?php 
                            $about_page = get_page_by_title('About');
                            echo esc_url($about_page ? get_page_link($about_page->ID) : '#'); 
                        ?>"><?php esc_html_e( 'About', 'portfolio' ); ?></a></li>
                        <li><a href="<?php 
                            $projects_page = get_page_by_title('Projects');
                            echo esc_url($projects_page ? get_page_link($projects_page->ID) : '#'); 
                        ?>"><?php esc_html_e( 'Projects', 'portfolio' ); ?></a></li>
                        <li><a href="<?php 
                            $contact_page = get_page_by_title('Contact');
                            echo esc_url($contact_page ? get_page_link($contact_page->ID) : '#'); 
                        ?>"><?php esc_html_e( 'Contact', 'portfolio' ); ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-contact">
                <h4>Contact Us</h4>
                    <p>
                        <i class="fas fa-map-marker-alt"></i> 
                        <?php esc_html_e( 'Address: 123 Main St, Anytown USA', 'portfolio' ); ?>
                    </p>
                    <p>
                        <i class="fas fa-envelope"></i> 
                        <?php esc_html_e( 'Email: info@example.com', 'portfolio' ); ?>
                    </p>
                    <p>
                        <i class="fas fa-phone"></i> 
                        <?php esc_html_e( 'Phone: (123) 456-7890', 'portfolio' ); ?>
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-services">
                    <h4>Services</h4>
                    <p><?php esc_html_e( 'WebSavvy Solutions', 'portfolio' ); ?></p>
                    <p><?php esc_html_e( 'SocialSphere', 'portfolio' ); ?></p>
                    <p><?php esc_html_e( 'SEO Wizardry', 'portfolio' ); ?></p>
                    <p><?php esc_html_e( 'Digital Dreams Agency', 'portfolio' ); ?></p>
                    <p><?php esc_html_e( 'Brand Brilliance', 'portfolio' ); ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p><?php esc_html_e( '© ' . date('Y') . ' Your Company. All rights reserved.', 'portfolio' ); ?></p>
    </div>
</footer>
