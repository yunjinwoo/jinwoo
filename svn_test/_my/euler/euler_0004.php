<?php
/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*Problem 4 출제 일시 : 2012-01-03 19:11:35
 * 
앞에서부터 읽을 때나 뒤에서부터 읽을 때나 모양이 같은 수를 대칭수(palindrome)라고 부릅니다.

두 자리 수를 곱해 만들 수 있는 대칭수 중 가장 큰 수는 9009 (= 91 × 99) 입니다.

세 자리 수를 곱해 만들 수 있는 가장 큰 대칭수는 얼마입니까?
 * 
 */

//@high_no highlight print
/*@high_no*/printLayout('Problem 4');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;


function problem4( $num1 , $num2 )
{	
	for( $n1 = $num1, $l = strlen($n1); strlen($n1) == $l ; $n1-- )
	{
		for( $n2 = $num2 , $j = strlen($num2); strlen($n2) == $j ; $n2-- )
		{
			$t = $n1*$n2 ;
			echo ($t == strrev($t)?"true@":"false@").$t.'::'.$n1.'::'.$n2.hr() ;
			if( $t == strrev($t) ) break 2;
		}
	}
	
	$dep = $n2 ;
	for( $n1 = $num1; $dep < $n1 ; $n1-- )
	{
		for( $n2 = $num2 ; $dep < $n2 ; $n2-- )
		{
			$t = $n1*$n2 ;
			echo ($t == strrev($t)?"true@":"false@").$t.'::'.$n1.'::'.$n2.hr() ;
			if( $t == strrev($t) ) break 2;
		}
	}
	return $t.'::'.$n1.'::'.$n2 ;
}

$s = a('http://euler.synap.co.kr/prob_detail.php?id=3'
		,'project Euler@kr'
		,'_blank') ;
echo h1("대칭수 ".$s);


$s = microtime(true) ;
$a = problem4(999,999).'<br />';
$t1 = microtime(true) - $s ;
echo ul()->
		li('problem4( 999,999 )'.$a.strong($t1))->
	end(); 

?>
