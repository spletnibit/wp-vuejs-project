<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
define('DB_NAME', 'spletnibit');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         'Gt%Q=[qcgckP{X|u&<`1#*@uA2j#MW<&kgwWIGaBj:[h0J*zTr{7WXAS`KW o-%I');
define('SECURE_AUTH_KEY',  '^Bq[Nd~/kv}[8`#.mmP:  k7Id<j,MLU?EFlh`iielGh|G4,DKgS.a$v&xY6k0>R');
define('LOGGED_IN_KEY',    'nB*zL31:w[hTT<m,D/Te X|7$Z/2H3 +2vS^nv1{=*4ez%wC)1A0rZe_xTioEX`Y');
define('NONCE_KEY',        'ynrfbgfGY(2<7QGLF/FSekJC:F[?0X1uE@B27,$A>uD;W#BZ/-TuqvC+U|z(lL2F');
define('AUTH_SALT',        'tt3y=VCLF?KI]E1>9V-t*z$jB[r_UEv7Wo#WuBLVW1-bdW4JIJi[JnEyF^EpSbjn');
define('SECURE_AUTH_SALT', 'Hl[1p~.sa1t=UJ@EpDymT@?IyfEBiQRo;nI8KhcpaXkvzy9lZ9(SAQ[DPzm9M.]n');
define('LOGGED_IN_SALT',   '&?ty6{},aOM==2`c B^Ki!@dD87u(GFJP-MPO8)Wvw*Go<E?kN-jj[4se&H/AKMv');
define('NONCE_SALT',       'U6qA?X(Aj%CA*SRO`6xrpA^y[v4*8k1j;IP,&<qCBhgSP.;KfVou!MKlv$#-bx/K');

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
define('WP_DEBUG',false);
define('FS_METHOD', 'direct');
define( 'ACF_TO_REST_API_REQUEST_VERSION', 3 );
/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
