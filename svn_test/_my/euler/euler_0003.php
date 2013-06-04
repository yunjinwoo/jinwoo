<?php
/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
Problem 3 출제 일시 : 2012-01-03 19:11:35

어떤 수를 소수의 곱으로만 나타내는 것을 소인수분해라 하고, 이 소수들을 그 수의 소인수라고 합니다.
예를 들면 13195의 소인수는 5, 7, 13, 29 입니다.

600851475143의 소인수 중에서 가장 큰 수를 구하세요.
 */


//@high_no highlight print
/*@high_no*/printLayout('Problem 3');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;

function primes($max)
{
	$ol = new ol;
	$ol->li('2');
	$a = array(2,3);
	$tmp = 3 ;
	for( $i = 6 ; $i < $max ; $i+=2)
	{
		$primes = true ;
		foreach($a as $v){
			if( $i % $v === 0 ){
				$primes = false ;
			}
		}
			
		if( $primes ){
			$a[] = $i ;
			$ol->li($i.'::'.($i-$tmp)) ;
			$tmp = $i ;
		}
		
	}	
	return $ol->end() ;
}


function primes2($max)
{
	$ol = new ol;
	$ol->li('2');
	$a = array(2=>2,3=>3);
	$tmp = 3 ;
	for( $i = 6 ; $i < $max ; $i+=6)
	{
		$ul = new ul;
		$isAddLi = false ;
		$t = $i-1;
		$primes = false ;
		foreach($a as $v){
			if( $t % $v === 0 ){
				$primes = true ;
				break;
			}
			if($v>sqrt($t))
               break;
		}
			
		if( !$primes ){
			$a[$t] = $t ;
			$isAddLi = true ;
			$ul->li($i.'@@'.$t.'::'.($t-$tmp)) ;
			$tmp = $t ;
		}
		$t = $i+1;
		$primes = false ;
		
		foreach($a as $v){
			if( $t % $v === 0 ){
				$primes = true ;
				break;
			}
			if($v>sqrt($t))
               break;
		}
			
		if( !$primes ){
			$isAddLi = true ;
			$a[$t] = $t ;
			$ul->li($i.'@@'.$t.'::'.($t-$tmp)) ;
			$tmp = $t ;
		}
		
		if( $isAddLi ) 
			$ol->li($ul->end());
	}	
//	print_r($a);
	return $ol->end() ;
}
function problem3( $n )
{	
	$r = array() ;
	$i = 3 ;
	$n = $n % 2 === 0 ? $n/2:($n-1)/2;
	$ol = new ol();
	while( $n > $i ){
		$i+=2 ;
		if( $n % $i === 0 ){
			$r[$i] = $i ;
			$n = $n/$i ;
			$ol->li($i.'::'.$n);
			//$i = 1 ;
		}
		if( $i*2>$n )break ;
		//if($i++)
	}
	//echo $ol->end();
	print_r($r);
	return $ol->end() ;
		
		//else $i = ceil($i / 2) ;
}

$s = a('http://euler.synap.co.kr/prob_detail.php?id=3'
		,'project Euler@kr'
		,'_blank') ;
echo h1("소인수분해 ".$s);
echo ul()->
	//	li('Primes( 100 )'.  Primes( 10000 ))->
		li('problem3( 1000000 )'.  problem3( 1000001 ))->
	end(); // 600851475143    13195
// 13195의 소인수는 5, 7, 13, 29
$s = microtime(true) ;
$n = primes2( 100000 );
echo microtime(true) - $s ;
echo $n ;
?>
