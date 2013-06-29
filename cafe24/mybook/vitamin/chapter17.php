

<h3>18.<?php echo getSubTitle() ; ?> : 규칙을 찾아내면 해결되는 하노이 탑</h3>

<div style="float:left;width:700px;">
	<div style="float:right;width:680px;">

	이건 조건의 단순화 인가? <br />
	어떻게 함수로 바로 사용할수있는지 모르겠네.. ㅠㅠ<br />
		<a href="http://oehell.tistory.com/entry/%EC%95%8C%EA%B3%A0%EB%A6%AC%EC%A6%98-%ED%95%98%EB%85%B8%EC%9D%B4%ED%83%91-%EC%95%8C%EA%B3%A0%EB%A6%AC%EC%A6%98-C" target="_blank">[참고페이지]</a>
		<div style="border:1px solid #ff0099; padding:5px; width:500px;">
			고대 인도 베나레스의 한 사원에는 높이 50cm 정도 되는 
			다이아몬드 막대 3개가 있는데, 그 중 한 막대에 64장의 순금으로 된
			원판이 큰 것부터 아래에서 위로 차례로 쌓여 있었다.
			신은 승려들에게 밤낮으로 쉬지 않고 원판을 옮겨 빈 다이아몬드 막대 중
			어느 한 곳으로 모두 옮기도록 명령하였다.
<br />
			"원판은 한 번에 한 개씩만 옮길 수 있고, 작은 원판 위에 큰 원판이
			놓여서는 안 된다. 64개의 원판이 본래의 자리를 떠나 다른 한 막대로
			모두 옮겨졌을 때 너희들은 열반에 들고 세상은 먼자가 되어 사라지게 될 것이다."
		</div>
		<pre>
