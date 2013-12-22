
<h4>1-6.<?php echo getSubTitle() ; ?></h4>

<article>
	<?php JsDefault::char01_class();?>
	<section>
		<pre class="brush: javascript;">
			<script type="text/javascript">
			var Person = new Class;
			
			// 클래스에 직접 추가한 정적 함수
			Person.find = function(id){ /* ... */ };
			var person = Person.find(1);
			</script>
		</pre>
		
		<pre class="brush: javascript;">
			<script type="text/javascript">
			var Person = new Class;
			
			// 프로토타입에 추가한 인스턴스 함수
			Person.prototype.save = function(){};
			
			var person = new Person;
			person.save();
			</script>
		</pre>
	</section>
	

	<section class="well well-sm">
		위 문법들 보다 실용성이 좋게 extend()와 include() 함수를 아래와 같이 만든다
	</section>
	
	<section>
		<pre class="brush: javascript;">
			<script type="text/javascript">
			//jsDefault::char01_class
			var Class = function(){
				var klass = function(){
					this.init.apply(this, arguments);
				};
				klass.prototype.init = function(){};

				//프로토타입의 단축형
				klass.fn = klass.prototype;

				//클래스의 단축형
				klass.fn.parent = klass;

				//클래스 프로퍼티 추가
				klass.extend = function(obj){
					var extended = obj.extended;
					for(var i in obj){
						klass[i] = obj[i];
					}
					if(extended) extended(klass);
				};

				//인스턴스 프로퍼티 추가
				klass.include = function(obj){
					var included = obj.included;
					for(var i in obj){
						klass.fn[i] = obj[i];
					}
					if(included) included(klass);
				};

				return klass;
			};
			</script>
			
			오브젝트를 인자로 받아 클래스를 만드는 extend() 로
			각각의 속성을 클래스로 직접 복사한다.
		</pre>
	</section>
	
	
	
	<section>
		<pre class="brush: javascript;">
			[1.extend]
			<script type="text/javascript">
			var Person = new Class;
			
			Person.extend({
				find : function(id){ console.log("find :: "+id); },
				exists : function(id){ /* ... */ }
			});
			var person = Person.find(1);
			</script>
			

			[2.include]
			<script type="text/javascript">
			var Person = new Class;
			
			Person.include({
				save : function(id){ console.log("save :: "+id); },
				destroy : function(id){ /* ... */ }
			});
			
			var person = new Person;
			person.save();
			</script>
		</pre>
	</section>
	
	<section>
		<pre class="brush: javascript;">
			extended 와 included 의 콜백도 구현
			<script type="text/javascript">
			Person.extend({
				extended : function(klass){ 
					console.log(klass , "가 확장됬다");
				}
			});
			</script>
		</pre>
		
		<pre class="brush: javascript;">
			<script type="text/javascript">
			var ORMModule = {
				jinwoo : function(){
					// 공유함수
				}
			};
			
			var Person = new Class;
			var Asset = new Class;
			Person.include(ORMModule);
			Asset.include(ORMModule);
			
			</script>
		</pre>
	</section>
</article>
