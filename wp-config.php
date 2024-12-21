<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'portfolio' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'bnf_hGMdR1Jgl*s+(y=;%(KO)AkK<0?Q|ug#G84]D[9,8{gY_KOdm=2Z+UCVP3_7' );
define( 'SECURE_AUTH_KEY',  'VN&5MfpFr]lLVisvBtjk0+)m6Y[YR`Y+AK;64vBO@/vNL/ d?<NAg5g%hnP!X*Fv' );
define( 'LOGGED_IN_KEY',    'Ddy@#x)O+@qUc:ZY#z[e[$V#o1p.(<f?$b>#Ln0LTGG}9cjp8bcYJ1SW1D~OFN)A' );
define( 'NONCE_KEY',        'h{-}WnvS ckM(>20_53giUe%o7fkKwifA5UJsv>vKdaB^Z6V41q@H7$J{7P@r0^9' );
define( 'AUTH_SALT',        'pCz@0zs#_kvhbCHDfidS-1DPx2IOr)NP4l[^Zv>7ZKFyjX1/Wf/5pzZT_iz?3wv2' );
define( 'SECURE_AUTH_SALT', 'PsX:nt*{8MHbux`d;3$yp=*>&=-:Sw0:!HEdD9Z(6rlyyWVSd@#WZ,hn& v6zmn8' );
define( 'LOGGED_IN_SALT',   '6Pj6Z5+OCZ31qeZ%.:/hUO7V.sA b =+oN%m}c31g=gDfrA}!NguO%cqiZSi6K!8' );
define( 'NONCE_SALT',       'l|$Qs:<X8&3c)/h:we:m;-=Q!D}vbOQ7B+*Lwd|@O6ZA2+qWaX?8mQ~dWc_<[`|Z' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'pf_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
