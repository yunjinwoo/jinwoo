

<h3>23.<?php echo getSubTitle() ; ?> : 오류를 검출해서 신뢰도를 높이자</h3>

<div style="float:left;width:700px;">
	<div style="float:right;width:680px;">
	
		<ul>
			<li>패리티 비트 : 데이타 전송시 유실되었을때 사용하는 기초적인 방법
				<ul>
					<li>홀수 패리티 : 데이터 끝에 패리티 비트를 추가하여 1의 개수가 홀수가 되게하는 방법
					<li>짝수 패리티
						<dl>
							<dt>데이터 끝에 패리티 비트를 추가하여 1의 개수가 짝수가 되게하는 방법
							<dd>짝수개의 비트에 오류가 발생하면 오류를 검출할수없는 문제가 있음
						</dl>
				</ul>
			<li>세로 중복 검사(LRC:Longitudinal Redundancy Check)
				<dl>
					<dt>예제
					<dd>
					01000001<br />
					01101100<br />
					11010011<br />데이터 전송시 같은열에 대응되는 패리티 비트를 구한다.<br />
					11111110 중복정보
				</dl>

			<li>ISBN(International Standard Book Number)
				<dl>
					<dt>국제적으로 표준화된 방법에 따라 전세계에서 생산되는 도서에 부여되는 고유번호
					2006년까지는 10자리, 2007년 부터는 13자리로 재구성됨<br />
					접두부, 국가번호 발행자 번호, 서명식별번호 체크기호 순으로 되어 있으면
					공백,하이픈(-) 으로 구분된다.

					<dd>구분 방법<br />
						<ol>
							<li>ISBN 처음 12자리 숫자에 가중치 1과 3을 번갈아가며 곱한다.
							<li>각 갖중치를 곱한 값의 합을 계산한다.
							<li>가중치의 합을 10으로 나누어 나머지를 구한다.
							<li>체크기호는 '10-나머지' 가 된다. 단 나머지가 0인 경우의 체크기호는0이다.
						</ol>
						
						<?php $a = 'ISBN-978-89-7914-549-6' ;?>
						<h3><?php echo $a?></h3>
						<table>
						<?php 
							$s = str_replace('-','',str_replace('ISBN','',$a )) ;
							$weight = array( 1 , 3 ) ;
							$sum = 0 ;
							for( $i=0;$i<12;$i++){
						?>
						<tr>
							<td><?php echo $t1 = substr($s,$i,1)?></td><td>*<?php echo $t2 = $weight[$i%2]?></td><td>=<?php $sum+=$t1*$t2 ; echo $t1*$t2 ;?></td>
						</tr>
						<? } ?>
						</table>
						<ul>
							<li>합은 : <?php echo $sum?>
							<li>나누기 10 은 : <?php echo $t1=$sum%10;?>
							<li>10 - 은 : <?php echo 10-$t1;?>
						</ul>
						<dl>
							<dt>
							<dd>
						</dl>
						
				</dl>
		</ul>
	</div>	
</div>