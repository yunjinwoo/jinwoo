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
			$ol->li($i.'::'.($i-$tmp)) ;
			$tmp = $i ;
		}
		
	}	
	return $ol->end() ;
}



function primesMaxFind($start, $max)
{
	$a = array(2,3,5);
	switch($max)
	{
		case 1: case 2: case 3: case 5: 
			return $max;
		break;
		case 4:
			return 3;
		break ;
	}
	
	for( $i = 7 ; $i < $max ; $i+=2)
	{
		$primes = true ;
		foreach($a as $v){
			if( $i % $v === 0 ){
				$primes = false ;
				break ;
			}
		}
			
		if( $primes ){
			$a[] = $i ;
		}
		
	}	
	return $ol->end() ;
}

function primesFind($max)
{
	/*
	 * 1. 넘어온 숫자의 최대의 인수는 / 2 한 값보다 작다
	 */
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
			$tmp = $t ;
		}
		
	}	
//	print_r($a);
	return $tmp ;
}

function primes2($max)
{
	$ol = new ol;
	$ol->li('2');
	$a = array(2=>2,3=>3,5=>5);
	$tmp = 0 ;
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
	$a = array(2=>2,3=>3,5=>5);
	$tmp = 0 ;
	$return = array();
	for( $i = 6 ; $i < $max ; $i+=6)
	{
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
			//if( $max/$t =)
			$max = $max/$t ;
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
			$tmp = $t ;
		}
		
		if( $isAddLi ) 
			$ol->li($ul->end());
	}	
//	print_r($a);
	return $ol->end() ;
}
function problem3_old( $n )
{	
	$a = array() ;
	$i = 2 ;
	$haf = $n / $i ;
	if( $n % $i === 0 )
		$a[2] = 2 ;
	$i = 3 ;
	while( $haf > $i )
	{
		if( $n % $i === 0 )
			$a[$i] = $i ;
		
		$i+=2 ;
	}
	
	if( count($a) < 1 )
		$a = array($n => $n);
	print_r($a);
	//echo $haf.'::'.$i ;
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
// 13195의 소인수는 5, 7, 13, 29
$s = microtime(true) ;
primes( 7000 );
$t1 = microtime(true) - $s ;
$s = microtime(true) ;
primes2( 7000 );
$t2 = microtime(true) - $s ;
echo '<br />@@';

echo "<br />";
echo $t1 ;
echo "<br />";
echo $t2 ;
?>
