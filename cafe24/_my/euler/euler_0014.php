<?php
//set_time_limit(3); 

/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
Problem 14 : 2012-01-03 19:11:35

양의 정수 n에 대하여, 다음과 같은 계산 과정을 반복하기로 합니다.

n → n / 2 (n이 짝수일 때)
n → 3 n + 1 (n이 홀수일 때)

13에 대하여 위의 규칙을 적용해보면 아래처럼 10번의 과정을 통해 1이 됩니다.

13 → 40 → 20 → 10 → 5 → 16 → 8 → 4 → 2 → 1
아직 증명은 되지 않았지만, 이런 과정을 거치면 어떤 수로 시작해도 마지막에는 1로 끝나리라 생각됩니다. 
(역주: 이것은 콜라츠 추측 Collatz Conjecture이라고 하며, 이런 수들을 우박수 hailstone sequence라 부르기도 합니다)

그러면, 백만(1,000,000) 이하의 수로 시작했을 때 1까지 도달하는데 가장 긴 과정을 거치는 숫자는 얼마입니까?

참고: 계산 과정 도중에는 숫자가 백만을 넘어가도 괜찮습니다.
 */

//@high_no highlight print
/*@high_no*/printLayout('Problem 14');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;


function hailstone($n){
	if( $n < 1 ){ return ''; }
	if( $n == 1 ){ return '1' ; }
	
	$log = array($n) ;
	while( $n != 1 ){
		if( $n % 2 == 0 ){
			$n = $n / 2 ;
		}else{
			$n = 3*$n + 1;
		}
		
		$log[] = $n;
	}
	return $log;
}


function hailstoneLog($n){
	$log = hailstone($n);
	return implode(' -> ' , $log ).' count : '.count($log);
}

function problem14($n)
{
	$maxCnt = 0;
	$maxNum = 0;
	$maxFor = 0 ;//$n - 100000;
	for( $i = $n ; $i >= $maxFor ; $i-- ){
		$cnt = count(hailstone($i));
		if( $cnt > $maxCnt){
			$maxCnt = $cnt ;
			$maxNum = $i ;
		}
	}
	return $maxNum.'['.$maxCnt.']';
}

function problem14_lite($max)
{
	//$maxWhile = 0 ;
	$maxCnt = 0;
	$maxNum = 0;
	$arr = array() ;//$n - 100000;
	for( $i = 3 ; $i <= $max ; $i++ ){
		$cnt = 1;
		$n = $i;
		while( $n != 1 ){
		//	if( $maxWhile++ > 1000 ){ break; }
			if( isset($arr[$n]) ){
				$cnt += $arr[$n] ;
				break;
			}
			
			if( $n % 2 == 0 ){
				$n = $n / 2 ;
			}else{
				$n = 3*$n + 1;
			}
			
			
			++$cnt;
		}
		
		$arr[$i] = $cnt;

		if( $cnt > $maxCnt){
			$maxCnt = $cnt ;
			$maxNum = $i ;
		}
	}
	
	//echo h2('count($arr)'.count($arr));
	return $maxNum.'['.$maxCnt.']';
}

?>
<?php //@highlight_end?>
<?php

$s = a('http://euler.synap.co.kr/prob_detail.php?id=14'
		,'project Euler@kr'
		,'_blank') ;
 
$ul = new ul ;
// 99999 => 77031[351]
/*
 * 999999 ~ 899999 939497[507]:
 * 899999 ~ 699999 837799[525]:
 */
echo ul()->
//		li('executeTimer( "problem14" , "999999" ) ['.executeTimer( "problem14" , "999999" ).']' )->
		li('executeTimer( "problem14" , "999999" ) [837799[525]::43.9191119671]')->
		li('executeTimer( "problem14_lite" , "999999" ) ['.executeTimer( "problem14_lite" , "1000000" ).']' )->
//		li('executeTimer( "problem14" , "199999" ) ['.executeTimer( "problem14" , "199999" ).']' )->
		li('executeTimer( "hailstoneLog" , "2" ) ['.executeTimer( "hailstoneLog" , "2" ).']' )->
		li('executeTimer( "hailstoneLog" , "4" ) ['.executeTimer( "hailstoneLog" , "4" ).']' )->
		li('executeTimer( "hailstoneLog" , "3" ) ['.executeTimer( "hailstoneLog" , "3" ).']' )->
		li('executeTimer( "hailstoneLog" , "5" ) ['.executeTimer( "hailstoneLog" , "5" ).']' )->
		li('executeTimer( "hailstoneLog" , "7" ) ['.executeTimer( "hailstoneLog" , "7" ).']' )->
		li('executeTimer( "hailstoneLog" , "9" ) ['.executeTimer( "hailstoneLog" , "9" ).']' )->
		li('executeTimer( "hailstoneLog" , "11" ) ['.executeTimer( "hailstoneLog" , "11" ).']' )->
		li('executeTimer( "hailstoneLog" , "13" ) ['.executeTimer( "hailstoneLog" , "13" ).']' )->
	end(); 
?>