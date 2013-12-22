
<h4>1-3-2.<?php echo getSubTitle() ; ?></h4>

<article>
	<section class="well well-sm">
		<p>애플리케이션의 다른 부분과 분리되어야 한다.</p>
		<p>표현 로직 사용</p>
	</section>
	
	
	<section>
		<pre class="brush: css;html-script: true; ">
			// template.html
			<div>
				<script type="text/javascript">
					function formatDate(date){
						/** ... **/
					}
				</script>
				${ formatDate(this.date) }
			</div>
		</pre>
		아래와 같이 분리해서 뷰를 작성
		<pre class="brush: javascript;">
			// helper.js
			var helper = {}
			helper.formatDate = function(date){
				/** ... **/
			}
		</pre>
		<pre class="brush: css;html-script: true;">
			// template.html
			<div>
				${ helper.formatDate(this.date) }
			</div>
		</pre>
	</section>
</article>
