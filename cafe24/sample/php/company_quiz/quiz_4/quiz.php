<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title> 이진수 곱하기 </title>
<meta name="Generator" content="EditPlus">
<meta name="Author" content="">
<meta name="Keywords" content="">
<meta name="Description" content="">
</head>

<body>
<table cellpadding=0 cellspacing=0 width="100%" border=0 class="table_table">
<tr>
	<td class="table_data"  valign=top>
		<center>
			<img src="quiz_4.gif">
		</center>
	</td>
	<td class="table_data" valign=top>
		테스트 데이타 <br />
		<?php
			$aNumber = array( '11 11' , '111 00' , '111000 100111' , '1100' , '1010 11100' ) ;
			foreach( $aNumber as $k => $v )
			{
				echo 'case '.(++$k).'# '.$v.'<br />' ;
			}
		?>
	</td>
	<td class="table_data" valign=top>
	<pre>
	<?php
		foreach( $aNumber as $k => $v )
		{
			$a = explode( ' ', $v ) ;
			echo 'case '.(++$k).'# '."\n".binMultiShow( $a[0] , $a[1] ).'<br />' ;
			echo '<hr />'."\n"  ;
		}

		function binMultiShow( $n1 , $n2 )
		{
			// 필터링?
			// if( !is_binary($n1) || !is_binary($n2) ) return -1 ;
			
			$n1Len = strlen($n1) ;
			$n2Len = strlen($n2) ;

			if( $n1Len > $n2Len ){
				$spaceLen = $n1Len ;
			}else{
				$spaceLen = $n2Len ;			
			}
	
			$s.= space_pad( $spaceLen - $n2Len , $spaceLen ) ;
			$s.= $n1 ."\n" ;
			$s.= space_pad( $spaceLen - $n1Len , $spaceLen ) ;
			$s.= $n2 ."\n" ;
			$s.= '----------'."\n" ;

			$sum = 0 ;
			for( $i = $m = $n2Len - 1 ; $i >= 0 ; $i-- )
			{
				$tmp = $n1 * substr( $n2 , $i , 1) ;
				$s.= space_pad( 0 , $i + $spaceLen - strlen($tmp) + 1 ) ;

				$s.= $tmp ;
				$s.= "\n" ;

				$numStep = ($m - $i) + 1 ;
				$numStep10 = 1 ;
				for( $numStep-- ; $numStep > 0 ;  $numStep-- )
				{
					$numStep10 *= 10 ;
				}
				
				$sum += $tmp * $numStep10 ;
				$sum = test_bin( $sum ) ;
			}			
			$s.= '----------'."\n" ;
			$s.= $sum."\n" ;
			return $s ;
		}

		function space_pad( $n , $k )
		{
			$r = '' ;
			for( $i = $n ; $i < $k ; $i++ )
			{
				$r.= ' ' ;
			}
			return $r ;
		}
		function test_bin( $n )
		{	
			$r = '' ;
			$up = 0 ;
			for( $i = strlen($n) - 1 ; $i >= 0 ; $i-- )
			{
				$t = substr( $n , $i , 1) ;

				if( $up == 1 )
				{
					$t = $t + 1 ;
					$up = 0 ;
				}

				if( $t >= 2 )
				{
					$up = 1 ;
					$t = $t - 2 ;					
				}
				$r = $t . $r ;
			}

			if( $up == 1 )
			{
				$r = 1 . $r ;
			}

			return $r ;
		}


	?>
	</pre>
	</td>
</tr>
</table>
<hr /> 
<hr /> 
</body>
</html>
<?php highlight_file(__FILE__);?>