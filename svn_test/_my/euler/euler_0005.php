<?php
/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
Problem 3 출제 일시 : 2012-01-03 19:11:35

어떤 수를 소수의 곱으로만 나타내는 것을 소인수분해라 하고, 이 소수들을 그 수의 소인수라고 합니다.
예를 들면 13195의 소인수는 5, 7, 13, 29 입니다.

600851475143의 소인수 중에서 가장 큰 수를 구하세요.
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
echo h1("소인수분해 ".$s);
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

10 6 5 7
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
