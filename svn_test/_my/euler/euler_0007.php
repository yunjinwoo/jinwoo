<?php
/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
Problem 6

1���� 10���� �ڿ����� ���� ������ ���ϸ� ������ �����ϴ� (������ ��).

12 + 22 + ... + 102 = 385
1���� 10�� ���� ���� ������ �� ����� �����ϸ� ������ �����ϴ� (���� ����).

(1 + 2 + ... + 10)2 = 552 = 3025
���� 1���� 10���� �ڿ����� ���� "���� ����"�� "������ ��" �� ���̴� 3025 - 385 = 2640 �� �˴ϴ�.

�׷��� 1���� 100���� �ڿ����� ���� "���� ����"�� "������ ��"�� ���̴� ���Դϱ�?
 */


//@high_no highlight print
/*@high_no*/printLayout('Problem 7');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;

function problem7($cnt)
{


	$aPrimes = array(2=>2,3=>3);
	switch($max)
	{
		case 1: case 2: case 3: case 5: 
			return $max;
		break;
		case 4:
			return 3;
		break ;
	}
	$tmp = 5 ;
	while( bcmod($max, 2) === "0" ) $max = bcdiv($max, 2 );
	while( bcmod($max, 3) === "0" ) $max = bcdiv($max, 3 );
	//echo h1($max.':::'.bcmod($max, 2).':::');
	for( $i = 6 ; $i < $max ; $i+=6)
	{
		$t1 = $i-1;
		$t2 = $i+1;
		$primes1 = false ;
		$primes2 = false ;
		foreach($aPrimes as $v){
			if( $t1 % $v === 0 ){
				$primes1 = true ;
			}
			if( $t2 % $v === 0 ){
				$primes2 = true ;
			}
			if( $primes1 || $primes2 )
				break ;
			if($v>sqrt($t1))
               break;			
			if($v>sqrt($t2))
               break;
		}
		if( !$primes1 ){
			$aPrimes[$t1] = $t1 ;
			while( bcmod($max, $t1) === "0" ){
				$max = bcdiv($max, $t1) ;
				$tmp = $t1 ;
				if( $max <= $t1 ) break ;
			}
		}
		if( !$primes2 ){
			$aPrimes[$t2] = $t2 ;
			while( bcmod($max, $t2) === "0" ){
				$max = bcdiv($max, $t2) ;
				$tmp = $t2 ;
				if( $max <= $t1 ) break ;
			}
		}
		
		if( $tmp >= $max ) break ;
	}	
	
	$isPrimes = false ;
	foreach($aPrimes as $v)
		if( $max % $v === 0 ){
			$isPrimes = true ;
			break;
		}
	if(!$isPrimes)
		return $max ;
	else
		return $tmp ;
}
print_r( problem7(10000) ) ;
echo ul()->
		li('executeTimer( "numberSumPow" , 1, 10 )'.executeTimer( "problem7" , 10000 ) )->
	end(); 
?>
