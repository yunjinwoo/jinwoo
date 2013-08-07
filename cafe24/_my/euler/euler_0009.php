<?php
/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
Problem 9 : 2012-01-03 19:11:35

세 자연수 a, b, c 가 피타고라스 정리 a2 + b2 = c2 를 만족하면 피타고라스 수라고 부릅니다 (여기서 a < b < c ).
예를 들면 32 + 42 = 9 + 16 = 25 = 52이므로 3, 4, 5는 피타고라스 수입니다.

a + b + c = 1000 인 피타고라스 수 a, b, c는 한 가지 뿐입니다. 이 때, a × b × c 는 얼마입니까?
 */

//@high_no highlight print
/*@high_no*/printLayout('Problem 9');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;

/*
 * 3세자리 수를 찾는 이해력 부족의 코드.....
 */
function findPita( $num ) 
{
	$aArr = range(1,$num);
	$bArr = range(2,$num);
	$pitaArr = array() ;

	$cnt = 0 ;
	foreach($aArr as $k => $a)
	{
		foreach($bArr as $b)
		{
			$cnt++ ;
			if( $cnt >= 400000 )
				break 2 ;
			$c = sqrt( pow($a,2)+pow($b,2) )  ;
			if( intval($c) == $c )
				$pitaArr[$a.':'.$b] = $c ;
		}
		unset( $bArr[$k] );
	}
	
	asort($pitaArr) ;
	return $pitaArr ;
}

$s = a('http://euler.synap.co.kr/prob_detail.php?id=9'
		,'project Euler@kr'
		,'_blank') ;
echo h1("피타고라스의 수 ".$s);

$startTime = microtime(ture);
$arr = findPita(100) ;
$endTime = microtime(ture) - $startTime ;
echo ul()->		
		li('arrToTagUl( $arr , 100 )'.  $endTime.'::'.arrToTagUl( $arr , 100 ) )->
	end(); 



/*
 * 소인수 분해가 되어 버린 이해력 부족의 코드.....
 */
function problem9_failure($num = 1000)
{	
	$cnt = 1 ;
	$primes = array() ;
	while( $cnt++ < 100000 )
	{
		if($num%$cnt == 0 )
		{
			$primes[$cnt] = 1 ;
			$num = $num/$cnt ;
			foreach( $primes as $k => $v )
			{
				while( $num % $k == 0 )
				{
					$primes[$k] += 1 ;
					$num = $num/$k ;
				}
			}
		}
		
	}
	
	$sum = 0 ;
	foreach( $primes as $k => $v )
		$sum += pow( $k, $v ) ;
	
	$ulTag = arrToTagUl($primes) ;
	return strong($sum).$ulTag ;
}



function problem9( $num ) 
{
	$aArr = range((int)$num/5,$num);
	$bArr = range((int)$num/5+1,$num);
	$pitaArr = array() ;

	$cnt = 0 ;
	foreach($aArr as $k => $a)
	{
		foreach($bArr as $b)
		{
			$c = sqrt( pow($a,2)+pow($b,2) )  ;
			if( intval($c) == $c )
				if( $a+$b+$c == $num )
					return '$a:$b:$c ['.$a.':'.$b.':'.$c.'] ='.($a*$b*$c) ;
		}
		unset( $bArr[$k] );
	}
	
	return "empty" ;
}
echo ul()->
		li('executeTimer( "problem9" , 1000 )'.executeTimer( "problem9" , 1000 ) )->		
		li('executeTimer( "problem9_failure" , 20 )'.executeTimer( "problem9_failure" , 1000 ) )->		
	end(); 


