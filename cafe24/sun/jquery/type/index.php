<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> / </title>


</head>

<body>

<!-- wrapper -->
<div id="wrapper">
<h1><?php echo $_GET['p']?></h1>
<ul>
	<li><a href="?p=A">A</a></li>
	<li><a href="?p=B">B</a></li>
	<li><a href="?p=test">test</a></li>
	<li><a href="?p=m">m</a></li>
</ul>
	<div id="container">

		<?php include $_GET['p'].'.html' ;?>

	</div>

</div>
<!-- //wrapper -->

</body>

</html>
