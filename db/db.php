<?php
$hostname_localhost ="localhost";
$database_localhost ="esrieac_gps";
$username_localhost ="esrieac_accadius";
$password_localhost ="esriea.co.ke";

$localhost = mysql_connect($hostname_localhost,$username_localhost,$password_localhost)
or
trigger_error(mysql_error(),E_USER_ERROR);
?>