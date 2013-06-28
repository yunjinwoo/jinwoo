

<h3>19.<?php echo getSubTitle() ; ?> : 내 안에 또 다른 내가 있네</h3>

<div style="float:left;width:700px;">
	<div style="float:right;width:680px;">
		<div style="border:1px solid #ff0099; padding:5px; width:500px;">
			프랙탈은 부분이 전체를 닮는 자기유사성(self-similarity)이라는
			특징을 갖는 구조를 말한다.
			<br />
			프랙탈 구조로 대표적인 것이 고흐 눈송이, 시어핀스키 삼각형 등인데,
			재귀 알고리즘 원리를 적용하면 그림을 그릴 수 있다.
			<br /><br />
			로고 사용 
		</div>

		<xmp>
책에 예제를 따라했는데 먼가 감동적이긴한데
모르겠다 ㅋㅋ;;;

과제 포기;;;

추후 메뉴얼 보고 할수있을까나??

to sierpinski :length
	if :length<5 [stop]
	repeat 3 [sierpinski :length/2 FD :length RT 120]
end

to square :length
	ifelse :length<200~
		[repeat 4 [forward :length right 90]]~
		[repeat 4 [forward 200 right 90]]
end

to square:length
	repeat 4 [forward 100 right 90]
end


		</xmp>
	</div>	
</div>