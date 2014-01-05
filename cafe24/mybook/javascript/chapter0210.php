
<h4>2-10.<?php echo getSubTitle() ; ?></h4>

<article>
	<section class="well well-sm">
		이벤트 기반 프로그래밍은 애플리케이션 구조를 비결합화할 수 있어 강력하다.
		애플리케이션 구조를 비결합화하면 스스로 독립성을 갖추며 유지보수하기도 쉬워진다.
		
	</section>
	
	<section class="well well-sm">
		<h5>발행자/구독자<sub><a href="http://en.wikipedia.org/wiki/Publish/subscribe">Publish/Subscribe</a></sub> 패턴</h5>
		<p>발행자가 특정 채널로 메시지를 발행하면 구독자는 발행했다는 알림을 수신한다.
		여기서 핵심은 발행자와 구독자가 서로 완전히 비결합 상태라는 점이다.</p>
		<p>발행자와 구독자의 비결합 특성을 적용하면 상호연관성과 결합성을 만들지 않으면서 애플리케이션을 확장할 수 있다.</p>
		<pre class="brush: javascript;">
			<script type="text/javascript">
				//PubSub 예제
				var PubSub = {
					subscribe:function(ev,callback){
						// _callbacks 오브젝트가 없으면 새로 만든다.
						var calls = this._callbacks || (this._callbacks = {});
						//이벤트 키에 해당하는 배열이 없으면 
						//배열을 만든 다음 콜백을 배열에 추가한다.
						(this._callbacks[ev] || (this._callbacks[ev] = [])).push(callback);
						return this;
					},
					
					publish:function(){
						// arguments 오브젝트를 진짜 배열로 바꾼다
						var args = Array.prototype.slice.call(arguments, 0);
						// 이벤트 이름을 포함하는 첫 번째 인자를 추출한다.
						var ev = args.shift();
						//_callbacks 오브젝트가 없거나 
						//해당 이벤트의 배열을 포함하지 않으면 반환한다.
						var list, calls, i, l;
						if(!(calls = this._callbacks)) return this;
						if(!(list = this._callbacks[ev])) return this;
						
						//콜백을 호출한다.
						for( i=0,l=list.length; i < l ; i++ )
							list[i].apply(this, args);
						
						return this;
					}
				}
				
				//사용 예제
				PubSub.subscribe("wem",function(){
					console.log("Wem!");
				});
				
				PubSub.publish("wem");
				
				// 콜론(:) 같은 분리자를 이용해 이벤트 명칭공간을 만들 수 있다.
				PubSub.subscribe("wem:sub",function(){
					console.log("wem:sub");
				});
			</script>
		</pre>
	</section>
	
	
	<section class="well well-sm">
		jQuery를 이용한 애플리케이션은 벤 알만
		<sub><a href="http://benalman.com">Ben Alman</a></sub>
		이 제공하는 <a href="http://me2.do/FRP0isW">라이브러리</a>로 쉽게 작업할 수 있다.
		<pre class="brush: javascript;">
			<script type="text/javascript">
				/*!
				* jQuery Tiny Pub/Sub - v0.3 - 11/4/2010
				* http://benalman.com/
				* 
				* Copyright (c) 2010 "Cowboy" Ben Alman
				* Dual licensed under the MIT and GPL licenses.
				* http://benalman.com/about/license/
				*/

			   (function($){

				 var o = $({});

				 $.subscribe = function() {
				   o.bind.apply( o, arguments );
				 };

				 $.unsubscribe = function() {
				   o.unbind.apply( o, arguments );
				 };

				 $.publish = function() {
				   o.trigger.apply( o, arguments );
				 };

			   })(jQuery);
			   
			   $.subscribe("/some/topic",function(event,a,b,c){
				   console.log(event.type, a +":"+ b +":"+ c);
				   // 잘 안되네;; 신버전도 그렇고;;
			   });
			   $.publish("/some/topic", "123", "421","444");
			</script>
		</pre>
		
		<pre class="brush: javascript;">
			<script type="text/javascript">
			   var Asset = {};
			   //PubSub 추가
			   jQuery.extend(Asset, PubSub);
			   //이제 publish/subscribe 함수를 사용할 수 있다.
			   Asset.subscribe("create", function(){
				   console.log("create");
			   });
			   Asset.publish("create");
			   
			   /**
				* jQuery의 extend() 함수를 이용해 PubSub의 
				* 프로퍼티를 Asset오브젝트를 복사할 수 있다.
				* 
				* publish()와 subscribe() 호출을 Asset범위로 한정할 수 있다.
				* 오브젝트 관계 매핑(ORM)의 이벤트, 
				* 상태 머신 변화, 
				* Ajax요청이 끝났을 때 
				* 발생하는 콜백등의 상황에서 이 기법을 유용하게 활용할 수 있다.
				**/
			</script>
		</pre>
	</section>
</article>
