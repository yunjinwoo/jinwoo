<?php

/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
Problem 20 : 2012-01-03 19:11:35

n! 이라는 표기법은 n × (n − 1) × ... × 3 × 2 × 1을 뜻합니다.

예를 들자면 10! = 10 × 9 × ... × 3 × 2 × 1 = 3628800 이 되는데,
여기서 10!의 각 자리수를 더해 보면 3 + 6 + 2 + 8 + 8 + 0 + 0 = 27 입니다.

100! 의 자리수를 모두 더하면 얼마입니까?
 */

//@high_no highlight print
/*@high_no*/printLayout('Problem 20');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;


function problem20($n)
{
	if( !is_numeric($n) ){
		return 0;
	}
	
	$bigint = 1;
	for($i=$n;$i>0;$i--){
		$bigint = bcmul($i, $bigint);
	}
	
	$sum=0;
	for($i=0,$m=strlen($bigint);$i<$m;$i++){
		$sum += $bigint[$i];
	}
	
	return $bigint.'-'.$sum;
}


?>
<?php //@highlight_end?>
<?php

$s = a('http://euler.synap.co.kr/prob_detail.php?id=20'
		,'project Euler@kr'
		,'_blank') ;
 
echo $s;
$ul = new ul ;
echo ul()->
		li('executeTimer( "problem20" ) ['.executeTimer( "problem20" , 10).']' )->
		li('executeTimer( "problem20" ) ['.executeTimer( "problem20" , 100).']' )->
	end(); 
?>