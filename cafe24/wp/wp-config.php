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
require_once $_SERVER['DOCUMENT_ROOT'].'/../'.basename(__FILE__);

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
define('AUTH_KEY',         '(%4$$H6BCw2?[%S.m%MNl!%O(VzB(a*%o;+5IxkV5%0th}+A6+Zp-#i4+NgEFb2^');
define('SECURE_AUTH_KEY',  'JPZqqz#cu#IgUe^sHDoAa+|$ks*C=k8E5iVv<{c=bA-|u1AczHDg>)yA1Eu$zY?q');
define('LOGGED_IN_KEY',    '<R%<3oyhgx+Aa>F1tWuV2GsfT;b#d5e2_t|v|z1-xqt;@Bd*sBx|=^9TAHDDK}<D');
define('NONCE_KEY',        '7G}rvitv!|DnHItv}z|A!,0u_EgzTj VKxM(g)uhL?o=bM@e#%}ES6t4ZB@wYEds');
define('AUTH_SALT',        '``bp}&GzVeW/@u;mw$JYW+8mmjcB?W5lfv>EKc(.If6-;C0]s6h0e2e)M~),U%eq');
define('SECURE_AUTH_SALT', 'RH+W?)i#[lB.B/! 4|CxlLu_p-)sUdUfF9FlGn<t_W?mQF:E:tg?|^S2?ZXbo#*|');
define('LOGGED_IN_SALT',   'U:XyS-#3}pzj<e8Q-8(zrvr&POMKbh`eM yqB}Q3nTncS>3$Y!>?vO&Sne=@cm0g');
define('NONCE_SALT',       '{o]*{Pn[+z0d6~|I?}&4,|eo>UD_^.LNrC8#NUI#L?x*g(dxi5?|pc Dqpo,5o[&');

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
define('WPLANG', 'ko_KR');

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
