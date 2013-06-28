<?php
/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';

/*
Problem 1 출제 일시 : 2012-01-03 19:11:35
10보다 작은 자연수 중에서 3 또는 5의 배수는 3, 5, 6, 9 이고, 이것을 모두 더하면 23입니다.

1000보다 작은 자연수 중에서 3 또는 5의 배수를 모두 더하면 얼마일까요?
 */


//@high_no highlight print
/*@high_no*/printLayout('Problem 1');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;

function problem1( $max )
{
	$a = array();
	for($i=0;$i<$max;$i+=3) $a[$i] = $i;
	for($i=0;$i<$max;$i+=5) $a[$i] = $i;
	
	return array_sum($a);
}

$s = a('http://euler.synap.co.kr/prob_detail.php?id=1'
		,'project Euler@kr'
		,'_blank') ;
echo h1("3 또는 5의 배수".$s);
echo ul()->
		li('10:'.problem1( 10 ))->
		li('1000:'.problem1( 1000 ))->
	end();
?>
