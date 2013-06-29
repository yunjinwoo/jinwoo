

<h3>24.<?php echo getSubTitle() ; ?> : 너무크다 줄이자</h3>

<div style="float:left;width:700px;">
	<div style="float:right;width:680px;">
	
		<ul>
			<li>런 렝스 코딩(run length coding) : 그림에 적합하다.
				<dl>
					<dt>AAAAAAABBCCCDEEEEFFFFFFG 인경우
					<dd>'문자*반복횟수' 하면 A7B2C3D1E4F6G1으로 된다

					<dt>문자와 숫가로 이루어진 경우
					<dd>'문자*탈출문자*반복횟수' 으로하여 
					<dd>A*7B*2C*3D*1E*4F*6G*1으로 표현된다.

				</dl>
				<ul>
					<li>
					<li>
						<dl>
							<dt>데이터 끝에 패리티 비트를 추가하여 1의 개수가 짝수가 되게하는 방법
							<dd>짝수개의 비트에 오류가 발생하면 오류를 검출할수없는 문제가 있음
						</dl>
				</ul>
			<li>허프만 코딩 : 텍스트에 적합하다. <a href="http://blog.daum.net/hivaless/6609525" target="_blank">[참고페이지]</a>
				<br />AAAAAAABBCCCDEEEEFFFFFFG 인경우
				<ol>
					<li>데이터에서 사용되는 각 문자에 대한 출현 빈도수를 구한다.
						<table>
						<tr>
							<th>문자</th>
							<td>A</td>
							<td>B</td>
							<td>C</td>
							<td>D</td>
							<td>E</td>
							<td>F</td>
							<td>G</td>
						</tr>
						<tr>
							<th>출현빈도</th>
							<td>7</td>
							<td>2</td>
							<td>3</td>
							<td>1</td>
							<td>4</td>
							<td>6</td>
							<td>1</td>
						</tr>
						</table>
					<li>내림차순 정리
						<table>
						<tr>
							<td>A</td>
							<td>F</td>
							<td>E</td>
							<td>C</td>
							<td>B</td>
							<td>D</td>
							<td>G</td>
						</tr>
						<tr>
							<td>7</td>
							<td>6</td>
							<td>4</td>

							<td>3</td>
							<td>2</td>
							<td>1</td>
							<td>1</td>
						</tr>
						</table>
					<li>값이 작은 두개의 노드를 가지로 연결하고 두수의 합을 적는다.
						<dl>
							<dt>D : 1 , G : 1
							<dd>숫자 2로 묶인 가지 연결
						</dl>

					<li>계속 반복한다.
						<dl>
							<dt>숫자 2, B : 2 
							<dd>숫자 4로 묶인 가지 연결

							<dt>숫자 4, C : 3 
							<dd>숫자 7로 묶인 가지 연결

							<dt>E : 4 , F : 6
							<dd>숫자 10로 묶인 가지 연결
							
							<dt>숫자 7, A : 7
							<dd>숫자 14로 묶인 가지 연결
							
							<dt>숫자 14, 숫자 10
							<dd>숫자 24로 묶인 가지 연결


						</dl>
					
					<li>가지 그림 중 왼쪽은 0 , 오른쪽은 1 으로 정해 해당하는 숫자가 대처문자가 된다.
					<br />
						<dl>
							<dt>A 
							<dd>00 , 01

							<dt>F
							<dd>10 , 11

							<dt>E 
							<dd>11 , 10
							
							<dt>C 
							<dd>011 , 001
							
							<dt>B 
							<dd>0100 , 0001

							<dt>D 
							<dd>01010 , 00000
							
							<dt>G 
							<dd>01011 , 00001 
						</dl>
					<li>
						<dl>
							<dt>AAAAAAABBCCCDEEEEFFFFFFG
							<dd>0000000000000001000100011011011010101111111110101010101001011
							<dd>0101010101010100010001001001001000001010101011111111111100001
						</dl>
				</ol>
		</ul>
	</div>	
</div>