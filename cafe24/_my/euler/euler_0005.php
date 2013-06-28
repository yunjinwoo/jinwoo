<?php
/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
Problem 5 출제 일시 : 2012-01-03 19:11:35

1 ~ 10 사이의 어떤 수로도 나누어 떨어지는 가장 작은 수는 2520입니다.

그러면 1 ~ 20 사이의 어떤 수로도 나누어 떨어지는 가장 작은 수는 얼마입니까?
 */


//@high_no highlight print
/*@high_no*/printLayout('Problem 5');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;

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

function primes($max)
{
	$a = array(2=>2,3=>3);
	$tmp = 3 ;
	for( $i = 5 ; $i < $max ; $i+=2)
	{
		$primes = true ;
		foreach($a as $v){
			if( $i % $v === 0 ){
				$primes = false ;
			}
		}
			
		if( $primes ){
			$a[$i] = $i ;
			$tmp = $i ;
		}
		
	}	
	return $a ;
}

function problem5($max)
{	
	$aPrimes = primes($max);
	$aPrimes[1] = 1 ;

	$sum = 1 ;
	foreach( $aPrimes as $v )
		$sum *= $v ;
	for( $i = 1 ; $i <= $max ; $i++ )
		if( $sum % $i !== 0 )
			foreach( $aPrimes as $v )
				if( $i % $v == 0 )
					$sum *= $v ;
	return $sum ;
}

echo ul()->
		li('executeTimer( "problem5" , 10 )'.executeTimer( "problem5" , 10 ) )->
		li('executeTimer( "problem5" , 20 )'.executeTimer( "problem5" , 20 ) )->
	end(); 
?>
