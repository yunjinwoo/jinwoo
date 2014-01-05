
<h4>1-12.<?php echo getSubTitle() ; ?></h4>

<article>
	<section class="well well-sm">
		<p>클래스 라이브러리
			<ul>
				<li>HJS jQuery-class</li>
				<li>스파인<sub>Spine</sub></li>
			</ul>
		</p>
		<p><a href="http://prototypejs.org">Prototype</a></p>
		<p><a href="http://prototypejs.org/learn/class-inheritance">클래스라이브러리</a></p>
		<p><a href="http://ejohn.org/blog/simple-javascript-inheritance">
				jquery개발자 존레식<sub>John Resig</sub>클래스 상속관련</a></p>
	</section>
	
	
	<section>
		<pre class="brush: javascript;">
			// 현제 없음;;
			http://archive.plugins.jquery.com/project/HJS


			var Person = $.Class.create({
				//생성자
				initialize:function(name){
					this.name = name;
				}
			});
			
			
			//상속
			var Student = $.Class.create(Person, {
				price:function(){}
			});
			
			var alex = new Student("알렉스");
			alex.pay();
		</pre>
	</section>
	
	<section>		
		<pre class="brush: javascript;">
			<script type="text/javascript" 
				src="http://maccman.github.com/spine/spine.js"></script>
			<script type="text/javascript">
			// 이것도 없어진듯...
			var Person = Spine.Class.create();
			Person.extend({
				find: function(){}
			});
			Person.include({
				init:function(atts){
					this.attributes = attr || {};
				}
			});
			
			var person = Person.init();
			
			// 예제로 만든 class 와 비슷하다
			</script>
		</pre>
	</section>
	
</article>
