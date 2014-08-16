<?php
/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
Problem 2 출제 일시 : 2012-01-03 19:11:35

피보나치 수열의 각 항은 바로 앞의 항 두 개를 더한 것이 됩니다. 1과 2로 시작하는 경우 이 수열은 아래와 같습니다.

    1, 2, 3, 5, 8, 13, 21, 34, 55, 89, ... 

짝수이면서 4백만 이하인 모든 항을 더하면 얼마가 됩니까?
 */


//@high_no highlight print
/*@high_no*/printLayout('Problem 2');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;

//정석인듯 보이는 피보나치
//제귀라 부하가 심하다...
//  27 이때쯤부터... // li(''. fibo( 10 ))->
function fibo($n)
{
	return ($n <= 2) ? $n : (fibo($n - 1) + fibo($n - 2));
}



function problem2( $m )
{	
	return problem2_quiz(0,1,$m,$sum+$t);
}

// 재귀
function problem2_quiz( $a,$b,$m,$sum=0 )
{	
	$t = $a+$b ;
	if( $t > $m )
		return $sum ;
	else if( $t % 2 === 0 )
		return problem2_quiz($b,$t,$m,$sum+$t);
	else
		return problem2_quiz($b,$t,$m,$sum);
}

// 해답
function problem2_quiz_end( $m )
{	
	
	$a = 0 ; 
	$b = 1 ;
	$t = 0 ;
	$sum = 0 ;
	while( $t = $a+$b )
	{
		if( $t > $m ) break ;
		
		$a = $b ;
		$b = $t ;
		
		if($t%2===0) $sum += $t;
	}
	return $sum;
}


// 인수 보다 작은 피보나치 수열 출력 
function problem2_test( $m )
{	
	$a = 0 ; 
	$b = 1 ;
	$t = 0 ;
	$ol = new ol() ;
	while( $t = $a+$b )
	{
		if( $t > $m ) break ;
		
		$a = $b ;
		$b = $t ;
		
		$s = $t ;
		if($t%2===0) $s = '<strong>'.$s.'</strong>';
		$ol->li($s);
	}
	return $ol->end();
}


?>
<?php //@highlight_end?>
<?php
$s = a('http://euler.synap.co.kr/prob_detail.php?id=2'
		,'project Euler@kr'
		,'_blank') ;
echo h1("피보나치 수열 ".$s);
echo ul()->
		li('problem2( 4000000 ):'.  problem2( 4000000 ))->
		li('problem2_quiz_end( 4000000 ):'.  problem2_quiz_end( 4000000 ))->
		li(''.  problem2_test( 4000000 ))->
	end();

?>
