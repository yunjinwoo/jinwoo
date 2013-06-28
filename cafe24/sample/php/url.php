<?php
include_once '_default.php' ; DEFAULTTAG('UTF-8') ;
?>
<form method="post" action="">
<input type="hidden" name="decode_type">
<table>
	<tr>
		<td><textarea name="text_before_text" id="text_before_text" rows="30" cols="80"></textarea></td>
		<td valign=top>
			<button onclick="this.form.elements['decode_type'].value='encode';this.form.submit();" >변경</button>
			<button onclick="this.form.elements['decode_type'].value='decode';this.form.submit();">복귀</button>
		</td>
		<td><textarea name="text_before_text" id="text_before_text" rows="30" cols="80"></textarea></td>
	</tr>
	</table>	
</form>