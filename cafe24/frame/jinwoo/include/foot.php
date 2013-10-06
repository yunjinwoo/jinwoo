
	<div id="footer">
		CopyRight &copy; 2013 by VATECH CO., LTD. ALL RIGHT RESERVED
	</div>
</div>
<?php msg_print();
print_foot_tag();?>
<script type="text/javascript">
$(function(){
	$("#contents div.cont_location > a").each(function(i){
		if( i == 0 ) $(this).attr('href', './');
		else if(i == 1) $(this).attr('href', '?');
		else $(this).attr('href', location.href);
	});
});


	$("img").bind('error',function(){
		$(this).hide();
	});
</script>
</body>
</html>
