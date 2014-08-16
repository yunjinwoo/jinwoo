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

/**
1   1 * 1  -- 제외
2	2 * 1  -- 제외
3	3 * 1  -- 제외
4   2 * 2
5   5 * 1  -- 제외
6   2 * 3  -- 제외
7   7 * 1
8   2 * 4  -- 제외
9   3 * 3 
10	2 * 5

(2*5 3*3 7 2*2) 
 
 2 3 5 7 2 2 3 => 2520
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


/**
 * 나누어 떨어지는 최소 값은
 * 각 소수의 곱 * 소수의 약수값 
 * 
 * 1. 소수를 구하고
 * 2. 소수를 곱한후
 * 3. $i 로 나눠지는 값들중 소수로도 나눠지는 값인 경우 나눠진 소수를 곱해서
 * 구한다.
 * **/ 
function problem5($max)
{	
	$aPrimes = primes($max);
	$sum = 1 ;
	foreach( $aPrimes as $v )
		$sum *= $v ;
	echo h2($max.':::'.$sum);
	$ul = new ul();
	for( $i = 1 ; $i <= $max ; $i++ ){
		if( $sum % $i !== 0 ){
			foreach( $aPrimes as $v ){				
				if( $i % $v == 0 ){
					$ul->li($sum.'::'.$i.'::'.$v);
					$sum *= $v ;
				}
			}
		}			
	}
	echo $ul->end();
	return $sum ;
}


?>
<?php //@highlight_end?>
<?php

$s = a('http://euler.synap.co.kr/prob_detail.php?id=5'
		,'project Euler@kr'
		,'_blank') ;
echo h1("1 ~ 20 사이의 어떤 수로도 나누어 떨어지는 가장 작은 수는 얼마입니까? ".$s);

echo ul()->
		li('executeTimer( "problem5" , 10 )'.executeTimer( "problem5" , 10 ) )->
		li('executeTimer( "problem5" , 20 )'.executeTimer( "problem5" , 20 ) )->
	end(); 
?>
