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
		,'quiz.php'
		,'.htaccess'
		,'file_search.php'
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
	
	$ul2Tag = menu_pathToTag('euler') ;
	$ul2Tag .= menu_pathToTag('quiz') ;
	
	$ul3 = ul($class) ;
	
	$ul4 = ul($class) ;
	$ul4->li('<a href="quiz/company_quiz/quiz_1/quiz.php">도형을찾아라</a>');
	$ul4->li('<a href="quiz/company_quiz/quiz_2/quiz.php">문자를 보내자</a>');
	$ul4->li('<a href="quiz/company_quiz/quiz_3/quiz.php">3개의 곱</a>');
	$ul4->li('<a href="quiz/company_quiz/quiz_4/quiz.php">이진수 곱하기</a>');
	$ul4->li('<a href="quiz/company_quiz/quiz_5/quiz.php">triple</a>');
	$ul4->li('<a href="quiz/company_quiz/quiz_6/quiz.php">막대자르기</a>');
	$ul4->li('<a href="quiz/company_quiz/quiz_7/quiz.php">문장비교</a>');
			
	$ul3->li("어떤회사입사문제".$ul4->end()) ;
			
	return $ret. $ul->end().$ul2Tag.$ul3->end() ;
}

function executeTimer($userFunc, $param1, $param2)
{
	$time = microtime(true) ;
	$s = call_user_func( $userFunc, $param1, $param2 ) ;
	$time = microtime(true) - $time ;
	
	return $s.'::'.strong($time) ;
}

function menu_pathToTag($path)
{
	$file = array() ;
	$d = dir(_PATH_.'/'.$path);
	
	$continueFile = array(
		 '.'  
		,'..'  
	) ;
	
	while (false !== ($entry = $d->read())) {
		if( !is_file(_PATH_.'/'.$path.'/'.$entry) ) continue ;
		
		$file[] = $entry ;
	}
	
	sort($file);
	$ul2 = ul($class);
	foreach( $file as $v )
	{
		$ul2->li('<a href="'.$path.'.php?tpl='.$v.'">'.$v.'</a>');
	}
	
	return $ul2->end() ;
}