<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'nicole');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         '{_{dqL}`!j}>Y^Nwp-W)h>YBU<[P|FHGO2^|xc)sMhPnOn#,4-($(c=DmcTk#a{?');
define('SECURE_AUTH_KEY',  '%tZJAUq#fp{~y[{RwAi*4//.KF(H FX*|x5gi:8~%fL?({>/,$|h*a-P-u@y32fN');
define('LOGGED_IN_KEY',    '&Aj|~GE-~Xy.UX>?CV!GbY3?*iv9o40UA]:P$xYKM+noMSh(Eu+~L@M:$XkE_c=S');
define('NONCE_KEY',        'fZ)+}%ar6S:<,1N|qY]i1D]oqs`8+Q,q(V5JajhS!wec0iL6ts.}`7G ]M68%nF.');
define('AUTH_SALT',        '&b0fKmRE0o(jZHs/Ef{QpO+^<&[tvG34)%M@n2`^]H2k,lyX12L+A{&xNrhjG(](');
define('SECURE_AUTH_SALT', 'A:`V^WjhYl$;IJiQwgM%LjlYH 9vzSdQ(L8KqSY/DwK0M0p5XYs)Me,:c/wEwKw*');
define('LOGGED_IN_SALT',   'W2pX_~.HVnsTIK40L?gc%B}Zg8wV|&[H/IyP?dAt6^KF$J.[umdDD -qpsB]`hM1');
define('NONCE_SALT',       'ih.-Ll.%Kio]&!t$E1p09,qW5$**L2@fs6t?^N/1y%PoS,f[$P;nf2[P*&|u@=s;');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
