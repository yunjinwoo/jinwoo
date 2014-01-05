
<h4>1-11.<?php echo getSubTitle() ; ?></h4>

<article>
	<?php JsDefault::char01_class();?>
	<section class="well well-sm">
		익명함수를 이용해 내부에서만 접근할 수 있는 비공개 범위를 만들 수 있다
	</section>
	
	
	<section>
		<pre class="brush: javascript;">			
			<script type="text/javascript">
			var Person = function(){};
			(function(){
				var findById = function(){
					console.log( arguments ); 
				};
				Person.find = function(id){
					if( typeof id == "integer" )
						return findById(id);
				};
			})();
			
			(function(exports){
				var foo = "bar";
				// 변수 노출
				exports.foo = foo ;
			})(window);
			
			assertEqual(foo, "b1ar");
			</script>
		</pre>
	</section>
	
</article>
