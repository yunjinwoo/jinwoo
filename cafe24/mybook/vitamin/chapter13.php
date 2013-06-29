

<h3>14.<?php echo getSubTitle() ; ?> : 컴퓨터가 알 수 있는 명령어를 만들자</h3>

<div style="float:left;width:700px;">
	<div style="float:right;width:680px;">
		<ul>
			<li>MSW Logo 프로그램 알아보기 <a href="http://www.softonic.com/" target="_blank">[다운로드]</a>
			<li>명령어
				<dl>
					<dt>forward [숫자] = fd
					<dd> 지정된 숫자(픽셀)만큼 선을 그린다. ( 음수인경우 뒤로간다. )

					<dt>right [숫자]   = rt
					<dd> 커서회전(각도) 시킨다. (음수인경우 반시계방향)
					
					<dl>
						<dt>샘플 코드
						<dd>
<pre>
forward 100 right 90 forward 100 right -90 forward 100
forward 100 right 90 forward 100 right 90 forward 100 right 90 forward 100
								
forward 400
forward 50 right 90 forward 100 right 90 forward 100 right 90 forward 100 right 90 forward 50 right 240 forward 100 right 120 forward 100 right 120 forward 100 

위 아래는 같은 코드다

fd 100 rt 90 fd 100 rt -90 fd 100
fd 100 rt 90 fd 100 rt 90 fd 100 rt 90 fd 100

fd 400
fd 50 rt 90 fd 100 rt 90 fd 100 rt 90 fd 100 rt 90 fd 50 rt 240 fd 100 rt 120 fd 100 rt 120 fd 100 
</pre>					
						<dt>repeat [숫자] [문장] = 반복문
						<dd> 입력된 숫자 만큼 문장을 반복한다.
<pre>
repeat 3 [fd 100 rt 90] fd 100


<a href="http://blog.naver.com/PostView.nhn?blogId=nyulet012&logNo=110095867102" target="_blank">[참고]</a>
[출처] MSW Logo라는 프로그램 하나 소개합니다.|작성자 뉼렛
repeat 10 [ repeat 360 [fd 2 rt 1] rt 36 ], repeat 4 [fd 50 rt 90]

</pre>
					</dl>
				</dl>
		</ul>		
	</div>	
</div>