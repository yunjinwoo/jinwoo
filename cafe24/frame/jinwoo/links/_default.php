<?php

require_once '../../_define.php';
load('adminMember') ;

addPrintTitle('VATECH Global');
if( !defined('_IS_MOBILE_') )
	addPrintTitle('PC-Admin');
else
	addPrintTitle('Mobile-Admin');



$Session = new SessionAdmin ;
$Admin = new AdminMember;

$aAdmin = $Admin->getRowId($Session->getUserid()) ;

if( count($aAdmin) <= 1 )
{
//	if( strpos($_SERVER['PHP_SELF'], 'login.php') === false )
//		h_location ('login.php') ;
}

/**
 * 관리자 설정
 */
define( '_LEVEL_1_' , $aAdmin['admin_owner'] & 1 ) ;
	
/**
 * 사이트관리
 */
define( '_LEVEL_2_' , $aAdmin['admin_owner'] & 2 ) ;
	
/**
 * 제품관리
 */
define( '_LEVEL_4_' , $aAdmin['admin_owner'] & 4 ) ;
	
/**
 * 미디어센터관리
 */
define( '_LEVEL_8_' , $aAdmin['admin_owner'] & 8 ) ;
	
/**
 * 회사정보관리
 */
define( '_LEVEL_16_' , $aAdmin['admin_owner'] & 16 ) ;
	
/**
 * 문의관리
 */
define( '_LEVEL_32_' , $aAdmin['admin_owner'] & 32 ) ;
	
/**
 * 모바일 - main 관리
 */
define( '_LEVEL_64_' , $aAdmin['admin_owner'] & 64 ) ;
	
/**
 * 모바일 - Product 관리
 */
define( '_LEVEL_128_' , $aAdmin['admin_owner'] & 128 ) ;
	
/**
 * 모바일 - 회사관리 관리
 */
define( '_LEVEL_256_' , $aAdmin['admin_owner'] & 256 ) ;
	
/**
 * 모바일 - 문의관리 관리
 */
define( '_LEVEL_512_' , $aAdmin['admin_owner'] & 512 ) ;
	
	

function layoutAdmin($contentsPath , $data )
{
	global $Session ;
	
	$lnb_index = A::number($data, 'lnb_index') ;
	
	
	/**
	 * 사용자 아이디
	 */
	define('_a_userid', $Session->getUserid() ) ;
	
	/**
	 * 사용자 이름
	 */
	define('_a_username', $Session->getUsername() ) ;
	
	
	/**
	 * int
	 * lnb a 링크 기준의 index 값
	 */
	define('_a_menuIdx', $lnb_index ) ;
	
	
	include '../include/head.php' ;
	include '../include/lnb.php' ;
	
	include $contentsPath ;
	
	include '../include/foot.php' ;
}

function layoutMoblieAdmin($contentsPath , $data )
{
	global $Session ;
	
	$lnb_index = A::number($data, 'lnb_index') ;
	
	/**
	 * 사용자 아이디
	 */
	define('_a_userid', $Session->getUserid() ) ;
	
	/**
	 * 사용자 이름
	 */
	define('_a_username', $Session->getUsername() ) ;
	
	
	/**
	 * int
	 * lnb a 링크 기준의 index 값
	 */
	define('_a_menuIdx', $lnb_index ) ;
	
	
	include '../include/head.php' ;
	include '../include/lnb_mobile.php' ;
	
	include $contentsPath ;
	
	include '../include/foot.php' ;
}

function layoutAdminContents($contentsPath , $data = array() )
{	
	
	include '../include/head_login.php' ;
	
	include $contentsPath ;
	
	include '../include/foot.php' ;
}


