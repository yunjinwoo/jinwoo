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
	$a = array(3);
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
			$a[] = $i ;
			//echo $i."<br />" ;
			$ol->li($i.'::'.($i-$tmp)) ;
			$tmp = $i ;
		}
		
	}	
	return $ol->end() ;
}

// http://dplex.egloos.com/4302796 참고
function primesFind($max)
{
	echo h1($max);
	$aPrimes = array(2=>2,3=>3);
	switch($max)
	{
		case 1: case 2: case 3: case 5: 
			return $max;
		break;
		case 4:
			return 3;
		break ;
	}
	$tmp = 5 ;
	while( bcmod($max, 2) === "0" ) $max = bcdiv($max, 2 );
	while( bcmod($max, 3) === "0" ) $max = bcdiv($max, 3 );
	//echo h1($max.':::'.bcmod($max, 2).':::');
	for( $i = 6 ; $i < $max ; $i+=6)
	{
		$t1 = $i-1;
		$t2 = $i+1;
		$primes1 = false ;
		$primes2 = false ;
		foreach($aPrimes as $v){
			if( $t1 % $v === 0 ){
				$primes1 = true ;
			}
			if( $t2 % $v === 0 ){
				$primes2 = true ;
			}
			if( $primes1 || $primes2 )
				break ;
			if($v>sqrt($t1))
               break;			
			if($v>sqrt($t2))
               break;
		}
		if( !$primes1 ){
			$aPrimes[$t1] = $t1 ;
			while( bcmod($max, $t1) === "0" ){
				$max = bcdiv($max, $t1) ;
				$tmp = $t1 ;
				if( $max <= $t1 ) break ;
			}
		}
		if( !$primes2 ){
			$aPrimes[$t2] = $t2 ;
			while( bcmod($max, $t2) === "0" ){
				$max = bcdiv($max, $t2) ;
				$tmp = $t2 ;
				if( $max <= $t1 ) break ;
			}
		}
		
		if( $tmp >= $max ) break ;
	}	
	
	$isPrimes = false ;
	foreach($aPrimes as $v)
		if( $max % $v === 0 ){
			$isPrimes = true ;
			break;
		}
	if(!$isPrimes)
		return $max ;
	else
		return $tmp ;
}

// euler 댓글중에서 흉내
function prime_euler($max)
{
	while(bcmod($max, 2) == 0)
		$max = bcdiv($max, 2) ;
	$b = 2 ;
	for ( $i = 3; $i < $max; $i+=2)
	{
		while(bcmod($max, $i) == 0)
		{
			$max = bcdiv($max, $i) ; 
			$b = $i ;
			if ($max == 1) break;
		}       
	}
	return $i;
}

$s = a('http://euler.synap.co.kr/prob_detail.php?id=3'
		,'project Euler@kr'
		,'_blank') ;
echo h1("소인수분해 ".$s);

$s = microtime(true) ;
$a = primesFind(600851475143).'<br />';
$t1 = microtime(true) - $s ;

$s = microtime(true) ;
$b = prime_euler(600851475143).'<br />';
$t2 = microtime(true) - $s ;

echo ul()->
		li('Primes( 100 )'.executeTimer( "Primes" , 100 ) )->
		li('primesFind( 600851475143 )'.  $a.strong($t1))->
		li('prime_euler( 600851475143 )'.  $b.strong($t2))->
	end(); // 600851475143    13195
// 13195의 소인수는 5, 7, 13, 29

?>
