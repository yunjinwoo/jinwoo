<?php
include_once '_default.php' ; DEFAULTTAG('UTF-8') ;
if( $_POST['decode_type'] == 'encode' )
{
	$a = explode( "\r\n" , $_POST['text_before_text'] ) ;
	foreach( $a as $k => $v )
		$a[$k] = urlencode($v) ;
}else{
	$a = explode( "\r\n" , $_POST['text_before_text'] ) ;
	foreach( $a as $k => $v )
		$a[$k] = urldecode($v) ;
}

?>
<form method="post">
<input type="hidden" name="decode_type">
<table>
	<tr>
		<td><textarea name="text_before_text" id="text_before_text" rows="30" cols="80"><?php echo $_POST['text_before_text']?></textarea></td>
		<td valign=top>
			<button onclick="this.form.elements['decode_type'].value='encode';this.form.submit();" >변경</button>
			<button onclick="this.form.elements['decode_type'].value='decode';this.form.submit();">복귀</button>
		</td>
		<td><textarea name="aaa" id="text_before_text" rows="30" cols="80"><?php echo implode("\r\n",$a)?></textarea></td>
	</tr>
	</table>	
</form>