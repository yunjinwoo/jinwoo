<?php
require_once 'board.function.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$board_id = $_GET['board_id'] ;
if( empty($board_id) )
	$board_id = 'free' ;

$board_module_skin = 'basic' ;
$board_list_deco_style = array(
		'new' => ''
	,	'hot' => ''
	,	'comment' => ''
	,	'notice' => ''
) ;

/**
 * 게시판 실행!!!
 */


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> 보드 테스트 ( 경로 수정해야함 ) </title>
<link rel="stylesheet" type="text/css" media="all" href="/common/css/base.css" />
<link rel="stylesheet" type="text/css" media="all" href="/common/css/comm.css" />
<link rel="stylesheet" type="text/css" media="all" href="/common/css/layout.css" />
<link rel="stylesheet" type="text/css" media="all" href="/common/css/module.css" />
</head>
<body class="bg_sub">


<!-- wrapper -->
<div id="wrapper">

	<!-- container -->
	<div id="container">
		<!-- visual -->
		<div class="visual">
		</div>
		<hr />
		
		<!-- side -->
		<div id="side">
		</div>
		<!-- //side -->
		<hr />

		
		<!-- contents -->
		<div id="contents">
			<?php board_start( $board_id ) ;?>
		</div>
		<!-- //contents -->
	</div>
	<!-- //container -->
	<hr />

</div>
<!-- wrapper -->

</body>
</html>
