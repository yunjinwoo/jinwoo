
<h4>2-2.<?php echo getSubTitle() ; ?></h4>

<article>
	<section class="well well-sm">
		특정 타입의 이벤트를 처리하는 이벤트 핸들러를 엘리먼트와
		엘리먼트의 부모가 동시에 포함하는 상황일때
		넷스케이프와 마이크로소프트는 서로 다른 방식으로 동작한다.
	</section>
	
	
	<section class="well well-sm">
		<ul>
			<li>넷스케이프 4는 가장 상위 부모에서 엘리먼트의 순서로 실행(캡처링)</li>
			<li>마이크로소프트는 엘리먼트에서 부모로 실행(버블링)</li>
		</ul>
		
		W3C는 두가지모두 포함되어 있으며 준수하는 이벤트 순서 모델은
		대상 엘리먼트에 도달할 때까지 이벤트 캡처링을 하다가
		대상 모델에 도달하면 다시 버블링을 시작
	</section>
	
	<section>
		<div id="createButton_area">createButton_area
			<button id="createButton">createButton</button>
		</div>
		<pre class="brush: javascript;">
			<script type="text/javascript">
				var area = document.getElementById("createButton_area");
				var button = document.getElementById("createButton");
				// 마지막 인자 false 는 버블링 이벤트 핸들러 방식을
				// 사용한다는 의미이다
				area.addEventListener('click',function(){
					console.log('area - click');
				}, false);
				button.addEventListener('click',function(){
					console.log('button - click');
				}, false);
				
				area.addEventListener('mouseover',function(){
					console.log('area - mouseover');
				}, true);
				button.addEventListener('mouseover',function(){
					console.log('button- mouseover');
				}, true);
				
				/* 기본적으로 버블링을 사용한다
				 * 명시적으로 true 사용하면 버블링을 사용하지 않는다 */
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
