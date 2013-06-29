

<h3>15.<?php echo getSubTitle() ; ?> : 기초적인 문제 해결 방법부터 알고 가자</h3>

<div style="float:left;width:700px;">
	<div style="float:right;width:680px;">
		<ul>
			<li>swap 에 대해....
			<li>변수 B의 값을 A로 , 변수 C의 값을 B로 변수 A의 값을 C로 저장하는 js 
				<?php
				$q = '
					<script type="text/javascript">
					<!--
						var a, b, c , tmp1, tmp2, tmp3 ;
						a = "a" ;
						b = "b" ;
						c = "c" ;
						
						tmp1 = a ;
						tmp2 = b ;
						tmp3 = c ;

						b = tmp1 ;
						c = tmp2 ;
						a = tmp3 ;



						var a, b, c , tmp ;
						a = "a" ;
						b = "b" ;
						c = "c" ;
						
						tmp = c ;

						c = b ;
						b = a ;
						a = c ;


						tmp = a ;
						a = c ;
						c = b ;
						b = tmp ;

					//-->
					</script>
				' ;
				?>

				<xmp>
				<?php echo $q ;?>
				</xmp>
		</ul>		
	</div>	
</div>