<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/../'.basename(__FILE__);
######################### 설정

ini_set( 'display_errors' , 'on' ) ;
ini_set( 'display_startup_errors' , 'on' ) ;
error_reporting(E_ERROR | E_WARNING | E_PARSE ) ; 
function myErrorHandler($errno, $errstr, $errfile, $errline)
{
    if (!(error_reporting() & $errno)) {
        // This error code is not included in error_reporting
        return;
    }
	
	 switch ($errno) {
    case E_USER_ERROR:
        echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
        echo "  Fatal error on line $errline in file $errfile";
        echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
        echo "Aborting...<br />\n";
        exit(1);
        break;

    case E_USER_WARNING:
        echo "<b>My WARNING</b> [$errno] $errstr<br />\n";
        break;

    case E_USER_NOTICE:
        echo "<b>My NOTICE</b> [$errno] $errstr<br />\n";
        break;

    default:
        echo "Unknown error type: [$errno] $errstr<br />\n";
        break;
    }
	
	errorDebug() ;
    /* Don't execute PHP internal error handler */
    return true;
}
set_error_handler("myErrorHandler");
#############################################


// 필요없음 주석
date_default_timezone_set('Asia/Seoul');

//session_cache_limiter('nocache, must_revalidate'); 
//session_set_cookie_params(0, "/");
//header("Pragma: no-cache"); 
//header("Expires: 0"); 


define( '_ERROR_' , true ) ;

header('P3P: CP="ALL CURa ADMa DEVa TAIa OUR BUS IND PHY ONL UNI PUR FIN COM NAV INT DEM CNT STA POL HEA PRE LOC OTC"');

header("Pragma: no-cache"); 
header("Expires: 0"); 



session_start();

/********* 수정이 필요함 ********/
function arrIconv( $a , $in , $out)
{
	if( is_array($a) )
	{
		foreach($a as $k => $v )
		{
			if( is_array($v) )
				$a[$k] = arrIconv( $v , $in , $out) ;
			else
				$a[$k] = iconv( $in , $out , $v ) ;
		}
	}else{
		$a = iconv($in,$out,$a);		
	}
	
	return $a ;
}

//$_GET = arrIconv( $_GET , 'UTF-8', 'EUC-KR') ;
//$_POST = arrIconv( $_POST , 'UTF-8', 'EUC-KR') ;


/********* 수정이 필요함 ********/


$__STARTTIME = getmicrotime() ;### for program running time

$phpPath = dirname(__FILE__) ;
// define( '_NOT_HTTP_' , substr($phpPath , 0 , strrpos($phpPath , '/') ) )  ;

define( '_NOT_HTTP_UPFILE_' , $phpPath.'/../UPFILE' )  ;
define( '_NOT_HTTP_SET_' , _NOT_HTTP_UPFILE_.'/../setting' )  ;
define( '_WEB_PATH_' , str_replace($_SERVER['DOCUMENT_ROOT'],'',$phpPath) )  ;


define( '_ROOT_',$_SERVER['DOCUMENT_ROOT'] ) ;
define( '_ADD_',$phpPath ) ;
define( '_PHP_',$phpPath.'/group_p' ) ;
define( '_CLASS_',$phpPath.'/class' ) ;
define( '_UPFILE_',$phpPath.'/upfile' ) ;
define( '_LIB_' ,$phpPath.'' ) ;
define( '_CSS_JS_' ,_WEB_PATH_.'/css_js' ) ;
define( '_SKIN_PATH_' ,$phpPath.'/skin' ) ;

define( '_VIEW_' ,$phpPath.'/view' ) ;
define( '_VIEW_P_' ,$phpPath.'/view_p' ) ;

define( '_MAIN_' , '/cpoll.php' ) ;


