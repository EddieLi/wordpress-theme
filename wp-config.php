<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '58zEKB|7]8kP>2K-Ex*WU(O#Fyd=S]jR4>M`c9nq.cFqFYcab7nkVh-AS  vib2y');
define('SECURE_AUTH_KEY',  'ky.CfzNND)o%t3,@fopQd?{;n{p0Y]xux)B)N-?&.TII*xR.-7yIOd!>ew^S7FON');
define('LOGGED_IN_KEY',    '- (>M )p$}8A*zsY{?Dn7@T+V|N5GF9T|# LQk-N_1VLG/2B|d%^0*k.3hN!ZC+H');
define('NONCE_KEY',        'E-^t6{%p95@;9,sz#&IF1o8pW$q:Mxi`1Kw<Sj!dBp;_e}o!3ElO;KKwnW)~v6xr');
define('AUTH_SALT',        '3MU=|7zF17bZ5IZ(m&a_4g^)JH_+.Qo#aeW}!fJ6Z1vr.WKv]9/@N^VWafc,<B60');
define('SECURE_AUTH_SALT', 'g>+?DkUK_KjPUWvy c$0}TI:yq{w_c`2|vx%Tc&n.Ab8^0GuFtpt(?VU&2>Ia{ch');
define('LOGGED_IN_SALT',   'Y_58vCIb9BdB-4Q.iA3h3u.OJC?i#Z;t2&61Ax4[!h5Q46T*Ziw?9?E+q-(uXr/T');
define('NONCE_SALT',       'X?2<(@1+>-D6flj>L<S98j!c}(%)O%h{fMroLoya).@m&F|FfBAdfkVtiHEkndHZ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
