<?php
function getVar()
{
	return array(15,11,1,3,8,5,7,16,2) ;
	//return array(95,75,85,100,50) ;
}
?>
<style type="text/css">
	#log td{ vertical-align: top;}
</style>
<h3>20.<?php echo getSubTitle() ; ?> : 규칙성을 만들어주는 정렬</h3>

<div style="float:left;width:700px;">
	<div style="float:right;width:680px;">
		<ul>
			<li>버블 정렬
			<li>선택 정렬
		</ul>
		 에 대해서...
<table id="log">
<tr>
	<td><pre>
짜가 버블.... ㅠㅠ
<?php
$aVar = getVar() ;
$tmp = '' ;

print_r( $aVar ) ;
foreach( $aVar as $k => $v )
{
	for( $i = 0 , $m = count($aVar) ; $i < $m ; $i++ )
	{
		if( $aVar[$k] < $aVar[$i] )
		{
			$tmp = $aVar[$k] ;
			$aVar[$k] = $aVar[$i] ;
			$aVar[$i] = $tmp ;

echo $k.'-'.$aVar[$k] ."::".$i.'-'. $aVar[$i].'
' ;
print_r( $aVar ) ;
		}
	}
}
print_r( $aVar ) ;

$bubble = '' ;


?></pre></td>

<td><pre>

정석 버블
<?php
$aVar = getVar() ;
$tmp = '' ;

print_r( $aVar ) ;
for( $j = 0 , $m = count($aVar) ; $j < $m ; $j++ )
{
	for( $i = 0 ; $i < $m-1 ; $i++ )
	{
		if( $aVar[$i] > $aVar[$i+1] )
		{
			$tmp = $aVar[$i+1] ;
			$aVar[$i+1] = $aVar[$i] ;
			$aVar[$i] = $tmp ;

echo ($i+1).'-'.$aVar[$i+1] ."::".$i.'-'. $aVar[$i].'
' ;
print_r( $aVar ) ;
		}
	}
}
print_r( $aVar ) ;

$bubble = '' ;


?></pre></td>
	<td>
	<pre>

짜가 선택
<?php
$aVar = getVar() ;

print_r( $aVar ) ;
for( $j = 0 , $m = count($aVar) ; $j < $m-1 ; $j++ )
{	
	$tmp = $tmp_value = $tmp_key = '' ;
	$tmp = $tmp_value = $aVar[$j] ;
	$tmp_key = $j ;
	for( $i = $j+1 ; $i < $m ; $i++ )
	{
		if( $tmp_value > $aVar[$i] )
		{
			$tmp_value = $aVar[$i] ;
			$tmp_key = $i ;
		}
	}

	if( empty($tmp_key) ) break ;
	
	$aVar[$j] = $tmp_value ;
	$aVar[$tmp_key] = $tmp ;

echo $j."--".$tmp_key ."::".$tmp_value.'
' ;
	print_r( $aVar ) ;
}
print_r( $aVar ) ;

$bubble = '' ;


?></pre>
	</td>
	<td>
	<pre>

검색한 선택
<?php
$aVar = getVar() ;
$min = $tmp = '' ;
print_r( $aVar ) ;
for( $j = 0 , $m = count($aVar) ; $j < $m - 1 ; $j++ )
{	
	$min = $j ;
	for( $i = $j+1 ; $i < $m ; $i++ )
		if($aVar[$min] > $aVar[$i] ) $min = $i ;

	$tmp = $aVar[$j] ;
	$aVar[$j] = $aVar[$min] ;
	$aVar[$min] = $tmp ;

echo $j."--".$min ."::".$aVar[$j].'
' ;
	print_r( $aVar ) ;
}
print_r( $aVar ) ;

$bubble = '' ;


?></pre>
	</td>
</tr>
</table>



		</xmp>
	</div>	
</div>