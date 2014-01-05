
<h4>2-7.<?php echo getSubTitle() ; ?></h4>

<article>
	<section class="well well-sm">
		이벤트 버블링 방식은 일반적으로 자식의 이벤트를 검사할 수 있도록
		부모에 리스너를 추가한다.
		<a href="http://www.sproutcore.com">스프라우트코어<sub>SproutCore</sub></a>같은
		프레임워크도 부모에 리스너를 추가하는 방식으로 애플리케이션에서
		사용하는 이벤트 리스너 수를 줄인다.(성능개선)
		
		<pre class="brush: javascript;">
			list.addEventListener("click",function(e){
				if(e.currentTarget.tagName=="li"){
					/* ... */
					return false;
				}
			},false);
		</pre>
	</section>
	
	
	<section class="well well-sm">
		jQuery는 delegate() 함수를 사용한다.
		
		<pre class="brush: javascript;">
			<script type="text/javascript">
				//모든 li 에 리스너 추가(고비용)
				$("ul li").click(function(){});
				
				//ul에 리스너를 추가하여 li 일때 반응한다.
				$("ul").delegate('click','li',function(){});
				/**
				 * 위 코드는 비용면에서도 좋고 
				 * li를 삭제 추가 할때도
				 * 첫번째는 추가된 li 에 리스터를 등록을 시켜줘야 하지만
				 * 두전째는 리스너를 새로 등록하지 않아도 동작한다
				 **/
			</script>
		</pre>
	</section>
</article>
