<?php
	$_ENV = parse_ini_file('.env');

    //Configuration of mysql database for backend processing
	$mysql_host=$_ENV["HOST"];
	$mysql_user=$_ENV['USERNAME'];
	$mysql_pass=$_ENV['PASSWORD'];
	$mysql_db=$_ENV['DATABASE'];
	$mysql_ssl=$_ENV['MYSQL_ATTR_SSL_CA'];
?>