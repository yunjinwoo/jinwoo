<?php
/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
Problem 12 : 2012-01-03 19:11:35

1부터 n까지의 자연수를 차례로 더하여 구해진 값을 삼각수라고 합니다.
예를 들어 7번째 삼각수는 1 + 2 + 3 + 4 + 5 + 6 + 7 = 28이 됩니다.
이런 식으로 삼각수를 구해 나가면 다음과 같습니다.

1, 3, 6, 10, 15, 21, 28, 36, 45, 55, ...
이 삼각수들의 약수를 구해봅시다.

 1: 1
 3: 1, 3
 6: 1, 2, 3, 6
10: 1, 2, 5, 10
15: 1, 3, 5, 15
21: 1, 3, 7, 21
28: 1, 2, 4, 7, 14, 28
위에서 보듯이, 5개 이상의 약수를 갖는 첫번째 삼각수는 28입니다.

그러면 500개 이상의 약수를 갖는 가장 작은 삼각수는 얼마입니까?
 */

//@high_no highlight print
/*@high_no*/printLayout('Problem 12');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;



function problem12($cnt)
{
	$sum = $n = array_sum(range(1,$cnt)) ;
	$arr = array() ;
	for( $i = 2 ; $n > 2 ; $i++ )
	{
		while($n%$i==0)
		{
			$n = $n / $i ;
			$arr[] = $i ;
		}		
	}
	
	if( count( $arr ) < 11 ) return ;
	
	echo h1($cnt.'::'.$sum) ;
	echo count( $arr ) ;
	print_r($arr) ;
}



$s = a('http://euler.synap.co.kr/prob_detail.php?id=12'
		,'project Euler@kr'
		,'_blank') ;
echo h1("최대 공약수".$s);

for( $i = 10000 ; $i < 11000; $i++ )
	problem12($i) ;

echo ul()->
	//	li('executeTimer( "problem12" , "500" )'.executeTimer( "problem12" , "500" ) )->
	end(); 