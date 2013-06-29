

<h3>6.<?php echo getSubTitle() ; ?> : 함수 호출할 때 사용되는 스택</h3>

<div style="float:left;width:700px;">
	<div style="float:right;width:680px;">
		<ul>
			<li><h3>스택(stack) - FILO (First-In-Last-Out) or LIFO (Last-In-First-Out) </h3>
<a href="http://www.joinc.co.kr/modules/moniwiki/wiki.php/Site/Database/DataStructure/Stack" target="_blank">[참고용 페이지]</a>
			
				
				<dl>
					<dt><h4>(4+3)*(5-2) 연산</h4>
					<dd>
						1.역폴란드식 표기법 변환 => 43+52-*
						<table>
						<tr>
							<td>
								<table border=2 bordercolor="#990000">
								<caption><b>2.4를 스택에 삽입</b></caption>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>4</td>
								</tr>
								</table>
							</td>
							<td>
								<table border=2 bordercolor="#990000">
								<caption><b>3.3를 스택에 삽입</b></caption>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>3</td>
								</tr>
								<tr>
									<td>4</td>
								</tr>
								</table>
							</td>
							<td>
								<table border=2 bordercolor="#990000">
								<caption><b>4. 삽입된 두수를 + 연산후 다시 삽입</b></caption>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>7</td>
								</tr>
								</table>
							</td>
							<td>
								<table border=2 bordercolor="#990000">
								<caption><b>5. 5를 스택에 삽입</b></caption>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>5</td>
								</tr>
								<tr>
									<td>7</td>
								</tr>
								</table>
							</td>
							<td>
								<table border=2 bordercolor="#990000">
								<caption><b>6. 2를 스택에 삽입</b></caption>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>2</td>
								</tr>
								<tr>
									<td>5</td>
								</tr>
								<tr>
									<td>7</td>
								</tr>
								</table>
							</td>
							<td>
								<table border=2 bordercolor="#990000">
								<caption><b>7.삽입된 두수(2, 5)를 - 연산후 다시 삽입 </b></caption>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>3</td>
								</tr>
								<tr>
									<td>7</td>
								</tr>
								</table>
							</td>
							<td>
								<table border=2 bordercolor="#990000">
								<caption><b>8.삽입된 두수(3, 7)를 * 연산후 다시 삽입 </b></caption>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>21</td>
								</tr>
								</table>
							</td>
							
						</tr>
						</table>
				</dl>
		</ul>		
	</div>	
</div>43+52-*