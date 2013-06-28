<?php
/*css-transform-rotate
 */
define('_PATH_', str_replace(DIRECTORY_SEPARATOR,'/',dirname(__FILE__))) ;
//define('_PATH_', dirname(__FILE__)) ;
define('_INC_', _PATH_.'/inc') ;

require_once _INC_.'/func.php';
require_once _INC_.'/html.c.php';

require_once _INC_.'/firephp.c.php';
require_once _INC_.'/publicVar.c.php';
require_once _INC_.'/layout.c.php';

$lay = null ;
function printLayout( $title = '' )
{
	global $lay ;
	$a = array('title'=>$title) ;
	$lay = new Layout($a) ;
}

function getReadContents($p)
{
	$r = '' ;
	$fp = fopen( $p , 'r') ;
	while (($s = fgets($fp, 4096)) !== false) {
		if( strpos($s,'@highlight') !== false )
			break ;
		if( strpos($s,'@high_no') !== false )
			continue ;
		if( trim($s) == "" ) continue;
        $r = $r.$s;
    }
    fclose($fp);
	return $r ;
}

function quizMenu($class="")
{
	$d = dir(_PATH_);
	$continueFile = array(
		 '.'  
		,'..'  
		,'_default.php'  
		,'index.php'
		,'euler.php'
		,'myjop.php'
	) ;
	$link = array() ;
	while (false !== ($entry = $d->read())) {
		if( in_array($entry,$continueFile) ) continue ;
		if( !is_file(_PATH_.'/'.$entry) ) continue ;
		
		$link[] = $entry ;
	}
	$d->close();
	sort($link);
		
	$ret  = hr().h2("메뉴") ;
	
	$ul = ul($class);
	foreach( $link as $v )
	{
		$ul->li('<a href="'.$v.'">'.$v.'</a>');
	}
	
	$euler = array() ;
	$d = dir(_PATH_.'/euler');
	while (false !== ($entry = $d->read())) {
		if( in_array($entry,$continueFile) ) continue ;
		if( !is_file(_PATH_.'/euler/'.$entry) ) continue ;
		
		$euler[] = $entry ;
	}
	$ul2 = ul($class);
	foreach( $euler as $v )
	{
		$ul2->li('<a href="euler.php?tpl='.$v.'">'.$v.'</a>');
	}
		
	
	return $ret. $ul->end().$ul2->end() ;
}

function executeTimer($userFunc, $param1, $param2)
{
	$time = microtime(true) ;
	$s = call_user_func( $userFunc, $param1, $param2 ) ;
	$time = microtime(true) - $time ;
	
	return $s.'::'.strong($time) ;
}
