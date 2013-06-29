<?php
require_once '_head.php' ;


if( !isset( $_bookMenu[get('action')] ) )
	return ;

$nAction = get('action') ;
include 'chapter'.str_pad($nAction,2,'0',STR_PAD_LEFT).'.php' ;

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