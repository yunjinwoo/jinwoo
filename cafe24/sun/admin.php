<?php

header("Content-Type: text/html; charset=UTF-8");

require_once 'lib/define.php' ;
require_once 'admin/login.c.php' ;

define( '_USERID_' , 'admin' ) ;
define( '_PASSWD_' , 'adminpw' ) ;



$Login = new Login() ;
$Login->loginExec();

if( !$Login->isUser() )
{
	require_once 'admin/login_form.php' ;
	exit ;
}

if( G::server('QUERY_STRING') == 'logout' )
{
	$Login->logout() ;
	JSPrint("location.href='/inc/admin.php';");
	exit ;
}


require_once 'board/board.function.php';
require_once 'admin/head.php' ;

$UseingSession	= UseingSession::create() ;
$UseingSession->name = '관리자' ;
$UseingSession->level = '9' ;
$UseingSession->userid = _USERID_ ;

$board_id = G::get('board_id');
$board_admin = G::get('board_admin');
if( !empty($board_id) )
	board_start( $board_id ) ;
else if($board_admin=='form')
	require_once 'board/admin.php' ;
else
	require_once 'admin/page_view.php' ;
	



/* // refer domain 처리용
	$q = '	SELECT  `idx` , `log_idx` , `page_idx` , `domain` , `refer` , `time` FROM add_log_refer ' ;
	$r = str_query($q);
	while($a = fetch_assoc($r))
	{
		$refer = parse_url($a['refer']) ;
		$q = '
			UPDATE add_log_refer SET domain = \''.$refer['host'].'\'
			WHERE idx = '.$a['idx'] ;
		//echo $q.'<br />';
		str_query($q);
	}
*/