
<h4>1-9.<?php echo getSubTitle() ; ?></h4>

<article>
	<section class="well well-sm">
		apply()와 call() 함수의 차이
	</section>
	
	
	<section>
		<pre class="brush: javascript;">
			// 컨텍스트와 인자 배열
			function.apply(this,[1,2,3]);
			
			// 컨텍스트와 사용자 정의 인자
			function.call(this,1,2,3);
		</pre>
	</section>
		
	<section>
		<pre class="brush: javascript;">
			컨텍스트 이용
			<script type="text/javascript">
			$("h4").click(function(){
				$(this).hide();
			});
			
			$("section").click(function(){
				$(this).remove();
			});
			</script>
		</pre>
	</section>
	
	<section>
		<a href="#" class="clickay">.clickay</a>
		<pre class="brush: javascript;">
			컨텍스트 변수에 저장후 이용하는 방법
			<script type="text/javascript">
			var clicky = {
				wasClicked : function(){
					console.log( this ) ;
				},
				
				addListeners : function(){
					var self = this; // clicky
					$(".clickay").click(function(){
						self.wasClicked();
					});
				}
			}
			
			clicky.addListeners();
			
			</script>
		</pre>
	</section>
	
	
	<section>
		<a href="#" class="clickay2">.clickay2</a>
		<pre class="brush: javascript;">
			
			<script type="text/javascript">
			var proxy = function(func, thisObject){
				return (function(){
					return func.apply(thisObject, arguments);
				});
			}
			var clicky2 = {
				wasClicked : function(){
					console.log( "clicky2" ) ;
				},
				
				addListeners : function(){
					$(".clickay2").click(proxy(this.wasClicked,this));
					/** jQuery.proxy() 이용하는 방법
					 * $(".clickay").click($.proxy(this.wasClicked,this));
					 **/
				}
			}
			
			clicky2.addListeners();
			
			</script>
		</pre>
	</section>
	
	
	<section>
		<a href="#" class="app">.app</a>
		<pre class="brush: javascript;">
			apply() 활용의 다른 예제
			<script type="text/javascript">
			var App = {
				log:function(){
					if( typeof console == "undefined") return ;
					
					/**
					 * arguments는 호출이 일어난 현재 범위와 인자 배열을
					 * 포함하는 변수로 인터프린터가 arguments의 값을 설정한다.
					 * 
					 * jQuery.makeArray()로 변환 후 사용
					 **/
					var args = jQuery.makeArray(arguments);
					args.unshift("(App)");
					console.log.apply(console, args);
				}
			}
			
			$(".app").click(function(){
				App.log( 'test' , 'test2') ;// print (App) test test2
				console.log( 'test' , 'test2') ;// print test test2 
			});
			
			</script>
		</pre>
	</section>
</article>
