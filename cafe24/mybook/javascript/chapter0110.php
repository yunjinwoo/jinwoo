
<h4>1-7.<?php echo getSubTitle() ; ?></h4>

<article>
	<section class="well well-sm">
		<p>새 오브젝트의 초기 프로퍼티를 얻을 때 템플릿으로 사용할 수 있는
		오브젝트인 프로토타입의 오브젝트<sub>Prototypical Object</sub> 제공</p>
		<p>모든 오브젝트는 다른 오브젝트의 프로토타입이 되어
			자신의 프로퍼티를 공유할 수 있다. 상속과 흡사하다</p>
		<p>로컬 오브젝트에서 프로퍼티를 찾지 못하면 Object.prototype 까지 도달하고
		찾지 못하면 undefined 를 반환한다.</p>
		
	</section>
	
	<section>
		<pre class="brush: javascript;">
			<script type="text/javascript">
			/**
			 * 클래스와 클래스의 프로퍼티를 상속받으려면 생성자 함수를 먼저 정의해야 한다.
			 * 그 다음 부모의 새 인스턴스를 생서 함수의 프로토 타입으로 설정한다.
			 **/
			var Animal = function(){};			
			Animal.prototype.breath = function(){
				console.log('breath');
			};
			
			var Dog = function(){};
			//Dog는 Animal을 상속한다.
			Dog.prototype = new Animal();
			Dog.prototype.wag = function(){
				console.log('wag');
			}
			
			var dog = new Dog;
			dog.wag();
			dog.breath(); // 상속받은 프로퍼티
		
			</script>
		</pre>
	</section>
</article>

