<?php

/*@high_no*/ if(!defined("_PATH_"))	require_once '../_default.php';
/*
Problem 17 : 2012-01-03 19:11:35

1부터 5까지의 숫자를 영어로 쓰면 one, two, three, four, five 이고,
각 단어의 길이를 더하면 3 + 3 + 5 + 4 + 4 = 19 이므로 사용된 글자는 모두 19개입니다.

1부터 1,000까지 영어로 썼을 때는 모두 몇 개의 글자를 사용해야 할까요?

참고: 빈 칸이나 하이픈('-')은 셈에서 제외하며, 단어 사이의 and 는 셈에 넣습니다.
  예를 들어 342를 영어로 쓰면 three hundred and forty-two 가 되어서 23 글자,
  115 = one hundred and fifteen 의 경우에는 20 글자가 됩니다. */

//@high_no highlight print
/*@high_no*/printLayout('Problem 17');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;


function problem17($max)
{
	$num_len = 0 ;
	for( $i = 1 ; $i <= $max ; $i++ ){
		$s = number4ToAlphabet($i);
		$s1 = str_replace(' ','',$s);
		$s1 = str_replace('-','',$s1);
		$num_len += strlen($s1);
		echo $num_len.'-'.$i.'::'.$s.'::'.$s1.'<br />';
	}
	return $num_len;
}


function number4ToAlphabet($num){
	
	$num = substr($num,-4);
			
	$alphabet = array();
	$alphabet[0] = "";
	$alphabet[1] = "one";
	$alphabet[2] = "two";
	$alphabet[3] = "three";
	$alphabet[4] = "four";
	$alphabet[5] = "five";
	$alphabet[6] = "six";
	$alphabet[7] = "seven";
	$alphabet[8] = "eight";
	$alphabet[9] = "nine";
	$alphabet[10] = "ten";
	$alphabet[11] = "eleven";
	$alphabet[12] = "twelve";
	$alphabet[13] = "thirteen";
	$alphabet[14] = "fourteen";
	$alphabet[15] = "fifteen";
	$alphabet[16] = "sixteen";
	$alphabet[17] = "seventeen";
	$alphabet[18] = "eighteen";
	$alphabet[19] = "nineteen";
	
	$num_line = array();
	$num_line[0] = ''; 
	$num_line[2] = 'twenty'; 
	$num_line[3] = 'thirty'; 
	$num_line[4] = 'forty'; 
	$num_line[5] = 'fifty'; 
	$num_line[6] = 'sixty'; 
	$num_line[7] = 'seventy'; 
	$num_line[8] = 'eighty'; 
	$num_line[9] = 'ninety'; 
	
	$alphabet_100 = 'hundred'; 
	
	$last_str = 'thousand'; 
	
	$num = abs($num);
	$s = '';
	if( isset($alphabet[$num]) ){
		$s = $alphabet[$num];
	}else{
		if( strlen($num) >= 2 ){
			$n = substr($num,-2,-1);
			if( $n === '0' || $n === '1' ){
				$s = $alphabet[abs(substr($num,-2))];
			}else{
				$s = $num_line[substr($num,-2,-1)];
				if( $alphabet[substr($num,-1)] != "" ){
					$s = $s.'-'.$alphabet[substr($num,-1)];
				}
			}
			
			$n1 = $n2 = 0;
			$s1 = '';
			if(strlen($num) == 3){
				$n2 = substr($num,0,1);
				$s1 = $alphabet[substr($num,0,1)].' '.$alphabet_100;
			}else if(strlen($num) == 4){
				$n1 = substr($num,0,1);
				$n2 = substr($num,1,1);
				if(!empty($n2)){
					$s1 = $alphabet[$n1].' '.$last_str.' '.$alphabet[$n2].' '.$alphabet_100;
				}else{
					$s1 = $alphabet[$n1].' '.$last_str;
				}
			}
			
			if( !empty($s1) ){
				if( !empty($s) ){
					$s = $s1.' and '.$s;
				}else{
					$s = $s1;
				}
			}			
		}
	}
	
	return $s;
}
?>
<?php //@highlight_end?>
<?php

$s = a('http://euler.synap.co.kr/prob_detail.php?id=17'
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
		li('executeTimer( "problem17" , "5" ) ['.executeTimer( "problem17" , "5" ).']' )->
		li('executeTimer( "problem17" , "1000" ) ['.executeTimer( "problem17" , "1000" ).']' )->
	end(); 
?>