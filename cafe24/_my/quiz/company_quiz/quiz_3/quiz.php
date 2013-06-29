<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title> 3개의 곱 </title>
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
			<img src="quiz_3.gif">
		</center>
	</td>
	<td class="table_data" valign=top>
		테스트 데이타 <br />
		<?php
			$aNumber = array( '13' , '14' , '15' , '17' , '21' , '22' , '23' , '24' ) ;
			foreach( $aNumber as $k => $v )
			{
				echo 'case '.(++$k).'# '.$v.'<br />' ;
			}
		?>
	</td>
	<td class="table_data" valign=top>
	<?php
		
		foreach( $aNumber as $k => $v )
		{
			echo 'case '.(++$k).'# '.numberToType01($v).'<br />' ;
		}
		function numberToType01( $number )
		{
			//echo decbin( $number ).'::'.test_decbin( $number ) ;

			$return_str = '' ;
			$number_cnt = 0 ;
			$number_bin = test_decbin( $number ) ;
			for( $i = 0 , $m = strlen( $number_bin ) ; $i < $m ; $i++ )
			{
				if( ($n = substr( $number_bin , $i , 1 )) == 1 )
				{
					if(++$number_cnt > 3 )
					{
						return -1 ;
					}
					$tmp = ( $m - $i ) -1 ;

					$return_str .= $tmp.' ' ; 
				}
			}
			return $return_str ;
		}
		function test_decbin( $n )
		{
			$r = '' ;
			do{
				$r = ($n%2).$r  ;
			}while( ($n = $n/2) > 1 ) ;
			return $r ;
		}
	?>
	</td>
</tr>
</table>
<hr /> 
<hr /> 
</body>
</html>
<?php highlight_file(__FILE__);?>