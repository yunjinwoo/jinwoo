<?php

/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
Problem 19 : 2012-01-03 19:11:35

다음은 달력에 관한 몇 가지 일반적인 정보입니다 (필요한 경우 좀 더 연구를 해 보셔도 좋습니다).

1900년 1월 1일은 월요일이다.
4월, 6월, 9월, 11월은 30일까지 있고, 1월, 3월, 5월, 7월, 8월, 10월, 12월은 31일까지 있다.
2월은 28일이지만, 윤년에는 29일까지 있다.
윤년은 연도를 4로 나누어 떨어지는 해를 말한다. 하지만 400으로 나누어 떨어지지 않는 매 100년째는 윤년이 아니며, 400으로 나누어 떨어지면 윤년이다
20세기 (1901년 1월 1일 ~ 2000년 12월 31일) 에서, 매월 1일이 일요일인 경우는 총 몇 번입니까? 

var1 윤년이 아닌 년도를 빼서 구할수있는데까지 구하고 2로 찍어서 더했더니 정답이네;;
1
3
1
2
1
1
2
2
2
3
1
2
1
1
3
2
2
1
1
 */

//@high_no highlight print
/*@high_no*/printLayout('Problem 19');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;

//php 는 strtotime('1901-12-15') 부터 제대로 읽어 올수있다.
//echo "<br />".date('w', strtotime('1901-12-15')); - 0
date_default_timezone_set ('Asia/Seoul');

echo "<br />".date('w', strtotime('1903-01-01'));
echo "<br />".date('w', strtotime('1902-01-01')); 

function problem19_var1($week='')
{
	if( !is_numeric($week) ){
		$week = 0 ;
	}
	
	$yy = 2000;
	$mm = 12;
	$cnt = array();
	$cnt2 = array();
	for( $i = 1200 ; $i >= 1 ; $i-- ){
		$mm = str_pad($mm, 2, '0', STR_PAD_LEFT);
		if( date('w', strtotime($yy.'-'.$mm.'-01')) == $week ){
			$cnt[$yy.'-'.$mm.'-01'] = $week;
			if( $yy % 4 != 0 ){
				$cnt2[$yy][$mm] = $yy.'-'.$mm.'-01';
			}
			
		}
		
		if( --$mm == 0 ){
			$mm = 12;
			$yy -= 1;
		}
	}
	pre($cnt);
	//pre($cnt2);
	
	return count($cnt);
}

/*
2014-08-01 10:00:39
 Halka 
 
#Python
#직접 계산 코드, 유일한 100년 단위인 2000년은 400으로 나눠 떨어지므로 4년 단위 계산만 하게함
#1900년 1월 1일이 월요일이고, 1900년은 윤년이 아닌 것으로 dow=2(화요일)로 시작

def dz(y,m):
  D=[31,28,31,30,31,30,31,31,30,31,30,31]
  if y%4==0:D[1]=29
  return D[m]

dow=2;c=0
for y in range(1901, 2001):
  for m in range(12):
    dow+=dz(y,m);dow%=7
    if dow==0:c+=1
print c
 
 * 따라하기...
 **/

function day($y,$m){
	$day = array(
		 31,28,31,30,31,30
		,31,31,30,31,30,31
	);
	if($y%4==0){$day[1]=29;}
	return $day[$m-1];
}
function problem19_var2()
{
	$w = 1;
	for( $i = 1 ; $i <= 12 ; $i++ ){
		$w += day(1900,$i);
		$w%=7;
	}
	
	//pre($w); = 2
	
	$cnt = 0;
	for($j=1901;$j<=2000;$j++){
		for( $i = 1 ; $i <= 12 ; $i++ ){
			$w += day($j,$i);
			$w%=7;
			if( $w == 0 ){
				$cnt++;
			}
		}
	}
	
	return $cnt;
}

?>
<?php //@highlight_end?>
<?php

$s = a('http://euler.synap.co.kr/prob_detail.php?id=19'
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
		li('executeTimer( "problem19_var1" ) ['.executeTimer( "problem19_var1" ).']' )->
		li('executeTimer( "problem19_var2" ) ['.executeTimer( "problem19_var2" ).']' )->
	end(); 
?>