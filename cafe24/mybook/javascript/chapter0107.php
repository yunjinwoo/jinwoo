
<h4>1-4.<?php echo getSubTitle() ; ?></h4>

<article>
	<section class="well well-sm">
		<h5>자바스크립트는</h5>
		<p>네이티브 클래스 구현을 포함하지 않는 프로토타입<sub>prototype</sub>기반 언어다</p>
		<p>클래스 정의 대신 생성자 함수와 new 키워드를 사용한다.</p>
		<p>new 키워드는 return 문의 동작과 함수의 컨텍스트를 변경한다.</p>
	</section>
	
	<section>
		<pre class="brush: javascript;">
			<script type="text/javascript">
			var Person = function(name){
				this.name = name;
			}			
			// Person을 인스턴스화한다.
			var alice = new Person("송혜교");

			// 인스턴스확인
			assert( alice instanceof Person );
			/***
			 * 생성자 함수의 이름은 카멜 케이스(Camel Cased)가 관례
			 ***/
			
			// 잘못된 사용법
			Person("송혜교");
			/**			
			 * 윈도우(전역) 오브젝트 컨텍스트에서 
			 * 의도치 않는 전역 변수 name을 만들고
			 * 함수는 undefined를 반환한다.
			 ***/
			</script>
		</pre>
	</section>
		
		
	<section class="well well-sm">
		<p>생성자 함수에서 아무것도 반환하지 않으면 기본적으로 현재 컨텍스트를 가리키는 this를 반화</p>
		<p>기본<sub>Primitive</sub>형을 제외한 모든 타입을 반환할 수 있다.</p>
	</section>
	
	<section>
		<pre class="brush: javascript;">
			<script type="text/javascript">
			var Class = function(){
				var klass = function(){
					console.log(this); // klass
					console.log("new klass");
					this.init.apply(this, arguments);
				};
				klass.prototype.init = function(){
					console.log("klass init");
				};
				return klass;
			};
						
			var Person = new Class;
			Person.prototype.init = function(){
				//Person을 인스턴스화할 때 호출된다.
				console.log(this); // klass
				console.log("Person");
			};
			
			//사용방법
			var person = new Person;
			</script>
		</pre>
	</section>
</article>
