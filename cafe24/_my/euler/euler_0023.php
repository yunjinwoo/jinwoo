<?php

/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
Problem 23 : 2012-01-03 19:11:35

자신을 제외한 약수(진약수)를 모두 더하면 자기 자신이 되는 수를 완전수라고 합니다.
예를 들어 28은 1 + 2 + 4 + 7 + 14 = 28 이므로 완전수입니다.
또, 진약수의 합이 자신보다 작으면 부족수, 자신보다 클 때는 초과수라고 합니다.

12는 1 + 2 + 3 + 4 + 6 = 16 > 12 로서 초과수 중에서는 가장 작습니다.
따라서 초과수 두 개의 합으로 나타낼 수 있는 수 중 가장 작은 수는 24 (= 12 + 12) 입니다.

해석학적인 방법을 사용하면, 28123을 넘는 모든 정수는 두 초과수의 합으로 표현 가능함을 보일 수가 있습니다.
두 초과수의 합으로 나타낼 수 없는 가장 큰 수는 실제로는 이 한계값보다 작지만, 해석학적인 방법으로는 더 이상 이 한계값을 낮출 수 없다고 합니다.

그렇다면, 초과수 두 개의 합으로 나타낼 수 없는 모든 양의 정수의 합은 얼마입니까?
 */

//@high_no highlight print
/*@high_no*/printLayout('Problem 23');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;


function problem23()
{
	$max = 3000;
	$arr = range(1,$max-1);
	$divArr = array(); 
	$sum = array_sum($arr);
	pre($sum);
	foreach($arr as $k => $v ){
		$a = getSumDivisor($v);
		if( $a > $v ){ 
			$divArr[$v] = $v;
			foreach( $divArr as $kk => $vv ){
				if( $vv+$v < $max ){
					unset($arr[$vv+$v-1]);
				}
			}
		}
	}
	
//	pre($sum);
//	pre(count($divArr));
//	pre($divArr);
//	pre($arr);
	
	return array_sum($arr);
}

pre(getSumDivisor(196));
function problem23_ver1()
{
	$max = 28123;
	$arr = range(1,$max-1);
	$num = array();
	$divArr = array(); 
	$sum = 0;
	foreach($arr as $k => $v ){
		if( getSumDivisor($v) > $v ){ 
			$divArr[] = $v;
			foreach( $divArr as $kk => $vv ){
				if( $vv+$v < $max ){
					$num[$vv+$v] = false;
				}
			}
		}
		
		if( !isset($num[$v]) ){
			$sum += $v;
		}
	}

//	pre($sum);
	pre(count($divArr));
	pre($divArr);
//	pre($arr);
	
	return $sum;
}
//31626

?>
<?php //@highlight_end?>
<?php

$s = a('http://euler.synap.co.kr/prob_detail.php?id=23'
		,'project Euler@kr'
		,'_blank') ;
 
echo $s;
$ul = new ul ;
echo ul()->
		//li('executeTimer( "problem23" ) ['.executeTimer( "problem23" ).']' )->
		li('executeTimer( "problem23_ver1" ) ['.executeTimer( "problem23_ver1" ).']' )->
	end(); 
?>