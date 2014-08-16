<?php

/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
Problem 15 : 2012-01-03 19:11:35

아래와 같은 2 × 2 격자의 왼쪽 위 모서리에서 출발하여 오른쪽 아래 모서리까지 도달하는 길은 모두 6가지가 있습니다 (거슬러 가지는 않기로 합니다).


그러면 20 × 20 격자에는 모두 몇 개의 경로가 있습니까?
 */

//@high_no highlight print
/*@high_no*/printLayout('Problem 15');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;


function problem15($box_size)
{
	$size = array();
	foreach( array_fill(0, $box_size, 0) as $k => $v ){
		$size[$k] = array_fill(0, $box_size, 0);
	}
	
	$cnt = 0;
	
	for( $i = 0 ; $i < $box_size ; $i++ ){
		$cnt++;
	}

	foreach( $size as $k => $a ){
		for( $i = $k ; $i < $box_size ; $i++ ){
			$cnt++;
		}
	}
	
	$n = (pow($box_size, 2)-1)*2;
	return $n;
}


function test($size = 20){
	
	$size = 20;
	$table = array() ;
for($i=0; $i<$size+1; $i++){
	$table[0][$i] = 1;
	$table[$i][0] = 1;
}
for($i=1; $i<$size+1; $i++){
	for($j=1; $j<$size+1; $j++){
		$table[$i][$j] = $table[$i-1][$j]+$table[$i][$j-1];
	}
}
return $table[$size][$size];

}
?>
<?php //@highlight_end?>
<?php

$s = a('http://euler.synap.co.kr/prob_detail.php?id=15'
		,'project Euler@kr'
		,'_blank') ;
 
echo $s.' 답보고 이해했지만...  되돌아 올수없다는 조건이 있고 한줄에 1씩 더하는 거라면 0 쪽에 값을 더해서 구하는 방식이 이해가 된다.';
echo h1(test(20));
$ul = new ul ;
// 99999 => 77031[351]
/*
 * 999999 ~ 899999 939497[507]:
 * 899999 ~ 699999 837799[525]:
 */
echo ul()->
		li('executeTimer( "problem15" , "2" ) ['.executeTimer( "problem15" , "2" ).']' )->
		li('executeTimer( "problem15" , "20" ) ['.executeTimer( "problem15" , "20" ).']' )->
	end(); 
?>

<pre>

댓글에 있는 순열방식
http://euler.synap.co.kr/forum_list.php?p=15&pg=1
 GOne
 
 
function permutation(n, m){
	var mn = m+n;
	var result = 1;
	for(var i=0;i&ltn; i++){
		result *= (mn-i)/(m-i);
	}
	return result;
}

<h3 id="test_div"></h3>
</pre>
<script>
	
function permutation(n, m){
	var mn = m+n;
	var result = 1;
	for(var i=0;i<n; i++){
		result *= (mn-i)/(m-i);
	}
	return result;
}

document.getElementById("test_div").innerHTML = permutation(20,20);
</script>