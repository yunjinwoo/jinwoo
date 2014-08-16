<?php

function getSumDivisor($n){
	$sum = 1 ;
	// 약수를 더하고 while 약수까지 구하는게 포인트.... 많은 연산을 줄일수있다..
	// 참고 : http://creatorhong.blogspot.kr/2012/03/project-euler-21-10000.html
	for( $i = 2; $i <= $n/$i ; $i++ ){
		if( $n % $i == 0 ){
			$sum += $i + ((($n/$i)==$i)?0:$n/$i);
		}
	}
	
	return $sum;
}



// 함수에 오류가 있는듯하다...
function getDivisor($n){
	global $totalFor;
	
	$a = array();
	$i = 2;
	$last = 0;
	// 약수를 더하고 while 약수까지 구하는게 포인트.... 많은 연산을 줄일수있다..
	// 참고 : http://creatorhong.blogspot.kr/2012/03/project-euler-21-10000.html
	while( $i <= $n/$i ){
		$totalFor++;
		if( $n % $i == 0 ){
			$a[$i] = $i;
			$a[$n / $i] = $n / $i;
		}
		$i++;
	}
	
	$a[1] = 1;
	unset($a[$n]);
	
	
	return array_keys($a);
}