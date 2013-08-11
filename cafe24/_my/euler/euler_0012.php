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



function problem12($max , $cnt=6)
{
	$sum = $n = array_sum(range(1,$max)) ;
	$arr = array(1) ;
	for( $i = 2 ; $n > 2 ; $i++ )
	{
		while($n%$i==0)
		{
			$n = $n / $i ;
			$arr[] = $i ;
		}		
	}
	$arr[] = $sum ;
	
	return count( $arr ) ;
	
	if( count( $arr ) < $cnt ) return count( $arr ) ;
	if( count( $arr ) < $cnt ) return count( $arr ) ;
	
	$endArr = array() ;
	if( count( $arr ) >= $cnt ){
	//	echo h1($max.'::'.$sum) ;
		$i_cnt = 0 ;
		for($i=0,$m=count($arr); $i < $m ; $i++ )
		{
	//		echo h3($i) ;
			for( $ii = $i + 1; $ii < $m ; $ii++ )
			{
				$i_cnt++ ;
				$k = $arr[$i]*$arr[$ii] ;
				$endArr[$k] = $k ;
			}
		}
	//	echo $i_cnt;
	//
	//		echo h1(count( $arr ).print_r($arr,true).'<br />'.count( $endArr ).print_r($endArr,true)) ;		
	} 
	
	if( count($endArr) < 500 ) return '' ; // count( $arr ).print_r($arr, true) ;
	return 'GOOD!! ['.$sum.']'.count( $endArr ).print_r($endArr, true).'<br />기준:'.print_r($arr, true) ;
}



$s = a('http://euler.synap.co.kr/prob_detail.php?id=12'
		,'project Euler@kr'
		,'_blank') ;
echo h1("최대 공약수".$s);
 
$ul = new ul ;

//for( $i = 2, $m = $i + 100  ; $i <= $m ; $i++ )
//{
//	echo h3($i.'::'.array_sum(range(1,$i))) ;
//}

//for($i = 8000 , $m = $i+4000 ; $i < $m ; $i++)
for($i = 12000 , $m = $i+1000 ; $i < $m ; $i++)
{
	$startTime = microtime(true) ;
	$tmp = h3($i.'::'.problem12( $i, 32 )) ;	
	$ul->li(  $tmp.( ' - execTime:'.(microtime(TRUE)-$startTime) ) ) ;
}
	
echo $ul->end(); 