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
<?php foreach( $_bookMenu as $k => $v ) : ?>
	<li><a href="?action=<?php echo $k; ?>"><?php echo $v?></a></li>
<?php endforeach ; ?>
</ol>

