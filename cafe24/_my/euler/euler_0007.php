<?php
/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
Problem 7

소수를 크기 순으로 나열하면 2, 3, 5, 7, 11, 13, ... 과 같이 됩니다.

이 때 10,001번째의 소수를 구하세요.
 */


//@high_no highlight print
/*@high_no*/printLayout('Problem 7');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;

function problem7($cnt)
{
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
  

print_r( problem7(100) ) ;
echo ul()->
		li('executeTimer( "numberSumPow" , 1, 10 )'.executeTimer( "problem7" , 100 ) )->
	end(); 
?>

function p007_in(n){
	if (n <= 2) {
		alert(n);
		return;
	}

	var cnt = 1;

	var prime = new Array();
	prime[0] = 2;
	var t = 3;
	while (cnt < n){
		var check = true;
		for(var i = 0;	i < cnt;	i++) {
			if(prime[i]>t/prime[i-1])
				break; 
			else if(t%prime[i] == 0) {
				check = false;
				break;
			}
		}
		if (check)
			prime[cnt++] = t;
		t += 2;
	}

	alert(prime[n-1]);
}