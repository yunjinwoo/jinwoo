if( !window.console ){ 
	window.console={log:function(){},info:function(){},group:function(){},groupEnd:function(){},error:function(){}} ; 
}
	
	function previewPopup()
	{
		window.open('banner_preview.php','preview','width=900,height=400,scrollbars=yes').focus() ;
	}
	function iconPopup(icon_index)
	{
		window.open('icon_preview.php?icon='+icon_index,'icon_preview','width=625,height=560,scrollbars=yes').focus() ;
	}
	
	
	function previewPopup_pro()
	{
		window.open('img_preview.php','preview_pro','width=900,height=400,scrollbars=yes').focus() ;
	}
