<?php
require_once '_head.php' ;


$nAction = get('action') ;
if( is_file('chapter'.str_pad($nAction,4,'0',STR_PAD_LEFT).'.php') )
	include 'chapter'.str_pad($nAction,4,'0',STR_PAD_LEFT).'.php' ;


?>
<script type="text/javascript">
<!--
	function checkFrm( frm ){
		if( !Validator.validate(frm) )
			return false ;
		return true ;
	}

//-->
</script>
</body>
</html>