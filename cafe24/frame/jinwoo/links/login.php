<?php 
require_once './_default.php';

$admin_id = G::post('admin_id') ;
$admin_pw = G::post('admin_pw') ;

addPrintTitle('Login');

if( !empty($admin_id) && !empty($admin_pw))
{
	$Admin = new AdminMember;
	$row = $Admin->getRowId($admin_id) ;
	if( count($row) <= 1 ){
		msg(_MSG_LOGIN_ID_FAIL_) ;
	}elseif( $row['admin_pw'] == $admin_pw )
	{
		$Session = new SessionAdmin ;
		$Session->setLogin($admin_id, $row['admin_name']);
		h_location('index.php') ;
	}else{		
		msg(_MSG_LOGIN_PW_FAIL_) ;		
	}
}

layoutAdminContents( a_path('login') ) ;

