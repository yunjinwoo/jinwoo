<?php


function newline()
{
	return "\n" ;	
}
function tab()
{
	return "\t" ;	
}
function h_location( $str )
{
	header('Location:'.$str) ;
}
function debug( $msg )
{
	console::$logCnt = 5 ;
	console::error($msg);
	die( '[console]' ) ;
}
function printPre($arr)
{
	$a = debug_backtrace() ;
	echo '<pre>LINE '.$a[0]['line'].' '.$a[0]['file'] .chr(13).print_r($arr,true).'</pre>';
}
function pre($arr)
{
	$a = debug_backtrace() ;
	echo '<pre>LINE '.$a[0]['line'].' '.$a[0]['file'] .chr(13).print_r($arr,true).'</pre>';
}

$__MSG__ = '' ;
function msg( $msg ) 
{
	global $__MSG__ ;
	$__MSG__ = $msg ;
}
function msg_print()
{
	global $__MSG__ ;
	if( !empty($__MSG__) )
		jsPrint('alert("'.$__MSG__.'");') ;
}
function jsPrint($s)
{
	echo '<script type="text/javascript">
		'.$s.'
</script>';	
}
function exitJs( $msg = '' , $href = '' )		
{
	if( !empty($msg) ) jsPrint ('alert("'.$msg.'")') ;
	if( !empty($href) ) jsPrint ('location.replace("'.$href.'")') ;
	
	exit ;
}


/**
 * 2013-08-02
 * 함수 모음
 */
class F
{
	/**
	 * 2013-08-02
	 * 변수가 날짜 형식의 문자열인지 아닌지 판단하는 함수
	 * @param string 2000-10-10
	 * @return true or false 
	 */
	static function isDate($day)
	{
		$day = preg_replace( '/[-.]/' , '', $day);
		if( strlen($day) != 8 ) return false ;
		if( !is_numeric($day) ) return false ;

		return true ;
	}
	/**
	 * 2013-08-21
	 * 변수가 날짜 형식의 문자열인지 아닌지 판단하는 함수
	 * @param string 2000-10-10 00:00:00
	 * @return true or false 
	 */
	static function isDatetime($day)
	{
		$day = preg_replace( '/[-.:\s]/' , '', $day);
		if( strlen($day) != 14 ) return false ;
		if( !is_numeric($day) ) return false ;

		return true ;
	}
	
	/**
	 * 2013-08-12 오류 함수 
	 * 변수가 양수가 아니면 설정값 반환 
	 * @param mixed
	 * @param int
	 * @return int
	 */
	static function number($var,$def = -1 ){
		return (!is_numeric($var) || $var <= 0 ) ? $def : $var ;
	}
	/**
	 * 2013-08-21 오류 함수 
	 * 변수가 날짜형식이 현재 날짜 반환
	 * @param mixed
	 * @return string Y-m-d H:i:s
	 */
	static function datetime($var,$format = 'Y-m-d H:i:s',$day = '0'){
		return F::isDatetime($var) ? $var : date($format, strtotime( $day.' day')) ;
	}
	
	/**
	 * 2013-08-21 오류 함수 
	 * 변수가 날짜형식이 현재 날짜 반환
	 * @param mixed
	 * @return string Y-m-d H:i:s
	 */
	static function date($var,$format = 'Y-m-d',$day = '0'){
		return F::isDate($var) ? $var : date($format, strtotime( $day.' day')) ;
	}
	/**
	 * 2013-09-06 유투브 형식의 url로 반환 
	 * 
	 * @param string   http://www.youtube.com/watch?v=GV4-hMYsR6k
	 * @return string //www.youtube.com/embed/XXXXX
	 */
	static function youtube($link){
		parse_str(parse_url($link, PHP_URL_QUERY), $a);
		$s = '';
		if( isset($a['v']))
			$s = '//www.youtube.com/embed/'.$a['v'];
		
		return $s;
	}
	
		
	/**
	 * 2013-08-21 오류 함수 
	 * 변수가 문자형식이 아니면 설정값 반환 
	 * @param mixed
	 * @return string
	 */
	static function str($var,$dep=''){
		return empty($var) ? $dep : $var ;
	}
	
	/**
	 * 2013-08-21 오류 함수 
	 * 변수가 Y,N 이 아니면 N 
	 * @param mixed
	 * @return string
	 */
	static function YN($var){
		return $var == 'Y' ? 'Y' : 'N' ;
	}
	
	/**
	 * 2013-08-21 오류 함수 
	 * 변수가 Y,N 이 아니면 N 
	 * @param mixed
	 * @return string
	 */
	static function mbsubstr($s,$start,$len,$endpix='...'){
		if( strlen( $s ) > $len )
			return mb_substr( $s, $start, $len ).$endpix ;
		else return $s ;
	}
	
	static function htmlChar($s){
		return htmlspecialchars($s);
	}
}

class A
{
	/**
	 * 2013-08-12 
	 * 변수가 숫자형식이 아니면 
	 * @param array 찾을 배열
	 * @param string 변수명
	 * @param int 기본값
	 * @return number
	 */
	static function number(&$arr,$k,$def=-1){
		if(!is_numeric($def)) $def = -1 ;
		
		if( isset($arr[$k]) && is_numeric($arr[$k]) ) return $arr[$k] ;
		else return $def ;
	}
	
	/**
	 * 2013-08-13 
	 * 변수가 문자형식이 아니면 
	 * @param string 
	 * @return string
	 */
	static function str(&$arr,$k,$def=''){		
		if( isset($arr[$k]) && !empty($arr[$k]) ) return $arr[$k] ;
		else return $def ;
	}

	static function htmlChar(&$arr){
		if( is_array($arr) )
		{		
			foreach( $arr as $k => $v )
			{
				if( is_array($v) )
					$arr[$k] = A::htmlChar($v);
				else
					$arr[$k] = htmlspecialchars($v);
			}

			return $arr ;
		}

		return array();
	}
}

class H
{
	/**
	 * 2013-08-13 
	 * 두 변수가 & 연산에 
	 * @param string 2000-10-10
	 * @return "" or checked="checked" 
	 */
	static function bitChecked($d,$v){
		if($d > 0 && $d & $v ) return 'checked="checked"' ;
		return '' ;
	}
	static function checked($d,$v){
		if($d == $v ) return 'checked="checked"' ;
		return '' ;
	}
	static function bitToOn($d,$v){
		if($d > 0 && $d & $v ) return 'on' ;
		return '' ;
	}
	static function selected($d,$v){
		if($d == $v) return 'selected="selected"' ;
		return '' ;
	}
}