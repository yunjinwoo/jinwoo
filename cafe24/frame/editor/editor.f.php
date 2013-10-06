<?php
require_once dirname(__FILE__).'/../_define.php';


ob_start() ;
?>
<script src="<?=_WEB_PATH_?>/editor/js/tinymce/tinymce.min.js" type="text/javascript"></script>
<script type="text/javascript">
//<![CDATA[

tinymce.PluginManager.add('uploadimage', function(editor) {

	editor.addButton('uploadimage', {
		icon: 'image',
		tooltip: 'Insert/edit image',
		onclick: function(){
			window.open('<?=_WEB_PATH_?>/editor/file.php?key='+tinymce.session_key,'file','width=450,height=400') ;
		},
		stateSelector: 'img:not([data-mce-object])'
	});
});
//]]>
</script>
<?php
$c = ob_get_contents() ;
ob_clean() ;
add_head_tag($c) ;

function editor( $selector = 'textarea' , $editor_session_key = '' , $field = 'b[editor_session_key]', $isResize = "true", $height = 500, $width='' , $aCss = array('../../front/css/sub_layout.css','../../front/css/company_style.css') )
{
	if( empty($editor_session_key) )
	{
		$Session = new Session;
		$editor_session_key = $Session->getMd5key() ;
	}

	$content_css = implode( ',' , $aCss ) ;
	
?>
<input type="hidden" name="<?=$field?>" value="<?=$editor_session_key?>" />
<?php ob_start() ;?>
<script type="text/javascript">
tinymce.session_key = "<?=$editor_session_key?>" ;

tinymce.init({
	selector: "<?=$selector?>",
	theme: "modern",
	menubar: false,
	toolbar_items_size: 'small',
	plugins: [
		"advlist autolink link uploadimage lists charmap print preview hr anchor pagebreak spellchecker",
		"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
		"save table contextmenu directionality emoticons template paste textcolor"
	],
	content_css: "<?=$content_css?>",
	add_unload_trigger: false,
	
	resize: <?=$isResize?>,
	height: <?=$height?>,
				 
	toolbar1: "undo redo | bold italic underline strikethrough | forecolor backcolor | fontselect fontsizeselect ",
	toolbar2: "table | bullist numlist | alignleft aligncenter alignright alignjustify | link unlink uploadimage media | charmap preview code ",
	//toolbar2: "tableDropdown | table | bullist numlist | alignleft aligncenter alignright alignjustify | link unlink uploadimage media | preview code ",
	//toolbar3: "tablegrid,|,row_props,cell_props,|,row_before,row_after,delete_row,|,col_before,col_after,delete_col,|,split_cells,merge_cells",
	
	style_formats: [
		{title: 'Bold text', format: 'h1'},
		{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
		{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
		{title: 'Example 1', inline: 'span', classes: 'example1'},
		{title: 'Example 2', inline: 'span', classes: 'example2'},
		{title: 'Table styles'},
		{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
	]
	
	,convert_urls : false
	
	<?php if(is_numeric($width)):?>
	,width: <?=$width?>
	<?php endif;?>
});

//]]>
</script>
<?
$c = ob_get_contents() ;
ob_clean() ;
add_foot_tag($c) ;} // end editor ;