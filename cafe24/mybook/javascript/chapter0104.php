
<h4>1-3-1.<?php echo getSubTitle() ; ?></h4>

<article>
	<section class="well well-sm">
		<p>애플리케이션의 데이터 오브젝트를 저장하는 창고</p>
		<p>뷰나 컨트롤러에 대해서는 신경을 쓸 필요가 없다</p>
		<p>데이타와 직접적으로 관련이 있는 로직만 포함시킨다</p>
		<p>이벤트 처리,뷰 템플릿, 등 모델과 관련이 없는 것들은 제외</p>
	</section>
	
	
	<section>
		<pre class="brush: css;html-script: true; ">
					var user = users['송혜교'];
					destroyUser(user);
		</pre>
		<pre class="brush: css;html-script: true; ">
		<script>
			var user = User.find('송혜교');
			user.destroy();
		</script>

		전역변수를 사용하지 않음
		충돌이 일어날 가능성이 낮음
		</pre>
	</section>
</article>
