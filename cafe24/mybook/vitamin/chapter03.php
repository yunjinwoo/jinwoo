
<h3>4.<?php echo getSubTitle() ; ?> : 제한적인 공간에서 2진수 형태로 표현되는 정수와 실수 </h3>

<div style="float:left;width:700px;">
	<div style="float:right;width:680px;">
		정수와 실수의 2진수 표기... <br />

	<div style="float:left ;">	
		<table class="doctable table">
		<caption><b>논리 연산자</b></caption>
		
		 <thead valign="middle">
		  <tr valign="middle">
		   <th>표현</th>
		   <th>값</th>
		  </tr>

		 </thead>

		 <tbody valign="middle" class="tbody">
		  <tr valign="middle">
		   <td align="left">01111111</td>
		   <td align="left">127</td>
		  </tr>

		  <tr valign="middle">
		   <td align="left">01111110</td>
		   <td align="left">126</td>
		  </tr>

		  <tr valign="middle">
		   <td align="left">01111101</td>
		   <td align="left">125</td>
		  </tr>

		  <tr valign="middle">
		   <td align="left">.</td>
		   <td align="left">.</td>
		  </tr>

		  <tr valign="middle">
		   <td align="left">.</td>
		   <td align="left">.</td>
		  </tr>

		  <tr valign="middle">
		   <td align="left">00000001</td>
		   <td align="left">1</td>
		  </tr>

		  <tr valign="middle">
		   <td align="left">00000000</td>
		   <td align="left">0</td>
		  </tr>

		  <tr valign="middle">
		   <td align="left">11111111</td>
		   <td align="left">-1</td>
		  </tr>

		  <tr valign="middle">
		   <td align="left">11111110</td>
		   <td align="left">-2</td>
		  </tr>

		  <tr valign="middle">
		   <td align="left">.</td>
		   <td align="left">.</td>
		  </tr>

		  <tr valign="middle">
		   <td align="left">.</td>
		   <td align="left">.</td>
		  </tr>

		  <tr valign="middle">
		   <td align="left">10000001</td>
		   <td align="left">-127</td>
		  </tr>

		  <tr valign="middle">
		   <td align="left">10000000</td>
		   <td align="left">-128</td>
		  </tr>
		 </tbody>
		
	   </table>
	</div>

	<div>	
		<h3> -5의 2의 보수 표현</h3>
		<pre>
 5                      => 0101
 0은 1로, 1은 0으로변환 => 1010
 1을 더함               => 1011

 <b>1011</b>
		</pre>
	</div>
		

<hr />
		<b>실수 표현</b>

 어렵;;;
 <b>키워드</b> 
 <ul>
	<li>IEEE 754 표준 : 8비트 지수의 4바이트 형식, 11비트 지수의 8바이트 형식
	<li>가수(mantissa)[+,-] , 밑수(radix) , 지수 (exponent)
	<li>
		<table>
		
		<tr>
			<th>0</th>
			<th>1 ~ 8</th>
			<th>9~31</th>
		</tr>

		<tr>
			<td>가수</td>
			<td>밑수</td>
			<td>지수</td>
		</tr>

		<tr>
			<th>0</th>
			<th>1 ~ 11</th>
			<th>12~63</th>
		</tr>

		<tr>
			<td>가수</td>
			<td>밑수</td>
			<td>지수</td>
		</tr>
		</table>
 </ul>
	</div>	
</div>