<?php
/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
Problem 6

1부터 10까지 자연수를 각각 제곱해 더하면 다음과 같습니다 (제곱의 합).

12 + 22 + ... + 102 = 385
1부터 10을 먼저 더한 다음에 그 결과를 제곱하면 다음과 같습니다 (합의 제곱).

(1 + 2 + ... + 10)2 = 552 = 3025
따라서 1부터 10까지 자연수에 대해 "합의 제곱"과 "제곱의 합" 의 차이는 3025 - 385 = 2640 이 됩니다.

그러면 1부터 100까지 자연수에 대해 "합의 제곱"과 "제곱의 합"의 차이는 얼마입니까?
 */


//@high_no highlight print
/*@high_no*/printLayout('Problem 6');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;

function numberSumPow( $start, $end ) 
{
	$ret = 0 ;
	for($i = $start; $i <= $end ; $i++ )
	{
		$ret += pow($i,2) ;
	}

	return $ret ;
}

function numberPowSum( $start, $end ) 
{
	$ret = 0 ;
	for($i = $start; $i <= $end ; $i++ )
	{
		$ret += $i ;
	}

	return pow($ret,2) ;
}


/* 말 그대로의 문제 */
?>
<?php //@highlight_end?>
<?php


echo ul()->
		li('executeTimer( "numberSumPow" , 1, 10 )'.executeTimer( "numberSumPow" , 1, 10 ) )->
		li('executeTimer( "numberPowSum" , 1, 10 )'.executeTimer( "numberPowSum" , 1, 10 ) )->
		li('(numberPowSum(1,10) - numberSumPow(1,10))'.(numberPowSum(1,10) - numberSumPow(1,10)) )->
		
		li('executeTimer( "numberSumPow" , 1, 100 )'.executeTimer( "numberSumPow" , 1, 100 ) )->
		li('executeTimer( "numberPowSum" , 1, 100 )'.executeTimer( "numberPowSum" , 1, 100 ) )->
		li('(numberPowSum(1,100) - numberSumPow(1,100))'.(numberPowSum(1,100) - numberSumPow(1,100)) )->
	end(); 
?>
