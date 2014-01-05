
<h4>2-4.<?php echo getSubTitle() ; ?></h4>

<script type="text/javascript">
$(function(){$("article > section:first > p").addClass("m0 mt10");});
$(function(){$("span.label").addClass("label-default");});
</script>
<article>
	<section class="well well-sm">
		event오브젝트는 stopPropagation(), preventDefault() <br />
		함수 이외에	여러 유용한 프로퍼티를 제공한다.
		
		<p>이벤트 타입</p>
		<ul>
			<li><span class="label">Bubbles</span> 
				DOM에서 이벤트 버블 방식을 사용하지를 지정하는 boolean 값
			</li>
		</ul>
		
		<p>이벤트가 실행되었을 때 환경을 반영하는 프로퍼티</p>
		<ul>
			<li><span class="label">Button</span> 
				어떤 마우스 버튼이 눌렸는지 가리키는 값</li>
			<li><span class="label">ctrlKey</span>
				<span class="label label-primary">ctrl</span> 키가 눌렸는지 가리키는 boolean 값</li>
			<li><span class="label">altKey</span>
				<span class="label label-primary">alt</span> 키가 눌렸는지 가리키는 boolean 값</li>
			<li><span class="label">shiftKey</span>
				<span class="label label-primary">shift</span> 키가 눌렸는지 가리키는 boolean 값</li>
			<li><span class="label">metaKey</span>
				메타키<sub>ctrl,alt 함께 눌렸을 때 다른 기능을 하는키</sub><br />
				키가 눌렸는지 가리키는 boolean 값</li>
		</ul>
		
		<p>키보드 이벤트 와 관련된 프로퍼티</p>
		<ul>
			<li><span class="label">isChar</span> 
				이벤트가 키 문자를 포함하는지 여부를 가리키는 boolean값
			</li>
			<li><span class="label">charCode</span> 
				눌려진 키의 유니코드 값(keypress 이벤트 전용)
			</li>
			<li><span class="label">keyCode</span> 
				비문자 키의 유니코드 값
			</li>
			<li><span class="label">which</span> 
				문자인지 여부와 관계없이 눌린 키의 유니코드 값
			</li>
		</ul>
		
		<p>이벤트 발생 위치 엘리먼트</p>
		<ul>
			<li><span class="label">pageX,pageY</span>
				페이지(예를 들어 뷰포트) 상의(페이지에 상대적인) 이벤트 좌표
			</li>
			<li><span class="label">screenX,screenY</span>
				화면상의 이벤트 좌표
			</li>
		</ul>
		
		<p>키보드 이벤트 와 관련된 프로퍼티</p>
		<ul>
			<li><span class="label">currentTarget</span>
				이벤트 버블링 과정에서 현재 처리 중인 DOM 엘리먼트
			</li>
			<li><span class="label">target, originalTarget</span>
				원래의 DOM 엘리먼트
			</li>
			<li><span class="label">relatedTarget</span>
				이벤트와 관련된 다른 DOM엘리먼트
			</li>
		</ul>
		
		<p>브라우저 마다 속성값이 다르므로
		특히 W3C와 호환하지 않는 브라우저라면 더욱 그렇다
		다행히 jQuery, prototype 같은 라이브러리를 이용해
		호환성 문제를 극복할 수 있다.
		</p>
	</section>
</article>
