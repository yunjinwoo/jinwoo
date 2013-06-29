<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title> New Document </title>
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
			<img src="quiz_6.gif">
		</center>
	</td>
	<td class="table_data" valign=top>
		테스트 데이타 <br />
		<?php
			$aNumber = array( '11 11' , '111 00' , '111000 100111' , '1100' , '1010' ) ;
			foreach( $aNumber as $k => $v )
			{
				echo 'case '.(++$k).'# '.$v.'<br />' ;
			}
		?>
	</td>
	<td class="table_data" valign=top>
	<?php
	?>
	</td>
</tr>
</table>
</body>
</html>
<?php highlight_file(__FILE__);?>