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

/**
 * 500개 이상이 되려면 32 개의 약수가 필요하다
 * 어렵다 긁어온 스크립트 소스의 sqrt 값에 대한 이해가 부족하다....
 */
function problem12($cnt)
{
	if(!is_numeric($cnt)){ return 0; }
	
	$while_total = 0;
	$arr = array(1) ;
	$sum = $idx = 1;
	while( count($arr) < $cnt ){
		$idx++;
		$sum = $sum + $idx ;
		$i = 2;
		$tmp = array(1 => 1) ;
		while($sum > $i){
			$while_total++;
			if( $sum % $i == 0 ){
				$tmp[$i] = $i ;
			}
			
			$i++;
		}
		
		$tmp[$sum] = $sum ;
		$arr = $tmp;
	}
	
	return $sum."[".$while_total."]".print_r($arr, true) ;
}


?>
<?php //@highlight_end?>
<?php
$s = a('http://euler.synap.co.kr/prob_detail.php?id=12'
		,'project Euler@kr'
		,'_blank') ;
$ul = new ul ;

echo ul()->
		li( sqrt(2) )->
		li( sqrt(5) )->
		li( sqrt(10) )->
		li( sqrt(28) )->
		li( sqrt(36) )->
		li( sqrt(48) )->
	end(); 


$step = 50 ;
echo h2($step);
echo ul()->
		li('executeTimer( "problem12" , "'.$step.'" ) ['.executeTimer( "problem12" , $step ).']' )->
	end(); 
?>

<div>step : <strong id="asdf"></strong></div>
<div>500개 <strong id="asdf500"></strong></div>
<script type="text/javascript">
<!--
	var while_total = 0;
	window.onload = function() {

	
		var add = 1;
		var now = 0;
		now += (add++)
		while (getDiv(now) < <?=$step?>) {
			now += (add++);
		}
		document.getElementById("asdf").innerHTML = now + "["+while_total+"]";
		
		add = 1;
		now = 0;
		now += (add++)
		while (getDiv(now) < 500) {
			now += (add++);
		}
		document.getElementById("asdf500").innerHTML = now + "["+while_total+"]";
	}
	function getDiv(input) {
		var cnt = 0;
		for ( var i = 1; i < Math.sqrt(input); i++) {
			while_total++;
			if (input % i == 0)
				cnt++
		}
		return cnt * 2;
	}

//-->
</script>