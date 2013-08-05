<?php

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
}