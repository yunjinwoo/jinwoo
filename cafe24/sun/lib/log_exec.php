<?php

require_once dirname(__FILE__).'/define.php';

$logIdx = $_SESSION['log_idx'] ;

if( !is_numeric($logIdx) )
{	
	$q = '
		INSERT INTO add_log ( `idx` , `session_id` , `ip` , `page` , `time` )
		VALUES (null, \''.session_id().'\' , \''.$_SERVER["REMOTE_ADDR"].'\' , \''.$_SERVER["REQUEST_URI"].'\' , \''.time().'\' ) ;
	' ;
	str_query($q);
	$_SESSION['log_idx'] = $logIdx = mysql_insert_id() ;
}

$page_time = time() ;
$stay_time = '' ;
if( is_numeric($_SESSION['log_time']) )
	$stay_time = $page_time - $_SESSION['log_time'] ;

$q = '
	INSERT INTO add_log_page ( `idx` , `log_idx` , `page` , `time` , `stay_time` )
	VALUES (null, \''.$logIdx.'\' , \''.$_SERVER["REQUEST_URI"].'\' , \''.$page_time.'\' , \''.$stay_time.'\' ) ;
' ;
str_query($q);
$page_idx = mysql_insert_id() ;
$_SESSION['log_time'] = $page_time ;
	
if( !empty($_SERVER["HTTP_REFERER"]) && (strpos( $_SERVER["HTTP_REFERER"] , $_SERVER["HTTP_HOST"] ) === false ) )
{
	$refer = parse_url($_SERVER["HTTP_REFERER"]);
	$q = '
		INSERT INTO add_log_refer ( `idx` , `log_idx` , `page_idx` , `domain` , `refer` , `time` )
		VALUES (null, \''.$logIdx.'\' , \''.$page_idx.'\' 
			, \''.$refer['host'].'\' , \''.$_SERVER["HTTP_REFERER"].'\' , \''.time().'\' ) ;
	' ;
	str_query($q);
}

