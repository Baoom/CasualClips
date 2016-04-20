<?php
/**
 * Created by PhpStorm.
 * User: christian.norrman
 * Date: 2015-03-28
 * Time: 16:40
 */

/**
 * These are the database login details
 */

define("HOST", "kevinsportab.zz.mu");  // The host you want to connect to.
define("USER", "u613272669_kevin"); // The database username.
define("PASSWORD", "kevinbiggie"); // The database password.

define("DATABASE", "u613272669_datab"); // The database name.

define("CAN_REGISTER", "any");
define("DEFAULT_ROLE", "member");

define("SECURE", FALSE); // FOR DEVELOPMENT ONLY!!!!

//Set error reporting to true
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);
?>