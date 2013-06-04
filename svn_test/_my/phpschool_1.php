<?php
require_once '_default.php';


/*@high_no*/printLayout('self-number test');
/*@high_no*/highlight_string(getReadContents(__FILE__)) ;



/* http://phpschool.com/gnuboard4/bbs/board.php?bo_table=talkbox2&wr_id=785463
----****
----***
----**
----*
---*
--**
-***
****

이렇게 나와야 함

그런데!!!!!!!!!

[ 조건1 ] 반복문은 최대 두번까지만 사용 가능!! (for, while 등등)
[ 조건2 ] 출력문도 최대 두번까지만 사용 가능! (echo, <?=?> 등등)
[ 조건3 ] 변수도 최대 두개까지만 사용 가능!
[ 조건4 ] 출력문 하나가 열글자 이상 출력 금지
 */

$s = a('http://phpschool.com/gnuboard4/bbs/board.php?bo_table=talkbox2&wr_id=785463'
		,'phpschool에서'
		,'_blank') ;
echo h2("결과 ".$s);


echo '<ol>' ;
for( $j = 4 ; $j > -4 ; $j-- )
{
	echo '<li>' ;
	if( $j <= 0 )	echo str_repeat ('-',3+$j).str_repeat ('*',abs($j)+1); 
	else			echo str_repeat ('-',4).str_repeat ('*',abs($j));
	echo '</li>' ;
}
echo '</ol>' ;	
	

for($i = 8; $i >= 0; $i --) {
    if($i == 4) $i --;
    echo str_repeat('-', min(4, $i)), str_repeat('*', abs($i - 4)), "<BR />";
}

$str1 = "----"; 
$str2 = "****"; 
for($i = strlen($str1)-strlen($str2); $i < strlen($str1.$str2); $i++) { 
	if($i < strlen($str1)) { 
		echo substr($str1.$str2, strlen($str1) - strlen($str2), strlen($str1.$str2) - $i)."<br>"; 
	} else { 
		echo substr($str1.$str2,  $i - strlen($str1) + strlen($str1)/strlen($str2), strlen($str1))."<br>";	
	} 
} 