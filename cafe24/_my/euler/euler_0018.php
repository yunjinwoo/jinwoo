<?php

/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
Problem 18 : 2012-01-03 19:11:35

다음과 같이 삼각형 모양으로 숫자를 배열했습니다.

3
7 4
2 4 6
8 5 9 3

삼각형의 꼭대기부터 아래쪽으로 인접한 숫자를 찾아 내려가면서 합을 구하면, 위의 그림처럼 3 + 7 + 4 + 9 = 23 이 가장 큰 합을 갖는 경로가 됩니다.

다음 삼각형에서 합이 최대가 되는 경로를 찾아서 그 합을 구하세요.

75
95 64
17 47 82
18 35 87 10
20 04 82 47 65
19 01 23 75 03 34
88 02 77 73 07 63 67
99 65 04 28 06 16 70 92
41 41 26 56 83 40 80 70 33
41 48 72 33 47 32 37 16 94 29
53 71 44 65 25 43 91 52 97 51 14
70 11 33 28 77 73 17 78 39 68 17 57
91 71 52 38 17 14 91 43 58 50 27 29 48
63 66 04 68 89 53 67 30 73 16 69 87 40 31
04 62 98 27 23 09 70 98 73 93 38 53 60 04 23

참고: 여기서는 경로가 16384개밖에 안되기 때문에, 모든 경로의 합을 일일이 계산해서 답을 구하는 것이 가능합니다.
하지만 67번 문제에는 100층짜리 삼각형 배열이 나옵니다. 그런 경우에는 좀 더 현명한 풀이 방법을 찾아야겠지요. 

 * 
 * 
 ========
 아 꾸역꾸역 역순으로 풀었네 ㅠㅠㅠㅠㅠ
 *  */

//@high_no highlight print
/*@high_no*/printLayout('Problem 18');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;



$s = '75
95 64
17 47 82
18 35 87 10
20 04 82 47 65
19 01 23 75 03 34
88 02 77 73 07 63 67
99 65 04 28 06 16 70 92
41 41 26 56 83 40 80 70 33
41 48 72 33 47 32 37 16 94 29
53 71 44 65 25 43 91 52 97 51 14
70 11 33 28 77 73 17 78 39 68 17 57
91 71 52 38 17 14 91 43 58 50 27 29 48
63 66 04 68 89 53 67 30 73 16 69 87 40 31
04 62 98 27 23 09 70 98 73 93 38 53 60 04 23' ;

$arr = array();
foreach( explode("\n", $s) as $k => $v ){
	$arr[$k] = explode(' ', trim($v) );
}

function problem18_var1()
{
	global $arr;
	$sum = $arr[0][0];
	$index = $index_str = '0';
	$sum0 = $sum1 = 0;
	for( $i = 1, $m = count($arr) ; $i < $m ; $i++ ){
		$tmp1 = $sum + $arr[$i][$index];
		$tmp2 = $sum + $arr[$i][$index+1]; 
		
		if( $tmp1 >= $tmp2 ){
			$sum = $tmp1;
		}else{
			$index = $index + 1;
			$sum = $tmp2;
		}
		
		$index_str .= $index;
		
		// 처음모든것과 끝 모든것은 따로 구한다.
		$sum0 += $arr[$i][0];
		$sum1 += $arr[$i][count($arr[$i])-1];
	}
	
	return h3( $index_str ).h3( $sum .'[0-'.$sum0.'][e-'.$sum1.']') ;
}

function problem18_var2()
{
	global $arr;
	$sum_before = $arr[0][0];
	$sum_index = array();
	$sum_index[0][0] = $arr[0][0];
	for( $i = 1, $m = count($arr) - 1; $i < $m ; $i++ ){
		
		$sum_index[$i][0] = $sum_index[$i-1][0] + $arr[$i][0];
		$km = count($arr[$i]);
		for( $k = 1 ; $k < $km ; $k++ ){
			$sum_index[$i][$k] = $arr[$i][$k]
					//max($arr[$i+1][$k]
					//	, $arr[$i+1][$k-1])
					+
					max( isset($sum_index[$i-1][$k])?$sum_index[$i-1][$k]:0
						,isset($sum_index[$i-1][$k-1])?$sum_index[$i-1][$k-1]:0);
//			pre($i ,$k);
//			pre($sum_index[$i][$k],$arr[$i][$k]);
//			pre($sum_index);
		}
	}
	
	pre($sum_index);
	
	$max = 0 ;
	foreach( $sum_index[count($sum_index)-1] as $k => $v ){
		if( $max <= $v ){
			$max = $v;
		}
	}
	return $max ;
}


function problem18_var3()
{
	global $arr;
	
	$m = count($arr) - 1;
	$sum_index = array( $m => $arr[$m] );
	$sum_index[$m] = array_values($arr[$m]) ;
	for( $i = $m - 1 ; $i >= 0 ; $i-- ){
		foreach( $arr[$i] as $k => $v ){
			$sum_index[$i][$k] = $v + max( isset($sum_index[$i+1][$k])?$sum_index[$i+1][$k]:0
						,isset($sum_index[$i+1][$k+1])?$sum_index[$i+1][$k+1]:0);
			
		}
	
	}
	
	pre($sum_index);
	
	return $sum_index[0][0] ;
}

?>
<?php //@highlight_end?>
<?php

$s = a('http://euler.synap.co.kr/prob_detail.php?id=18'
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
		li('executeTimer( "problem18_var1" ) ['.executeTimer( "problem18_var1" ).']' )->
		li('executeTimer( "problem18_var2" ) ['.executeTimer( "problem18_var2" ).']' )->
		li('executeTimer( "problem18_var3" ) ['.executeTimer( "problem18_var3" ).']' )->
	end(); 
?>