<?php

function codeCheckedLogic($code_name)
{
	$codeData = Code::getCodeStr($code_name);
	switch( $codeData )
	{
		case 'Y':$checked = 'checked="checked"' ; break;
		case 'N':default:$checked = '' ; break;
	}
	
	$get_code_name = G::get('code');
	$get_code_onoff = G::get('code_onoff');
	if( $get_code_name == $code_name )
	{
		switch( $get_code_onoff )
		{
			case 'Y':
			case 'N':
				Code::setCodeStr($code_name, $get_code_onoff);
				
				$aUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
				parse_str($aUrl, $arr);
				
				if(isset($arr['code']))	unset($arr['code']);
				if(isset($arr['code_onoff']))	unset($arr['code_onoff']);

				h_location( '?'.  http_build_query($arr,'','&amp;') );
			break;
		}
	}
	
	$id = $code_name.'menu_on_off';
	echo '
	<input type="checkbox" value="Y" id="'.$id.'" '.$checked.'>
	<label for="green_menu_on_off">노출</label>
	
	<script type="text/javascript">
		$(function(){
			$("#'.$id.'").bind("change",function(e){
				e.preventDefault();
				
				if( $(this).is(":checked") ){
					location.replace( location.href + "&code='.$code_name.'&code_onoff=Y" );
				}else{
					location.replace( location.href + "&code='.$code_name.'&code_onoff=N" );
				}
				
			});
		});
	</script>
	';
}