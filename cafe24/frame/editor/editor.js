// <script src="js/tinymce/tinymce.min.js"></script>

tinymce.PluginManager.add('uploadimage', function(editor) {

	editor.addButton('uploadimage', {
		icon: 'image',
		tooltip: 'Insert/edit image',
		onclick: function(){
			window.open('file.php','file','width=450,height=400') ;
		},
		stateSelector: 'img:not([data-mce-object])'
	});
});

/* 주석 내용과 같이 실행한다.
tinymce.init({
	selector: "textarea",
	theme: "modern",
	plugins: [
		"advlist autolink link uploadimage lists charmap print preview hr anchor pagebreak spellchecker",
		"searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
		"save table contextmenu directionality emoticons template paste  "
	],
	content_css: "css/development.css",
	add_unload_trigger: false,

	toolbar: "insertfile undo redo | styleselect fontselect fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link uploadimage | print preview media fullpage | forecolor backcolor emoticons",

	style_formats: [
		{title: 'Bold text', format: 'h1'},
		{title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
		{title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
		{title: 'Example 1', inline: 'span', classes: 'example1'},
		{title: 'Example 2', inline: 'span', classes: 'example2'},
		{title: 'Table styles'},
		{title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
	]
});
*/
