<?php
require_once '_head.php' ;


$nAction = get('action') ;
if( is_file('chapter'.substr($nAction,0,2).'.php') )
	include 'chapter'.substr($nAction,0,2).'.php' ;
if( is_file('chapter'.str_pad($nAction,4,'0',STR_PAD_LEFT).'.php') )
	include 'chapter'.str_pad($nAction,4,'0',STR_PAD_LEFT).'.php' ;


?>
		</div><!--//class="col-md-7"-->
	</div><!--//class="row"-->
</div><!--//class="container"-->


<div class="container">
	<div class="jumbotron">
	<h1>test</h1>
	</div>
</div>


<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/mybook/Validator.js"></script>


<script type="text/javascript" src="../../sun/highlight.js"></script>
<style type="text/css">.syntaxhighlighter {overflow: visible !important;}</style>
<script>
$(function () {
	$('.dropdown-toggle').dropdown();
	//$(".tooltip-toggle").tooltip({selector:$("#"+$(this).attr("data-tooltip"))});
	$(".tooltip-toggle").each(function(){
		//console.log( $(this).attr("data-tooltip") ) ;
		$(this).tooltip({selector:$("#"+$(this).attr("data-tooltip"))});
	});
	$('.collapse').collapse()
	$('#myTab a:last').tab('show');
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		//alert($($(this).attr("href")).html());
		//e.target // activated tab
		//e.relatedTarget // previous tab
	});
});
</script>

</body>
</html>