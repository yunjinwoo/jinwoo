
<h4>1-3-3.<?php echo getSubTitle() ; ?></h4>

<article>
	<section class="well well-sm">
		<p>모델과 뷰사이의 접착제</p>
		<p>뷰에서 이벤트와 입력을 수신해 모델을 통해 처리하고 뷰를 갱신해 결과를 반영</p>
		<p>페이지를 로드할때 폼 제출이나 버튼 클릭등을 검출하는 이벤트 리스너를 추가한다</p>
	</section>
	
	<section>
		<pre class="brush: javascript;">
			var Controller = {}
			(Controller.users = function($){
				alert('eee');
				var nameClick = function(){
					/* ... */alert('test');
				};
				
				$(function(){
					$(".well").click(nameClick);
				});
			})(jQuery);
			/***
			 * users 컨트롤러를 만들어서 Controller변수에 명칭공간 추가했다
			 * 익명한수로 범위를 캡슐화해서 전역 변수 생성을 막았다
			 * 엘리먼트에 클릭 이벤트 추가
			 ***/
			
			// 책에 있듯이 위처럼하면 오류 users 를 못찾는다고 나온다			
			Controller.users = function($){
				var nameClick = function(){
					/* ... */alert('test');
				};
				
				$(function(){
					$(".well").click(nameClick);
				});
			};			
			Controller.users(jQuery);
		</pre>
	</section>
</article>
