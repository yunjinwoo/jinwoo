

<h3>17.<?php echo getSubTitle() ; ?> : 수들의 규칙성을 찾아내 문제 해결하기</h3>

<div style="float:left;width:700px;">
	<div style="float:right;width:680px;">
		<ul>
			<li>등차수열 <a href="http://ko.wikipedia.org/wiki/%EB%93%B1%EC%B0%A8%EC%88%98%EC%97%B4" target="_blank">[참고]</a>
				<dl>
					<dt>1787년 가우스(Gauss) 가 초등학교때 일
					<dd>
						<ul>
							<li>1 + 2 + 3 + 4 .... + 99 + 100
							<li>
								1   + 2 +  .... + 99 + 100 <br />
								100 + 99 + .... + 2 + 1 <br />
								101 + 101 + .... + 101 + 101 
							<li>1/2*100*101=5050
							<li>1/2*n(n+1)
						</ul>
				</dl>
			<li>등비수열 <a href="http://ko.wikipedia.org/wiki/%EB%93%B1%EB%B9%84%EC%88%98%EC%97%B4" target="_blank">[참고]</a> 
				<dl>
					<dt>갓 태어난 한쌍의 토끼가 있다 한쌍의 토끼는 두달째 부터 한쌍의 토끼를 낳는다 1년 후에 토끼는 몇쌍?
					<dd>
						현재 태어난 토끼는 = 낳는 토끼 + 못낳는 토끼 <br />
						1 개월 쨰는 토끼 한쌍 <br />
						2 개월 쨰는 토끼 두쌍 <br />
						3 개월 쨰는 토끼 세쌍 <br />
						4 개월 쨰는 토끼 오쌍 <br />
						<hr />
<?php
$s = '
	<script type="text/javascript">
	<!--
		// a = 어른 토끼
		// b = 전체 토끼
		// c = 새끼 토끼
		var a = b = c = 0 ;
		
		c = 1 ;
		for( i = 1 ; i < 20 ; i++ )
		{
			b = a + c ;
			document.write( i + "달" + b + "<br />" ) ;
			c = a ;
			a = b ;
		}
	//-->
	</script>
';
echo $s ;
?>

<xmp>
       |
       | : |
      || : |
     ||| : ||
   ||||| : |||
|||||||| : |||||
<?php echo $s?>
</xmp>

<br /><hr /><br />

<?


$s22 = '
	<script type="text/javascript">
	<!--
		function f( n )
		{
			if( isNaN(n) )
			{
				alert( "error" ) ;
				return 0 ;
			}

			if( n <= 2 )
				return 1 ;
			
			return f(n-2) + f(n-1) ;
		}
		for( i = 1 ; i < 20 ; i++ )
		{
			document.write( i + " 달" + f(i) + "<br />" ) ;
		}
	//-->
	</script>
';

echo $s22 ;
?>
<xmp>
<?php echo $s22?>
</xmp>

				</dl>
		</ul>		
	</div>	
</div>