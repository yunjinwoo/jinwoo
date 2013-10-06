<?php
require_once '../_define.php';
require_once _PATH_lib_.'/upload.c.php';
require_once _PATH_lib_.'/dbConnector.c.php';

$sActionType = G::get('action') ;
if( $sActionType == 'upload' )
{
	
	$aFile = G::file('upload') ;
	if( isset($aFile['tmp_name']) && is_uploaded_file($aFile['tmp_name']) )
	{
		$name = md5($aFile['tmp_name']);
		$path = _PATH_data_.'/editor/new' ;
		$upload = new Upload('image', $path, $name) ;
		$result = $upload->move($aFile);
		
	}

	require_once 'file.php';
}else{
	require_once 'sample.html';
}?>
<script type='text/javascript'>

tinymce.PluginManager.add('uploadimage', function(editor) {

	editor.addButton('uploadimage', {
		icon: 'image',
		tooltip: 'Insert/edit image',
		onclick: function(){
			window.open('test.php?action=upload','file','width=450,height=400') ;
		},
		stateSelector: 'img:not([data-mce-object])'
	});
});

</script>