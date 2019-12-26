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
define('DB_NAME', 'tutorial_test');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'secret');

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
define('AUTH_KEY',         'L$*Qu+}N]/E/2iJ##u3Y@`-76 Z$]eLL/uqRJ`/t:+bf)xjbWNNZLY*+[yjsVU&-');
define('SECURE_AUTH_KEY',  'vYvTR/o5DsNlW<o @I/ w2[6YB2z:2u(fFSj*90U/Ub];BLs+IKVGtY~@R.ON7R7');
define('LOGGED_IN_KEY',    'h5A[`@I#+k?@j/z*[PcOVVHWz+f$.A<MhZ;>T,6KwgK1qP[!FEqZ9?ZHkU#Yuqe(');
define('NONCE_KEY',        '*wB3uHS:)9Mn;;YS@LmikYaS]!e[TqZ0*urS]Y1Bc<WaZ_OjzU9:~ZKK7sTgDs+>');
define('AUTH_SALT',        'S3/_VqLB@*`IhS9f+8y[q{!fqD@2(DW6xj_XTSHIIBp2u)XV_ATir%_Y?vBP;*&(');
define('SECURE_AUTH_SALT', '=%(O.L9GoG?>VGrAz`NyaM{+~U<l3uPJ087tw9|%dnZbnX=jGNZ`QYePYqv8?B!s');
define('LOGGED_IN_SALT',   '7?~QY?ZabLs;u`PUr|1F77=RKW+IrQL9ZLEUEj%<X0~^U?C&2oz`3UxJ|&F/`+&D');
define('NONCE_SALT',       'e20FbT:dBp>q-gQ$BO`}CL%Y|uVA!Pc1n;6jC?R+oxw 6$LFkbXfowg3QW)gN}>A');

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
