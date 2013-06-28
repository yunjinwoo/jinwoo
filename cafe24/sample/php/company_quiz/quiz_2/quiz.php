<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title> 문자를 보내자 </title>
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
			<img src="quiz_2.gif">
		</center>
	</td>
	<td class="table_data" valign=top>
		테스트 데이타 <br />
		<?php
			$test1 = 'Note that the' ;
			$test2 = 'be urlencoded' ;
			$test3 = 'value portion of the cookie will automatically' ;
			$test4 = 'welcome to ulab' ;
			$test5 = 'good luck and have fun' ;

			echo 'case 1#:'.$test1.'<br />' ;
			echo 'case 2#:'.$test2.'<br />' ;
			echo 'case 3#:'.$test3.'<br />' ;
			echo 'case 4#:'.$test4.'<br />' ;
			echo 'case 5#:'.$test5.'<br />' ;
		?>
	</td>
	<td class="table_data" valign=top>
	<?php
		$aKeypad = array(
			 	'abc'
			,	'def'
			,	'ghi'
			,	'jkl'
			,	'jkl'
			,	'mno'
			,	'pqrs'
			,	'tuv'
			,	'wxyz'
			,	' '
		) ;
				
		echo 'case 1#:'.getPushPad( $test1 ).'<br />' ;
		echo 'case 2#:'.getPushPad( $test2 ).'<br />' ;
		echo 'case 3#:'.getPushPad( $test3 ).'<br />' ;
		echo 'case 4#:'.getPushPad( $test4 ).'<br />' ;
		echo 'case 5#:'.getPushPad( $test5 ).'<br />' ;

		function getPushPad( $str ){
			global $aKeypad ;
			$nLenKeypad = count( $aKeypad ) ;
			$nPushCount = 0 ;

			$str = strtolower($str) ;
			$m = strlen($str) ;
			for( $i = 0 ; $i < $m ; $i++ )
			{
				$char_data = substr( $str, $i , 1 ) ;
				for( $k = 0 ; $k < $nLenKeypad ; $k++ )
				{
					if( ($indexof = strpos( $aKeypad[$k] , $char_data )) !== FALSE )
					{
						$nPushCount += ++$indexof ;
						break ;
					}
				}
			}

			return $nPushCount ;
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