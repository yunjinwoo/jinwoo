
<div class="panel-group" id="accordion">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="m0"><a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
				<?= getTitle()?>
			</a></h3>
		</div>

		<div id="collapseOne" class="panel-collapse collapse in" style="height:0px;">
			
			<div class="panel-body">
				애플리케이션에서 MVC모델을 사용하는 방법, 원격 데이터를 로딩하고
				조작하는 방법을 설명한다.<br />
				MCV와 명칭공간이 왜 중요한지를 살펴본 다음 직접 ORM라이브러리를 만들어
				모델 데이터를 관리하는 방법을 확인한다.<br />
				다음으로 JSONP, 크로스도메인Ajax를 이용해 원격 데이터를 로드하는 방법을 살펴본다.<br />
				마지막으로 HTML5 로컬 저장소를 이용해 모델 데이터를 영구 저장하고
				RESTful 서버에 요청하는 방법을 배운다.<br />
			</div>
			
			<div class="panel-body">
				기존에는 페이지를 요청하면서 데이터베이스에서 직접 데이타를 요청한 다음
				결과 페이지에 이용했다 하지만 상태가 변하는 자바스크립트 애플리케이션에서는
				얘기가 완전히 달라진다.
			</div>
			
			<div class="panel-body">
				자바스크립트에는 요청/응답 모델이 없으며 서버 측 변수에 접근할 필요도 없다.
				자바스크립트는 데이터를 원격으로 가져와서 클라이언트에 일시적으로 저장한다.
			</div>
		</div>
	</div>
</div>