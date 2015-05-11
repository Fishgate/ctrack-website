<?php 
// Local server settings
 
// Local Database
define('DB_NAME', 'your');
define('DB_USER', 'settings');
define('DB_PASSWORD', 'go');
define('DB_HOST', 'here');
 
// Overwrites the database to save keep edeting the DB
define('WP_HOME',''); //e.g. http://192.168.1.11/CTRACK/website/htdocs/
define('WP_SITEURL','');
 
// Turn on debug for local environment
define('WP_DEBUG', true);

// Increase PHP Memory to 256MB
//define('WP_MEMORY_LIMIT', '256M');

// Multisite
define('DOMAIN_CURRENT_SITE', ''); //e.g. 192.168.1.11
define('PATH_CURRENT_SITE', ''); //e.g. CTRACK/website/htdocs/

?>