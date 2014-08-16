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


/**
 * 문제7과 다르게 isPrime 함수를 만들어 풀어보자
 * 
 * 따라만든 코드...
 * http://euler.synap.co.kr/forum_list.php?p=10&pg=4
 * 생각보다 느린거 같다.
 * 
 * 2012-10-10 16:30:58
 */
function isPrime($n){
	$onePrime = array(2,3,5,7);
	if( in_array($n, $onePrime) ){ return true ;}
	if( $n < 2 ){  return false; }
	if( $n % 2 == 0 ){  return false; }
	if( $n % 3 == 0 ){  return false; }
	if( $n % 5 == 0 ){  return false; }
	if( $n % 7 == 0 ){  return false; }
	
//	$b = floor($n / 2) ;
//	$b = $b % 2 == 0 ? $b - 1 : $b;
	
	$p=5; 
	while($p*$p<=$n){
		if($n%$p==0||$n%($p+2)==0){
			return false;
		}else{
			$p+=6;
		}
	}
	
//	for( $i = $n ; $i >= $b ; $i-=2 ){
//		if( $n / $i == 0 ){ return false; }		
//	}
	
	return true ; 
}
function problem10($max)
{
	$aPrimes = array( 2 ) ;
	$i = 3 ; 
	while( $i <= $max ) 
	{
		if(isPrime($i)){
			$aPrimes[] = $i ;
		}
		$i+=2 ;
	}
	
	return array_sum($aPrimes);
}

/*이전버전 */
function problem10_old($max) 
{ 
    $aPrimes = array( 2 ) ; 
    $i = 3 ;  
    while( $i < $max )  
    { 
        $isPrimes = true ; 
        $b = 1 ; 
        foreach($aPrimes as $v){ 
			// $v 소수 $i 3부터 2씩 올라가는 수 $v 이전 약수 
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


?>
<?php //@highlight_end?>
<?php

$s = a('http://euler.synap.co.kr/prob_detail.php?id=10' 
        ,'project Euler@kr' 
        ,'_blank') ; 
echo h1("소수 알고리즘".$s); 
echo ul()-> 
        li('executeTimer( "problem10" , 2000000 )'.executeTimer( "problem10" , 2000000 ) )-> 
        li('executeTimer( "problem10_old" , 2000000 )'.executeTimer( "problem10_old" , 2000000 ) )-> 
    end(); 
