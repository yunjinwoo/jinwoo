
<h4>2-8.<?php echo getSubTitle() ; ?></h4>

<article>
	<section class="well well-sm">
		브라우저에서 지원하는 이벤트 말고 커스텀 이벤트를 만들고 발생시킬 수 있다.
		여러 브라우저가 w3c의 커스텀 이벤트 규격 명세를 무시하고 만들었다.
		따라서 커스텀 이벤트 기능을 만들려면 jquery,prototype 같은 플러그인을 
		사용해야 한다.
	</section>
	
	<section class="well well-sm">
		이벤트 이름을 이용해 명칭공간을 사용할 수 있는데
		명칭공간은 마침표와 역순으로 구분된다.
		<pre class="brush: javascript;">
			<script type="text/javascript">
				// 커스텀 이벤트 바인드
				$("h4").bind("refresh.widget",function(){
					console.log("refresh.widget");
				});
				$("h4").trigger("refresh.widget");
				
				
				$("h4").bind("frob.widget",function(e, data1){
					console.log("frob.widget [data1="+data1+"]");
				});
				$("h4").trigger("frob.widget", "test");
			</script>
		</pre>
	</section>
</article>
