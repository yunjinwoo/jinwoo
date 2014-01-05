
<h4>2-3.<?php echo getSubTitle() ; ?></h4>

<article>
	<section class="well well-sm">
		event오브젝트의 stopPropagation() 함수로 이벤트 버블링을 중단할 수 있다.
		
		<div id="createButton_area">createButton_area
			<button id="createButton">createButton</button>
		</div>
		<pre class="brush: javascript;">
			<script type="text/javascript">
				var area = document.getElementById("createButton_area");
				var button = document.getElementById("createButton");
				
				area.addEventListener('click',function(e){
					console.log('area - click');
				}, false);
				button.addEventListener('click',function(e){
					e.stopPropagation()
					console.log('button - click');
				}, false);
				
				
				/* 기본적으로 버블링을 사용한다
				 * 명시적으로 true 사용하면 버블링을 사용하지 않는다 */
			</script>
		</pre>
	</section>
	
	
	<section class="well well-sm">
		jQuery 같은 일부 라이브러리는 아예 아무 핸들러도 실행되지 않도록 
		심지어 같은 엘리먼트의 이벤트 핸들러도 실행되지 않게 하는 
		<a href="http://api.jquery.com/event.stopImmediatePropagation/">stopImmediatePropagation()</a>
		함수를 제공한다.
	</section>
	
	
	<section>
		<form action="" method="get" id="frm">
			<input type="text" name="test" value="<?=time()?>"/>
			<input type="text" name="action" value="0203"/>
			<input type="submit" />
		</form>
		<a href="#return" id="return">href="#return"</a>
		<a href="#preventDefault" id="preventDefault">href="#preventDefault"</a>
		
		<pre class="brush: javascript;">
			<script type="text/javascript">
				/**
				 * 이벤트 처리과정에서 기본 동작을 취소할수있다.
				 * 1.  return false  <== 이건 addEventListener 에서는 안되네;;
				 * 2.  이벤트 오브젝트에 preventDefault()
				 **/
				
				var sub = document.getElementById("frm");
//				sub.addEventListener('submit',function(){
//					return confirm('submit');
//				}, false);
				sub.onsubmit = function(){
					return confirm('submit');
				}
				
				var ret = document.getElementById("return");
				ret.addEventListener('click',function(){
					return confirm('test');
				}, false);
				var ped = document.getElementById("preventDefault");
				ped.addEventListener('click',function(e){
					e.preventDefault();
				}, false);
				
			</script>
		</pre>
	</section>
</article>