<blockquote style="margin-top: 14px; margin-right: 0px; margin-bottom: 20px; " class="vview_quote05"><table width="100%" cellspacing="0" cellpadding="0" style="text-align: left; border-collapse: separate; ">
<tbody><tr>
<td height="2" style="font-size: 10pt; background-image: none; background-attachment: scroll; background-origin: initial; background-clip: initial; background-color: transparent; background-position: 0% 0%; background-repeat: repeat repeat; "></td>
<td height="2" style="font-size: 10pt; background-image: none; background-attachment: scroll; background-origin: initial; background-clip: initial; background-color: transparent; background-position: 0% 0%; background-repeat: repeat repeat; "></td>
<td height="2" style="font-size: 10pt; background-image: none; background-attachment: scroll; background-origin: initial; background-clip: initial; background-color: transparent; background-position: 0% 0%; background-repeat: repeat repeat; "></td>
</tr><tr>
<td width="2" style="font-size: 10pt; background-image: none; background-attachment: scroll; background-origin: initial; background-clip: initial; background-color: transparent; background-position: 0% 0%; background-repeat: repeat repeat; "></td>
<td style="font-size: 10pt; padding-right: 10px; padding-left: 9px; padding-bottom: 10px; line-height: 1.4; padding-top: 11px; "><p style="margin-top: 2px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; line-height: 1.5; ">&nbsp;하노이탑 함수 ( 원반의 갯수 , 시작봉 , 목적봉 , 중심봉 )</p>
<p style="margin-top: 2px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; line-height: 1.5; ">{</p>
<p style="margin-top: 2px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; line-height: 1.5; ">&nbsp;&nbsp; if(원반의 갯수==1){</p>
<p style="margin-top: 2px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; line-height: 1.5; ">&nbsp;&nbsp;&nbsp; 장애물 치우기 (&nbsp;시작봉 - &gt;중심봉 )<br>
&nbsp;&nbsp; }</p>
<p style="margin-top: 2px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; line-height: 1.5; ">&nbsp;&nbsp; else{</p>
<p style="margin-top: 2px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; line-height: 1.5; ">&nbsp;&nbsp;&nbsp;&nbsp; n-1원반을 시작봉-&gt;중심봉으로 이동을 예정한다.</p>
<p style="margin-top: 2px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; line-height: 1.5; ">&nbsp;&nbsp;&nbsp;&nbsp; n 원반을 시작봉-&gt;목적봉 이동</p>
<p style="margin-top: 2px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; line-height: 1.5; ">&nbsp;&nbsp;&nbsp;&nbsp; n-1원반을 중심봉-&gt;목적봉으로 이동을 예정한다.</p>
<p style="margin-top: 2px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; line-height: 1.5; ">&nbsp;&nbsp; }</p>
<p style="margin-top: 2px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; padding-top: 0px; padding-right: 0px; padding-bottom: 0px; padding-left: 0px; line-height: 1.5; ">}</p>
</td><td width="2" style="font-size: 10pt; background-image: none; background-attachment: scroll; background-origin: initial; background-clip: initial; background-color: transparent; background-position: 0% 0%; background-repeat: repeat repeat; "></td>
</tr><tr>
<td height="2" style="font-size: 10pt; background-image: none; background-attachment: scroll; background-origin: initial; background-clip: initial; background-color: transparent; background-position: 0% 0%; background-repeat: repeat repeat; "></td>
<td height="2" style="font-size: 10pt; background-image: none; background-attachment: scroll; background-origin: initial; background-clip: initial; background-color: transparent; background-position: 0% 0%; background-repeat: repeat repeat; "></td>
<td height="2" style="font-size: 10pt; background-image: none; background-attachment: scroll; background-origin: initial; background-clip: initial; background-color: transparent; background-position: 0% 0%; background-repeat: repeat repeat; "></td>
</tr></tbody></table>
<div class="quote_bottom"></div></blockquote>
		</pre>
		<?php
			$num = isset($_GET['num']) && is_numeric($_GET['num']) ? $_GET['num'] : 4 ;
				
			$s = '
				<script type="text/javascript">
				<!--
					// n = 원판 수
					// A,B,C  =  막대 1,2,3
					function hanoi(n,A,B,C)
					{
						document.write( "<h3>"+n+" "+A+" "+B+" "+C+"</h3>" ) ;
						if( n == 1 )
							document.write( "board "+ n + hanoi_view(A,C) + " move "+ A + "->" + C + "<br />" ) ;
						else{
							// 원판을 왼쪽 에서 중앙으로 옮긴다.
							hanoi(n-1,A,C,B) ;
							document.write( "board "+ n + hanoi_view(A,C) + " move "+ A + "->" + C + "<br />" ) ;
							// 원판을 중앙 에서 오른쪽으로 옮긴다.
							hanoi(n-1,B,A,C) ;
						}
					}

					hanoi('.$num.',"left","center","right") ;

					function hanoi_view( bar_out , bar_in )
					{
						var s = "○○○" ;

						switch( bar_out )
						{
							case "left" :   s = "◎"+s.substring(1,3) ; break;
							case "center" : s = s.substring(0,1)+"◎"+s.substring(2,3) ; ;break;
							case "right" :  s = s.substring(0,2)+"◎" ; break;
						}

						switch( bar_in )
						{
							case "left" :   s = "●"+s.substring(1,3) ; break;
							case "center" : s = s.substring(0,1)+"●"+s.substring(2,3) ; break;
							case "right" :  s = s.substring(0,2)+"●" ; break;
						}

						return s ;
					}
				//-->
				</script>

				<script type="text/javascript">
				<!--
					
					while( i++ )
					{
						if( i >= 50 ) break ;
						
						
					}
				//-->
				</script>
			' ;

			echo $s ;

		?><br />
		hanoi(parseInt(prompt('원판 수?')),'left','center','right');<br />
		<input type="button" value="원판 수" onclick="location.href='?action=17&num='+prompt('원판 수?');">
		<xmp>
			<?php echo $s?>

		</xmp>
기타 방법
<p>
			http://luckydevil.tistory.com/238<br><br>

		제가 하노이탑 횟수 규칙중 한개를 알려드리죠...<br>
2개 일때 횟수 = 3<br>
3개 일때 횟수 = 3+1+3= 7<br>
4개 일때 횟수 = 7+1+7= 15<br>
5개 일때 횟수 = 15+1+15= 31<br>
6개 일때 횟수 = 31+1+31= 63<br>
7개 일때 횟수 = 63+1+63= 127<br>
대충 이런 식입니다...<br>
다른 방법도 많습니다만...</p>
	</div>	
</div>