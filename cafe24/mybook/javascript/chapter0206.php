
<h4>2-6.<?php echo getSubTitle() ; ?></h4>

<article>
	<section class="well well-sm">
		핸들러가 실행될 때 컨텍스트가 바뀔수 있다.
		
		<pre class="brush: javascript;">
			<script type="text/javascript">
				new function(){
					this.appName = "new";
					
					var b = document.body;
					b.addEventListener("click",function(){
						// 정의되지 않았다
						console.log( this.appName );
					}, false);
				}
				
				
				new function(){
					this.appName = "new2";
					
					var b = document.body;
					b.addEventListener('click',$.proxy(function(){
						console.log( this.appName );
					},this));
				}
			</script>
		</pre>
	</section>
</article>
