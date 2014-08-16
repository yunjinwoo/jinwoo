<?php
/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
 *  인터넷에서 찾은 코드....
Problem 7

소수를 크기 순으로 나열하면 2, 3, 5, 7, 11, 13, ... 과 같이 됩니다.

이 때 10,001번째의 소수를 구하세요.
 */


//@high_no highlight print
/*@high_no*/printLayout('Problem 7');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;

function problem7($max)
{
	$aPrimes = array( 2 ) ;
	$i = 3 ; 
	while( count($aPrimes) < $max ) 
	{
		$isPrimes = true ;
		$b = 1 ;
		foreach($aPrimes as $v){
			if( $v > $i/$b ){ // $v 소수 $i 3부터 2씩 올라가는 수 $v 이전 약수 
				break ;
			}else if( $i % $v == 0 ){
				$isPrimes = false ;
				break ;				
			}
			
			$b = $v ;
		}
		
		if( $isPrimes ) $aPrimes[] = $i ;
		if( $cnt-- < 0) break ;
		
		$i+=2 ;
	}
	
	return array_pop($aPrimes);
}
  

/* 말 그대로의 문제 */
?>
<?php //@highlight_end?>
<?php

$s = a('http://euler.synap.co.kr/prob_detail.php?id=7'
		,'project Euler@kr'
		,'_blank') ;
echo h1("소수 알고리즘".$s);

echo ul()->
		li('executeTimer( "numberSumPow" , 1, 10001 )'.executeTimer( "problem7" , 10001 ) )->
	end(); 


?>
<pre>
어딘가에서 가져온거 일껀데......

function p007_in(n){
	if (n <= 2) {
		alert(n);
		return;
	}

	var cnt = 1;

	var prime = new Array();
	prime[0] = 2;
	var t = 3;
	while (cnt < n){
		var check = true;
		for(var i = 0;	i < cnt;	i++) {
			if(prime[i]>t/prime[i-1])
				break; 
			else if(t%prime[i] == 0) {
				check = false;
				break;
			}
		}
		if (check)
			prime[cnt++] = t;
		t += 2;
	}

	alert(prime[n-1]);
}
</pre>