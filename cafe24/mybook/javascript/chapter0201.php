
<h4>2-1.<?php echo getSubTitle() ; ?></h4>

<article>
	<section class="well well-sm">
		addEventListener()는 이벤트의 핵심 함수로 세가지 매개변수인 type(onclick,onkeyup...),
		listener(콜백같은), useCapture를 포함한다 이중 type과 listener 두 매개변수로
		DOM 엘리먼트에 함수를 연결할 수 있다.
	</section>
	
	<section>
		<button id="createButton">createButton</button>
		<pre class="brush: javascript;">
			<script type="text/javascript">
				var button = document.getElementById("createButton");
				button.addEventListener('click',function(){
					console.log('click');
				}, false);
				/**
				 * addEventListener()를 호출할 때 넘겨준 매개변수를 
				 * removeEventLister()를 이용해서 삭제할 수 있다
				 * 리스너함수를 익명함수로 정의하면서 레퍼런스를
				 * 보존하지 않았다면 엘리먼트 자체를 삭제하지 않고는
				 * 등록한 리스너를 삭제할 수 없다.
				 **/
				
				var over = function(){
					this.style.backgroundColor = "#dadada";
				};
				button.addEventListener('mouseover',over,false);
				var out = function(){
					this.style.backgroundColor = "#ffffff";
				};
				button.addEventListener('mouseout',out,false);
				
				
				button.addEventListener('click',function(){
					console.log('click-removeEventListener');
					button.removeEventListener('mouseover',over,false);
				}, false);
				
			</script>
		</pre>
	</section>
	
	<section class="well well-sm">
		<div class="panel-body">
			<p>리스너 함수는 첫 번째 인자로 이벤트 관련 정보(시간,좌표,대상 등)를 포함하는
				event오브젝트를 전달하다. event오브젝트는 이벤트 전파<sub>Propagation</sub>중지,
				기본 동작 실행 방지등의 기능을 포함해 다양한 함수를 제공한다.</p>
			
			<strong>최근 브라우저가 지원하는 이벤트</strong>
			<ul>
				<li>click</li>
				<li>dblclick</li>
				<li>mousemove</li>
				<li>mouseover</li>
				<li>mouseout</li>
				<li>focus</li>
				<li>blur</li>
				<li>change</li>
				<li>submit</li>
			</ul>
			
			<strong>전체 이벤트 호환 테이블 쿼드모드<sub>Quirksmode</sub></strong>
			<a href="http://www.quirksmode.org/dom/events/index.html">http://www.quirksmode.org/dom/events/index.html</a>
		</div>	
	</section>
</article>
