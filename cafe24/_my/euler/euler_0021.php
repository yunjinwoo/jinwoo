<?php

/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
Problem 21 : 2012-01-03 19:11:35

n의 약수들 중에서 자신을 제외한 것의 합을 d(n)으로 정의했을 때,
서로 다른 두 정수 a, b에 대하여 d(a) = b 이고 d(b) = a 이면 
a, b는 친화쌍이라 하고 a와 b를 각각 친화수(우애수)라고 합니다.

예를 들어 220의 약수는 자신을 제외하면 1, 2, 4, 5, 10, 11, 20, 22, 44, 55, 110 이므로 그 합은 d(220) = 284 입니다.
또 284의 약수는 자신을 제외하면 1, 2, 4, 71, 142 이므로 d(284) = 220 입니다.
따라서 220과 284는 친화쌍이 됩니다.

10000 이하의 친화수들을 모두 찾아서 그 합을 구하세요.
 */

//@high_no highlight print
/*@high_no*/printLayout('Problem 21');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;

$totalFor = 0 ;	

function problem21($n)
{
	global $totalFor;
	$list = array();
	for($i=2;$i<=$n;$i++){
		$totalFor++;
		$a = array_sum(getDivisor($i));
		$b = array_sum(getDivisor($a));
		if( $i == $b && $a != $b ){
			$list[$i] = $i;
		}
	}
	
	pre($totalFor);
	pre($list);
	
	return array_sum($list);
}
//31626

?>
<?php //@highlight_end?>
<?php

$s = a('http://euler.synap.co.kr/prob_detail.php?id=21'
		,'project Euler@kr'
		,'_blank') ;
 
echo $s;
$ul = new ul ;
echo ul()->
		li('executeTimer( "problem21" ) ['.executeTimer( "problem21" , 220).']' )->
		li('executeTimer( "problem21" ) ['.executeTimer( "problem21" , 10000).']' )->
	end(); 
?>