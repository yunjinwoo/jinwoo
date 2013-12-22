
<h4>1-5.<?php echo getSubTitle() ; ?></h4>

<article>
	<section>
		<pre class="brush: javascript;">
			<script type="text/javascript">
			var Person = function(){}
			
			// 오브젝트에 프로퍼티를 추가하는 방법으로 클래스에 함수를 추가
			Person.find = function(id){ /* ... */ };
			var person = Person.find(1);
			
			// 인스턴스 함수를 생성자 함수에 추가하려면 
			// 생성자의 prototype이 필요하다
			Person.prototype.breath = function(){};
			var person = new Person;
			person.breath();
			
			//일반적으로 prototype을 fn 이라는 별칭 사용
			Person.fn = Person.prototype;
			Person.fn.run = function(){};
			</script>
		</pre>
	</section>
</article>