define( '_SKIN_',$phpPath.'/PHP.SKIN' ) ;
define( '_FUN_' ,_PHP_.'/function' ) ;
define( '_SESSION_',_UP_.'/session' ) ;
define( '_SKINTEMP_',_UP_.'/SKINTEMP' ) ;
define( '_TMP_',_UP_.'/tmpFile' ) ;
define( '_Log_',_UP_.'/logMessage' ) ;
define( '_LOGIN_PATH_' , _PHP_.'/member/login.php' ) ;
define( '_DATECHECK_' , _UP_.'/datecheck' ) ;


require_once _LIB_.'/function.f.php' ;
//require_once _LIB_.'/default.class.php' ;


// _ADD_ c:/apm_setup/htdocs/solution: c :\apm_setup\htdocs\solution\add
### program web folder (http path)  ###
$webPath = substr( str_replace( $_SERVER['DOCUMENT_ROOT'] , '' , str_replace('\\' , '/' ,_ADD_) ) , 1 );
if( !empty($webPath)){
$webPath = '/'.$webPath ;
}
define( '_HOST_' ,'http://'.$_SERVER['HTTP_HOST'] ) ;
define( '_WEBADD_' ,_HOST_.$webPath ) ;
define( '_WEB_' ,_HOST_.$webPath.'/PHP' ) ;
define( '_WEBUP_' ,_HOST_.$webPath.'/OWN777' ) ;
define( '_WEBSKIN_' ,_HOST_.$webPath.'/PHP.SKIN' ) ;
define( '_WEBTMP_' ,_WEBUP_.'/tmpFile' ) ;
define( '_WEBIMG_' ,_WEBADD_.'/image' ) ;
define( '_LOGIN_URL_' , _WEB_.'/member/login_ok.php' ) ;

### program const ###
define( '_EXPLODE_',  '@%@%' ) ;
define( '_CHAR_' , 'utf-8') ;
define( '_EXKEY_' , chr(27) ) ;

define( '_TODAY_' , date('Ymd') ) ;



################################
########### FUNCTION ###########
################################

/**
*
* see good of mirotime() 
* @return int (mirotime)
* 
* **/
function getmicrotime() 
{ 
    list($usec, $sec) = explode(" ", microtime()); 
    return ((float)$usec + (float)$sec); 
} 

/**
*
* include to is_file is true
* 
* @param string include file path
* @param [string message]
* 
* **/
function isFileInclude( $path , $msg = '' ) 
{ 
	GLOBAL $_USER_SESSION_KEY , $_USER_SESSION ;
	foreach( $_USER_SESSION_KEY as $k => $v )
	{
		${$v} = $_USER_SESSION[$k] ;	
	}
	
	if( is_file( $path ))
    {
    	include $path ;
    }else{
    	if( !_ERROR_ )
    	{
        	echo $msg ;
	    	echo 'not file ' ;
    	}else{
    		echo ':'. $path .':' ;	
    	}
    }
} 

function addLogSave( $sReporig ){
	//return ;
	$fp = fopen( _Log_.'/log.php' , 'a' ) ;
	fwrite( $fp, $sReporig) ;
	fclose( $fp ) ;
}
function addMysqlLogSave( $sReporig ){
	//return ;
	$sMode = 'a' ;
	if( @filesize(_Log_.'/mysql_log'.date('Ymd').'.php') > (1024*58)){
		$sMode = 'w' ;
	}
	$fp = fopen( _Log_.'/mysql_log'.date('Ymd').'.php' , $sMode ) ;
	fwrite( $fp, $sReporig) ;
	fclose( $fp ) ;
}

function addUpdateLogSave( $sReporig ){
	//return ;
	$sMode = 'a' ;
	$fp = fopen( _Log_.'/mysql_update_log'.date('Ymd').'.php' , $sMode ) ;
	chmod(_Log_.'/mysql_update_log'.date('Ymd').'.php' , 0777 ) ;
	fwrite( $fp, chr(13)."\n [".$_SERVER['REQUEST_URI'].'] : '.$sReporig) ;
	fclose( $fp ) ;
}


