
<h4>2-5.<?php echo getSubTitle() ; ?></h4>

<article>
	<section class="well well-sm">
		jQuery를 이용한 이벤트 관리
		
		<pre class="brush: javascript;">
			jQuery("#element").bind(eventName, handler);
			jQuery("#element").bind("click", handler);
			jQuery("#element").click(handler); // 단축형 submit,mouseover ...
			
			jQuery(window).bind("load", function(){
				/* window load */
			});
		</pre>
		
		<p>
		윈도우의 load를 기다리는것보다
		DOMContentLoaded 를 기다리는 것이 더 실용적이다
		DOM이 준비된 다음 페이지의 이미지와 스타일 시트<sub>Stylesheet</sub>를 내려받는다.
		</p>
		<p>
		DOMContentLoaded는 페이지의 이미지와 스타일시트를 내려받기 전에 실행된다
		즉 사용자가 페이지와 상호작용을 하기 전에 항상 DOMContentLoaded가 먼저 실행된다.		
		</p>
		
		<p>
		모든 브라우저가 지원하지 않기에 jquey는 ready()함수로 기능을 추상화했다.
		</p>
		<pre class="brush: javascript;">
			jQuery.ready(function(){
				/* DOMContentLoaded */
			});
			//ready 를 생략해도 된다.
			jQuery(function(){
				/* DOMContentLoaded */
			});
		</pre>
	</section>
</article>
