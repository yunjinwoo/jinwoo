
<h4>1-8.<?php echo getSubTitle() ; ?></h4>

<article>
	<?php JsDefault::char01_class();?>
	<section class="well well-sm">
		클래스 라이브러리에 상속 기능을 추가하자
	</section>
	
	<section>
		<pre class="brush: javascript;">
			//jsDefault::char01_class
			var Class = function(){
				var klass = function(){
					this.init.apply(this, arguments);
				};
				
				// klass의 프로토타입을 바꾼다
				if( parent ){
					var subclass = function(){};
					subclass.prototype = parent.prototype;
					klass.prototype = new subclass;
				}
				
				klass.prototype.init = function(){};

				klass.fn = klass.prototype;
				klass.fn.parent = klass;
				klass._super = klass.__proto__;

				/** include / extend */

				return klass;
			};
			
			/**
			 * Class 의 생성자에 parent를 넘겨주면 
			 * 모든 하위클래스는 같은 프로토타입을 공유한다.
			 * 클래스 프로퍼티를 제외한 인스턴스 프로퍼티만 상속된다.
			 * 
			 * __proto__ 설정방법은 없다
			 **/
		</pre>
	</section>
	
	
	
	<section>
		<pre class="brush: javascript;">
			<script type="text/javascript">
			var Animal = new Class;
			Animal.include({
				breath:function(){
					console.log("parent breath");
				}
			});
			var Cat = new Class(Animal);
			
			var cat = new Cat;
			cat.breath();
			</script>
		</pre>
	</section>
	
</article>
