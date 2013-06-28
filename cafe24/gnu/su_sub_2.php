<?php
include_once("./_common.php");

define('_HTML_TYPE_' , true ) ;
include $g4['path'].'/bbs/_head.php' ;



if( !empty($_GET['html']) )
{
	$sub = '../html/'.$_GET['html'].'.html' ;
	if( file_exists( $sub )){ include  $sub ; }
	else{ echo ' 잘못된 주소입니다. ' ;}
	
}

include $g4['path'].'/bbs/_tail.php' ;
?>
