<?php
require_once '_default.php' ;

$sTitle = getTitle() ;

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<title><?php echo $sTitle?></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<script type="text/javascript" src="/mybook/jquery.js"></script>
	<script type="text/javascript" src="/mybook/Validator.js"></script>
	<link rel="stylesheet" type="text/css" href="css.css"></link>
<head>
<body>

<h3><?php echo _TITLE_ ;?> </h3>

<ol class="menu">
<?php
	$index = 0 ;
	foreach( $_bookMenu as $sub_title => $a ) : 
	$index++; ?>
	<li><h3><?php echo $sub_title?></h3>
		<ol>
	<?php foreach( $a as $k => $v ) : ?>
			<li><a href="?action=<?php 
				echo str_pad($index,2,'0',STR_PAD_LEFT)
					.str_pad($k+1,2,'0',STR_PAD_LEFT); ?>"><?php echo $v?></a></li>
	<?php endforeach ; ?>
		</ol>
	</li>
<?php endforeach ; ?>
</ol>

