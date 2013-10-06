<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/../dbconfig.php' ;
require_once _PATH_lib_.'/dbConnector.c.php';

define('_DB_HOST_', $mysql_host) ;
define('_DB_USER_', $mysql_user) ;
define('_DB_PASS_', $mysql_password) ;
define('_DB_NAME_', $mysql_db) ;


try {
	$_DB_CONNECTOR = new dbConnector('mysql:host='._DB_HOST_.';dbname='._DB_NAME_, _DB_USER_, _DB_PASS_) ;
} catch (PDOException $e) {
    console::error( 'Connection failed: ' . $e->getMessage() ) ;
}
