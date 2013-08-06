<?php


function newline()
{
	return "\n" ;	
}
function tab()
{
	return "\t" ;	
}



function arrToTagUl($arr, $find = "" )
{
	$ul = ul() ;
	if( empty($find) )
	{
		foreach( $arr as $k => $v )
			$ul->li( $k.'::'. $v ) ;
	}else{
		foreach( $arr as $k => $v )
		{
			if( $v != $find )	
				$ul->li( $k.'::'. $v ) ;
			else
				$ul->li( strong($k.'::'. $v) ) ;
		}
	}
	
	return $ul->end() ;
}
?>
