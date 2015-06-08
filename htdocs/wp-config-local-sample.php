
<?php 
// Local server settings
 
// Local Database
define('DB_NAME', 'ctrack');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
 
// Overwrites the database to save keep edeting the DB
define('WP_HOME','http://192.168.1.11/CTRACK/website/htdocs/');
define('WP_SITEURL','http://192.168.1.11/CTRACK/website/htdocs/');
 
// Turn on debug for local environment
define('WP_DEBUG', false);
ini_set('display_errors','On');

// Increase PHP Memory to 256MB
define('WP_MEMORY_LIMIT', '512M');

// Multisite
define('DOMAIN_CURRENT_SITE', '192.168.1.11');
define('PATH_CURRENT_SITE', '/CTRACK/website/htdocs/');

?>