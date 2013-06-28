<?php
error_reporting( E_ALL ) ;

define( '_TITLE_' , '프로그래밍 비타민' ) ;

$_bookMenu = array(
	 '진수변환하기 '
	,'부울대수'
	,'문자표현'
	,'숫자표현'
	,'수식표기법'
	,'스택'
	,'큐'
	,'연결리스트'
	,'트리'
	,'이진탐색트리'
	,'그래프'
	,'다익스트라 알고리즘'
	,'해시테이블'
	,'프로그래밍 언어'
	,'교환하기'
	,'조건에 따라 다른 일하기'
	,'수들의 규식성 찾기'
	,'하노이탑'
	,'프랙탈'
	,'정렬하기'
	,'탐색하기'
	,'인공지능 탐색'
	,'오류 검출하기'
	,'압축하기'
	,'암호문 만들기'
	,'튜링기계'
) ;



/***/
function get( $s )
{
	if( isset($_GET[$s]) )
		return trim($_GET[$s]);
	else
		return '' ;
}
function post( $s )
{
	if( isset($_POST[$s]) )
		return trim($_POST[$s]);
	else
		return '' ;
}

function getTitle()
{
	$sSubTitle = getSubTitle() ;
	if( empty($sSubTitle ) )
		return _TITLE_ ;
	return _TITLE_.' - '.$sSubTitle ;
}

function getSubTitle()
{
	GLOBAL $_bookMenu ;

	if( !isset( $_bookMenu[get('action')] ) )
		return '' ;

	return $_bookMenu[get('action')] ;
}

?>