function addTestLogPrintSave( $aArr ){
	//return ;
	$sMode = 'a' ;
	if( filesize(_Log_.'/mysql_log.php') > (1024*50)){
		$sMode = 'w' ;
	}
	$fp = fopen( _Log_.'/test_log.php' , $sMode ) ;
	chmod(_Log_.'/test_log.php' , 0777 ) ;
	
	ob_start();
	printArray($aArr) ;
	$sLog = ob_get_contents();
	ob_end_clean();

	fwrite( $fp, $sLog) ;
	fclose( $fp ) ;
}
/**
*
* param answer is true 
* view history running time and memory size
* and now running time and save button and delete button print
* 
* @param bool
* 
* **/
function scriptTime( $print = false )
{
	$memony = memory_get_usage() ;
	$scriptTime = getmicrotime() - $GLOBALS['__STARTTIME'] ;
	if( $print )
	{
		$query = '' ;
		$num = strpos($_SERVER['REQUEST_URI'] , '?') ;
		if( $num !== false  )
		{
			$query = substr($_SERVER['REQUEST_URI'] , $num ) ;
			$query = str_replace('&' , '::' , $query) ;			
		}
		$pageName = str_replace('/', ',' , $_SERVER['PHP_SELF']) ;
		$files = _UP_.'/scripttime/'.$pageName ; //str_replace( '&' , '??' , $_SERVER['REQUEST_URI'] ) ;
		$pageName = urlencode( $pageName ) ;
		if(is_file($files ))
		{
			$fp = fopen( $files , 'r' ) ;
			$data = fread( $fp , filesize($files) ) ;
			fclose( $fp ) ;
		}
		
		echo '<pre>'.( $data ).'</pre>' ;
		

		echo $scriptTime .'sec memory: '.$memony .' ' ;
		echo 'history : ' ;
		echo '<A HREF="javascript:location.href=\''._WEBADD_.'/pageTime.php?pageName='.$pageName.'&amp;query='.$query.'&amp;scriptTime='.$scriptTime.'&amp;memory='.$memony.'\'">save</A> ' ;
		echo '<A HREF="javascript:location.href=\''._WEBADD_.'/pageTime.php?pageName='.$pageName.'&amp;del=on\'">delete</A> ' ;
	}else{
		echo '<!-- '.$scriptTime.'sec -->' ;
	}
}	

	
function DEFAULTTAG( $char = "UTF-8")
{
	static $nFrist = 1;
	if( $nFrist <= 1){
		echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<HTML><head> ' ;
		echo '<meta http-equiv="Content-Type" content="text/html; charset='.$char.'">' ;
		DEFAULTCSS() ;
		DEFAULTFUNCTIONJS() ;
		DEFAULTDATAJS() ;
		$nFrist++ ;
	}
}

function DEFAULTCSS()
{
	//echo '<link rel="stylesheet" type="text/css" href="'. _WEBADD_.'/style.css">' ;
}
function DEFAULTFUNCTIONJS()
{
	echo <<<JS
<SCRIPT LANGUAGE="JavaScript">
//var sWebIconPath = "$sWebImg/ext/" ;
</SCRIPT>
JS;
	//echo '<SCRIPT LANGUAGE="JavaScript" src="'._WEB_.'/js/function.js"></SCRIPT>' ;
}
function DEFAULTDATAJS()
{
	echo '<script type="text/javascript" src="/css_js/jquery.js"></script>' ;	
}



/**
* SESSION
* @return int user Level
* **/
function getUserLevel()
{
	return $_SERVER['DataMemory']->get('level') ;
}
function loginCheck($lv)
{
	if( $_SERVER['DataMemory']->get('level') >= $lv ){return true  ; }   
	else{ return false ;}
}


class DaumInsideScript{
	public function __destruct()
	{

	}
}
$DaumInsideScript = new DaumInsideScript() ;



?>