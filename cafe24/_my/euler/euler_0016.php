<?php

/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
Problem 16 : 2012-01-03 19:11:35

2^15 = 32768 의 각 자리수를 더하면 3 + 2 + 7 + 6 + 8 = 26 입니다.

2^1000의 각 자리수를 모두 더하면 얼마입니까? */

//@high_no highlight print
/*@high_no*/printLayout('Problem 16');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;


function problem16($pow)
{
	$n = bcpow(2, $pow);
	$a = 0;
	for( $i=0,$l=strlen($n); $i < $l ; $i++){
		$a = bcadd($a, substr($n,$i,1));
	}
	return $a;
}


?>
<?php //@highlight_end?>
<?php

$s = a('http://euler.synap.co.kr/prob_detail.php?id=16'
		,'project Euler@kr'
		,'_blank') ;
 
echo $s;
$ul = new ul ;
// 99999 => 77031[351]
/*
 * 999999 ~ 899999 939497[507]:
 * 899999 ~ 699999 837799[525]:
 */
echo ul()->
		li('executeTimer( "problem16" , "15" ) ['.executeTimer( "problem16" , "15" ).']' )->
		li('executeTimer( "problem16" , "1000" ) ['.executeTimer( "problem16" , "1000" ).']' )->
	end(); 
?>