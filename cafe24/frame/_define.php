<?php
error_reporting(-1);//E_ALL
ini_set('display_errors', 'on');
ini_set('display_startup_errors', 'on');


date_default_timezone_set ('Asia/Seoul');

session_start();

define('_db_fix_', 'my_') ; // vatech_ db table prefix

define('_WEB_PATH_', '') ;
define('_PATH_', str_replace(DIRECTORY_SEPARATOR,'/',dirname(__FILE__))) ;
//define('_PATH_', dirname(__FILE__)) ;
define('_PATH_lib_', _PATH_.'/lib') ; // 각종 클래스
define('_PATH_module_', _PATH_.'/module') ; // 각종 디비연동 기능들
define('_PATH_data_', _PATH_.'/data') ; // 업로드 되는 폴더
define('_WEB_PATH_DATA_', _WEB_PATH_.'/data') ;

require_once _PATH_lib_.'/global.c.php';
require_once _PATH_lib_.'/firephp.c.php';
require_once _PATH_lib_.'/func.php';
load('config');


require_once _PATH_module_.'/sql.define.php';

function load($moduleName)
{
	$fn = _PATH_module_.'/'.$moduleName ;
	if(!is_dir($fn)) die( $fn.' 모듈없음' ) ;
	
	$require = $fn.'/_require.php';
	if( is_file($require) ) require_once $require;
	
	$f = dir(_PATH_module_.'/'.$moduleName) ;
	while (false !== ($e = $f->read())) {
		if( strpos( $e , '.php' ) !== false )
			require_once $fn.'/'.$e ;
	}
	$f->close();
}

function a_path($file)
{
	return _PATH_.'/jinwoo/p_html/'.$file.'.html' ;
}

function a_m_path($file)
{
	return _PATH_.'/jinwoo/p_html/mobile/'.$file.'.html' ;
}


$_header_tags = array() ;
function add_head_tag($d)
{
	global $_header_tags ;
	$_header_tags[] = $d ;
}

function print_head_tag()
{
	global $_header_tags ;
	foreach( $_header_tags as $tag )
		echo $tag ;
}

$_footer_tags = array() ;
function add_foot_tag($d)
{
	global $_footer_tags ;
	$_footer_tags[] = $d ;
}

function print_foot_tag()
{
	global $_footer_tags ;
	foreach( $_footer_tags as $tag )
		echo $tag ;
}

$printTitleArr = array() ;
function print_title($array_reverse = true)
{
	global $printTitleArr;
	if( $array_reverse )
		echo implode( ' | ', array_reverse($printTitleArr) );
	else
		echo implode( ' | ', $printTitleArr );
}
function addPrintTitle($title)
{
	global $printTitleArr;
	$printTitleArr[] = $title;
}
