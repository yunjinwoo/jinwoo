<?php
/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
Problem 10 : 2012-01-03 19:11:35

10 이하의 소수를 모두 더하면 2 + 3 + 5 + 7 = 17 이 됩니다.

이백만(2,000,000) 이하 소수의 합은 얼마입니까?
 */

//@high_no highlight print
/*@high_no*/printLayout('Problem 10');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;



function problem10($max)
{
	$aPrimes = array( 2 ) ;
	$i = 3 ; 
	while( $i < $max ) 
	{
		$isPrimes = true ;
		$b = 1 ;
		foreach($aPrimes as $v){
			if( $v > $i/$b ){ // 여기가 핵심이다...
				break ;
			}else if( $i % $v == 0 ){
				$isPrimes = false ;
				break ;				
			}
			
			$b = $v ;
		}
		
		if( $isPrimes ) $aPrimes[] = $i ;
		if( $cnt-- < 0) break ;
		
		$i+=2 ;
	}
	
	return array_sum($aPrimes);
}



$s = a('http://euler.synap.co.kr/prob_detail.php?id=10'
		,'project Euler@kr'
		,'_blank') ;
echo h1("소수 알고리즘".$s);

echo ul()->
		li('executeTimer( "numberSumPow" , 1, 10 )'.executeTimer( "problem10" , 2000000 ) )->
	end(); 