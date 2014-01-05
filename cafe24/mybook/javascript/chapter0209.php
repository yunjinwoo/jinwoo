
<h4>2-9.<?php echo getSubTitle() ; ?></h4>

<article>
	<section class="well well-sm">
		DOM과 상호작용하는 로직의 아키텍처를 만들 때 커스텀 이벤트
		애플리케이션에 기능을 추가할 때에는 기능을 추상화할 수 있는지,
		플러그인으로 분리할 수 있는지 고려해야 한다.
	</section>
	
	<section class="well well-sm">
		
		<pre class="brush: javascript;">
			<script type="text/javascript">
				jQuery.fn.tabs = function(control){
					var element = $(this);
					control = $(control);
					
					element.find("li").bind("click",function(e){
						element.find("li").removeClass("active");
						$(this).addClass("active");
						
						var tabName = $(this).attr("data-tab");
						control.find(">[data-tab]").removeClass("active");
						control.find(">[data-tab=['"+tabName+"']").addClass("active");
					});
					
					element.find("li:first").addClass("active");
					
					// 연쇄반응 (chaining)
					return this;
				};
				
				$("ul#tab").tabs("#tabContent");
				/**
				 * 위 코드는 클릭 이벤트가 모든 리스트 추가되어 있다
				 * delegate() 를 이용해야 한다.
				 * 클릭 핸들러의 규모가 커서 내부에서 
				 * 어떤 일이 발생하는지 파악하기 어렵다.
				 **/
				
				jQuery.fn.tabs = function(control){
					var element = $(this);
					control = $(control);
					
					element.delegate("li", "click", function(e){
						var tabName = $(this).attr("data-tab");
						
						element.trigger("tab.change", tabName);
					});
					
					// li 탭
					element.bind("tab.change",function(e,tabName){
						element.find("li").removeClass("active");
						element.find(">[data-tab=['"+tabName+"']").addClass("active");
					});
					
					// div 탭 내용
					element.bind("tab.change",function(e,tabName){
						control.find(">[data-tab]").removeClass("active");
						control.find(">[data-tab=['"+tabName+"']").addClass("active");
					});
					
					var firstName = element.find("li:first").attr("data-tab");
					element.trigger("tab.change", firstName);
					
					return this;
				};
				/**
				 * 위 방식을 이용하면
				 * 탭 변경 핸들러를 분리할 수 있고 플러그인을 확장할 수 있다
				 **/				
				$("#tabs").trigger("tab.change", "users");
				/**
				 * 또는 아래와 같이 확장 가능하다
				 * hashchange 
				 **/ 
				$("#tabs").bind("tab.change", function(e, tabName){
					window.location.hash = tabName;
				});
				$(window).bind("hashchange", function(){
					var tabName = window.location.hash.slice(1);
					$("#tabs").trigger("change.tabs",tabName);
				});
				
			</script>
		</pre>
	</section>
</article>
