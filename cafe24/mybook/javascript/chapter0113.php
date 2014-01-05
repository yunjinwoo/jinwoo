
<h4>1-10.<?php echo getSubTitle() ; ?></h4>

<article>
	<?php JsDefault::char01_class();?>
	<section class="well well-sm">
		프록시 함수는 예제로 만든 클래스 라이브러리에 적용할 수 있는 유용한패턴
		
	</section>
	
	
	<section>
		<pre class="brush: javascript;">
			// 프록시 함수 추가 부분
			klass.proxy = function(func){
				var self = this;
				return (function(){
					return func.apply(self, arguments);
				});
			}
			klass.fn.proxy = klass.proxy;
		</pre>
	</section>
		
	<section>
		<button class="button">.button</button>
		<button class="button2">.button2</button>
		<pre class="brush: javascript;">			
			<script type="text/javascript">
			var Button = new Class;
			Button.include({
				init:function(element){
					this.element = jQuery(element);
					//this.element.click(this.click);
					this.element.click(this.proxy(this.click));
				},
				click:function(){
					console.log('button click');
					console.log(this);
					/**
					 * console.log(this);
					 * this.element.click(this.click); 일때
					 *    a href
					 * this.element.click(this.proxy(this.click)); 일때
					 *    klass
					 **/
				}
			});
			var btn = new Button(".button");
			var btn2 = new Button(".button2");
			
			/**
			 * click()를 proxy() 로 감싸지 않으면 Button이 아닌 
			 * this.element 컨텍스트에서 click()함수가 호출되면서 문제가 발생
			 * */
			</script>
		</pre>
	</section>
	
	
	<section>
		<button class="button_bind">.button_bind</button>
		<pre class="brush: javascript;">			
			<script type="text/javascript">
			var Button = new Class;
			Button.include({
				init:function(element){
					this.element = jQuery(element);
					this.element.click(this.click.bind(this));
				},
				click:function(){
					console.log('button click');
					console.log(this);
				}
			});
			var btn = new Button(".button_bind");
			
			/**
			 * ECMA스크립트 5번째 개정판 (ES5)
			 * http://en.wikipedia.org/wiki/ECMAScript#ECMAScript.2C_5thEdition
			 * bind() 함수로 호출 범위를 지정하는 기능을 추가했다
			 * 
			 * 구형 브라우저 중 지원이 안되는것도 있으나 구현이 가능하다
			 * */
			if( !Function.prototype.bind ){
				Function.prototype.bind = function(obj){
					var slice	= [].slice,
						args	= slice.call(arguments,1),
						self	= this,
						nop		= function(){},
						bound	= function(){
							return self.apply(
									this instanceof nop ? this : (obj || {} ),
									args.concat( slice.call(arguments) ) 
								);							
						};
					
					nop.prototype	= self.prototype;
					bound.prototype	= new nop();
					return bound;
				};
			}
			</script>
		</pre>
		<div class="well well-sm">
			<p>심<sub>Shim</sub>은 기존 브라우저에 호환성을 제공하는 층<sub>Layer</sub>을 만든다</p>
			<p>es-shim 프로젝트는 기존의 자비스크립트 엔진이<br /> ECMA스크립트 5와 호환되도록 층을 제공한다.</p>
			<a href="https://github.com/kriskowal/es5-shim">https://github.com/kriskowal/es5-shim</a>
		</div>
	</section>
</article>
