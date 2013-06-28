

<h3>7.<?php echo getSubTitle() ; ?> : 차례대로 처리되도록 하는 큐</h3>

<div style="float:left;width:700px;">
	<div style="float:right;width:680px;">
		<ul>
			<li><h3>큐(queue) - FIFO (First-In-First-Out) or LIFO (Last-In-First-Out) </h3>
<a href="http://www.joinc.co.kr/modules/moniwiki/wiki.php/Site/Database/DataStructure/Queue" target="_blank">[참고용 페이지]</a>
			
			<ol>
				<li>
					<dl>
						<dt>데이타 삽입
						<dd>
							rear 1 => 데이타 삽입 후 rear 2
							
							<table border=2 bordercolor="#990000">
							<tr>
								<td>10</td>
								<td>20</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>

							<tr>
								<td>front 1</td>
								<td>&nbsp;</td>
								<td>rear 3</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							</table>
					</dl>
				<li>
					<dl>
						<dt>데이타 삭제
						<dd>
							front 1 => 데이타 삭제 후 front 2
							
							<table border=2 bordercolor="#990000">
							<tr>
								<td></td>
								<td>20</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>

							<tr>
								<td>&nbsp;</td>
								<td>front 2</td>
								<td>rear 3</td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
							</tr>
							</table>
					</dl>
			</ol>
			<li>
				<dl>
					<dt>원형큐(circular queue) <a href="http://blog.daum.net/7icdi7/28" target="_blank">[참고용]</a>
					<dd>데이타를 옮겨야 전체 공간을 사용할수있기에 원형큐라는것이 생김
				</dl>
		</ul>		
	</div>	
</div>