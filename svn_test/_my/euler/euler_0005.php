<?php
/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
Problem 5 출제 일시 : 2012-01-03 19:11:35

1 ~ 10 사이의 어떤 수로도 나누어 떨어지는 가장 작은 수는 2520입니다.

그러면 1 ~ 20 사이의 어떤 수로도 나누어 떨어지는 가장 작은 수는 얼마입니까?
 */


//@high_no highlight print
/*@high_no*/printLayout('Problem 4');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;

function problem3( $n )
{	
}

$s = a('http://euler.synap.co.kr/prob_detail.php?id=3'
		,'project Euler@kr'
		,'_blank') ;
echo h1("1 ~ 20 사이의 어떤 수로도 나누어 떨어지는 가장 작은 수는 얼마입니까? ".$s);
echo ul()->
		//li('Primes( 1000 )'. )->
		//li('problem3_old( 13195 )'.  problem3_old( 132145 ))->
		//li('problem3( 13195 )'.  problem3( 13195 ))->
	end(); // 600851475143    13195
/**
1   1 * 1
2   2 * 1 
3   3 * 1
4   2 * 2
5   5 * 1
6   2 * 3
7   7 * 1
8   2 * 4
9   3 * 3 
10	2 * 5

(2*5 3*3 7 2*2)
*/
$s = microtime(true) ;
echo h1(10*7*4);
$t1 = microtime(true) - $s ;
$s = microtime(true) ;
$t2 = microtime(true) - $s ;
echo '<br />@@';

echo "<br />";
echo $t1 ;
echo "<br />";
echo $t2 ;
?>
