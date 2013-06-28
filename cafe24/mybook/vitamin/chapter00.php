
<h3>1.<?php echo getSubTitle() ; ?> : 인간은 10진수 컴퓨터는 2진수</h3>

<?php
function chapter0_is_Var($var){	$var = trim($var) ; return !empty($var) && preg_match( '/[0-9a-zA-Z]/' , $var) ; }
function NT_division( $n , $v )
{
	if( $n < $v )
		return $n ;

	return NT_division( floor($n/$v) , $v ).($n%$v) ;
} 

$nNT1		= post('nt1') ;
$nNT_number = strtoupper(post('nt_number')) ;
$nNT2		= post('nt2') ;

if( chapter0_is_Var($nNT1) && chapter0_is_Var($nNT_number) && chapter0_is_Var($nNT2) )
{
	// 0 의 chr값은 48

	$ten_number = 0 ; 
	$step = 1 ; 
	for( $i = strlen($nNT_number) - 1 ; $i >= 0 ; $i-- )
	{
		$var = (ord(substr($nNT_number,$i,1))-48) ;
		if( $var > 9 ) $var -= 7 ;
		//echo $ten_number.'::'.$var.'<br />' ;
		$ten_number += $step*$var ;
		$step = $step*$nNT1 ;
	}
	?>
	
	<b><?php echo $nNT1?></b>진수 <b><?php echo $nNT_number?></b>은 <br />
	<b><?php echo $nNT2?></b>진수의 <b class="red"><?php echo NT_division($ten_number,$nNT2) ; ?></b>입니다.
<?
}
?>
<div>
	<form method="post" onsubmit="return checkFrm(this)">
		
		<input type="text" name="nt1" class="required validatenumber" size=3 value="<?php echo $nNT1?>">진수
		<input type="text" name="nt_number" class="required validatealphanum" size=8 value="<?php echo $nNT_number?>"> 를

		<input type="text" name="nt2" class="required validatenumber" size=3 value="<?php echo $nNT2?>">진수로
		
		<input type="submit" value="변경하기">
	</form>
</div>