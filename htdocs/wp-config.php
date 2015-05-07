<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
if ( file_exists( dirname( __FILE__ ) . '/wp-config-local.php' ) ) {
  include( dirname( __FILE__ ) . '/wp-config-local.php' );
} else {
	define('DB_NAME', 'ctrack');

	/** MySQL database username */
	define('DB_USER', 'root');

	/** MySQL database password */
	define('DB_PASSWORD', '');

	/** MySQL hostname */
	define('DB_HOST', 'localhost');
	
	/**
	 * For developers: WordPress debugging mode.
	 *
	 * Change this to true to enable the display of notices during development.
	 * It is strongly recommended that plugin and theme developers use WP_DEBUG
	 * in their development environments.
	 */
	define('WP_DEBUG', false);
}

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
define('AUTH_KEY',         'w:|Q-[1|sA>y1}a_c(OwHL+/f`@hrpE^bQ(77J_2y]+Dr+s]2kR#lMbC.*]2+FMg');
define('SECURE_AUTH_KEY',  'zO;@zJb$h9~WOzQqkRTNuPw>6kuz4_YL:.ew$gYGs`n*jvCjv=^IS.n2(*%I,5;s');
define('LOGGED_IN_KEY',    'OJ.Kl{L0r^_902z*h<YjpE0d0EyEf4o0`Gw[Ns4|++D3hf^ou>@9H*HF|`I8+2u*');
define('NONCE_KEY',        'y+LwkGXgApnFJgOc[D-m@Hc|+ OQYmn)]>f.|) |c!K:s2SKFsCSsq64UG]EWY:c');
define('AUTH_SALT',        'p|:Is#Jv<0p3N^8%xl<=dpIWjAv#UynP 6u[`)(77JGHF0CXu=}`U5fV2<N@Me#`');
define('SECURE_AUTH_SALT', '_$7DbL`> =+z-4ikwVfC-T|/vT%+Yw.d_kinlw5,+lKxe#M#1n=By`s<Q?!ZqfUd');
define('LOGGED_IN_SALT',   '/(Xn-Vsubw-`j9vFX7&iI+6SM1N&#RU,PH~%4H!z)LwtPr*DkqqSy .dzc F@/R7');
define('NONCE_SALT',       '9-A)aL~}/z~Kfx5C5f`DpHP+>9_bAmdTNV)Jvnr/^E+NwaM~} 6R3|~@d*3}VCb+');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
