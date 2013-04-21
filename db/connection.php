<?php
$hostname_localhost ="50.31.138.79";
$database_localhost ="george12_mars";
$username_localhost ="george12_sabwa";
$password_localhost ="accadius123";

/* / Database Constants
define("DB_SERVER", "50.31.138.79");
define("DB_USER", "george12_sabwa");
define("DB_PASS", "accadius123");
define("DB_NAME", "george12_sabwa");
*/
$localhost = mysql_connect($hostname_localhost,$username_localhost,$password_localhost)
or
trigger_error(mysql_error(),E_USER_ERROR);

 mysql_select_db($database_localhost,$localhost);
?>
