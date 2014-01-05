<?php
error_reporting( E_ALL ) ;

define( '_TITLE_' , 'javascript web applications' ) ;

$_bookMenu = array(
	'MVC와 클래스'
		=> array( 
				'옛날 이야기'
			,	'구조 추가하기'
			,	'MVC란 무엇인가?'
			,	'MVC란 무엇인가? - 모델'
			,	'MVC란 무엇인가? - 뷰'
			,	'MVC란 무엇인가? - 컨트롤러'
			,	'모듈화와 클래스 생성'
			,	'클래스에 함수 추가하기'
			,	'클래스 라이브러리에 메소드 추가하기'
			,	'클래스 상속과 프로토타입 사용'
			,	'클래스 라이브러리에 상속 기능 추가하기'
			,	'함수 호출'
			,	'클래스 라이브러리에서 범위 조절하기'
			,	'비공개 함수 추가하기'
			,	'클래스 라이브러리'
		) 
	,'이벤트와 이벤트 관찰'
		=> array( 
				'이벤트 수신'
			,	'이벤트 순서'
			,	'이벤트 취소'
			,	'Event 오브젝트'
			,	'이벤트 라이브러리'
			,	'컨텍스트 변경'
			,	'이벤트 위임'
			,	'커스텀 이벤트'
			,	'커스텀 이벤트와 jQuery 플러그인'
			,	'DOM 이외의 이벤트'
		) 
	,'모델과 데이터'
		=> array( 
				'MVC와 명칭공간'
			,	'ORM 만들기'
			,	'ORM 만들기 - 프로토타입의 상속'
			,	'ORM 만들기 - ORM 프로퍼티 추가하기'
			,	'ORM 만들기 - 레코드 영구 저장'
			,	'ID 지원 기능 추가'
			,	'레퍼런스 문제 해결'
			,	'테이터를 로딩할 때 일어날 수 있는 일'
			,	'테이터를 로딩할... - 데이터 인라인 포함하기'
			,	'테이터를 로딩할... - Ajax로 데이터 로딩하기'
			,	'테이터를 로딩할... - JSONP'
			,	'테이터를 로딩할... - 크로스 도메인의 요청의 보안'
                        ,       'ORM 활용'
                        ,       '로컬에 데이터 저장하기'
                        ,       'ORM에 지역 저장소 추가하기'
                        ,       '새 레코드를 서버에 전송하기'
                    
		) 
	,'컨트롤러와 상태'
		=> array( 
				'모듈 패턴'
                        ,       '모듈 패턴 - 전역 임포트'
                        ,       '모듈 패턴 - 전역 노출'
                        ,       '컨텍스트 추가하기'
                        ,       '컨텍스트... - 라이브러리로 추상화하기'
                        ,       '컨텍스트... - 문서를 로딩한 다음에 컨트롤러 로딩하기'
                        ,       '컨텍스트... - 뷰 접근'
                        ,       '컨텍스트... - 이벤트 위임'
                        ,       '상태머신'
                        ,       '라우팅'
                        ,       '라우팅 - URL의 해시 이용하기'
                        ,       '라우팅 - 해시 변경 검출'
                        ,       '라우팅 - Ajax 크롤링'
                        ,       '라우팅 - html5 히스토리 api 사용하기'
		) 
	,'뷰와 템플릿'
		=> array( 
				'동적 뷰 렌더링'
			,	'템플릿'
			,	'템플릿 - 템플릿 헬퍼'
			,	'템플릿 - 템플릿 저장소'
			,	'바인딩'
			,	'바인딩 - 모델 바인딩'
		) 
	,'의존성 관리'
		=> array( 
				'CommonJs'
			,	'CommonJs - 모듈 선언'
			,	'CommonJs - 모듈과 브라우저'
			,	'모듈로더'
			,	'모듈로더 - 야블'
			,	'모듈로더 - RequireJS'
			,	'모듈래핑'
			,	'대안모듈'
			,	'대안모듈 - LABjs'
			,	'FUBCs'
		) 
	,'파일 작업'
		=> array( 
				'브라우저 지원'
			,	'파일 정보 얻기'
			,	'파일 입력'
			,	'드래그 앤드 드롭'
			,	'드래그... - 드래깅'
			,	'드래그... - 드롭'
			,	'드래그... - 기본 드래그/드롭 취소하기'
			,	'복사와 붙여넣기'
			,	'복사와... - 복사하기'
			,	'복사와... - 붙여넣기'
			,	'파일 읽기'
			,	'파일 읽기 - 블랍과 슬라이스'
			,	'파일 업로딩'
			,	'파일 업로딩 - ajax 진행'
			,	'jQuery 드래그 앤드 드롭 업로더'
			,	'jQuery... - 드롭 영역 만들기'
			,	'jQuery... - 파일 업로딩'
		) 
	,'실시간 웹'
		=> array( 
				'실시간의 역사'
			,	'웹소켓'
			,	'웹소켓 - Node.js와 Socket.IO'
			,	'실시간 아키텍쳐'
			,	'인지 속도'
		) 
	,'테스팅과 디버깅'
		=> array( 
				'단위 테스팅'
			,	'단위 테스팅 - 어써션'
			,	'단위 테스팅 - QUnit'
			,	'단위 테스팅 - 자스민'
			,	'드라이버'
			,	'헤드리스 테스팅'
			,	'헤드리스... - Zombie.js'
			,	'헤드리스... - 이카보드'
			,	'분산테스팅'
			,	'지원제공'
			,	'인스펙터'
			,	'인스펙터 - 웹 인스펙터'
			,	'인스펙터 - 파이어버그'
			,	'콘솔'
			,	'콘솔 - 콘솔 헬퍼'
			,	'디버거 사용'
			,	'네트워크 요청 분석'
			,	'프로파일과 타이밍'
		) 
	,'배포'
		=> array( 
				'성능'
			,	'캐싱'
			,	'간소화'
			,	'Gzip 압축'
			,	'CDN 사용하기'
			,	'감사 프로그램'
			,	'자원'
		) 
	,'스파인 라이브러리'
		=> array( 
				'설치'
			,	'클래스'
			,	'클래스 - 인스탄스화'
			,	'클래스 - 클래스 확장'
			,	'클래스 - 컨텍스트'
			,	'이벤트'
			,	'모델'
			,	'모델 - 레코드 꺼내기'
			,	'모델 - 모델 이벤트'
			,	'모델 - 검증'
			,	'모델 - 영구 저장'
			,	'컨트롤러'
			,	'컨트롤러 - 프록싱'
			,	'컨트롤러 - 엘리먼트'
			,	'컨트롤러 - 이벤트 위임'
			,	'컨트롤러 - 컨트롤러 이벤트'
			,	'컨트롤러 - 전역 이벤트'
			,	'컨트롤러 - 렌더 패턴'
			,	'컨트롤러 - 엘리먼트 패턴'
			,	'연락처 관리자 만들기'
			,	'연락처 - Contact 모델'
			,	'연락처 - Sidebar 컨트롤러'
			,	'연락처 - Contacts 컨트롤러'
			,	'연락처 - App 컨트롤러'
		) 
    ,'백본 라이브러리'
		=> array( 
				'모델'
			,	'모델 - 모델과 속성'
			,	'콜렉션'
			,	'콜렉션 - 콜렉션 순서 제어하기'
			,	'뷰'
			,	'뷰 - 뷰 렌더링'
			,	'뷰 - 이벤트 위임'
			,	'뷰 - 바인딩과 컨텍스트'
			,	'컨트롤러'
			,	'서버 동기화'
			,	'서버... - 콜렉션 채우기'
			,	'서버... - 서버 측 작업'
			,	'서버... - 커스텀 동작'
			,	'할 일 목록 애플리케시이션 만들기'
		) 
    ,'자바스크립트MVC 라이브러리'
		=> array( 
				'설치'
			,	'클래스'
			,	'클래스 - 인스턴스화'
			,	'클래스 - 부모의 메소드 호출'
			,	'클래스 - 프록시'
			,	'클래스 - 정적 상속'
			,	'클래스 - 자기 성찰'
			,	'클래스 - 모델 예제'
			,	'모델'
			,	'모델 - 속성과 변화 관찰'
			,	'모델 - 모델 확장하기'
			,	'모델 - 세터'
			,	'모델 - 기본값'
			,	'모델 - 헬퍼 메소드'
			,	'모델 - 서비스 캡슐화'
			,	'모델 - 타입 변환'
			,	'모델 - CRUD 이벤트'
			,	'클라이언트의 뷰 템플릿 사용하기'
			,	'클라이언트... - 기본 사용'
			,	'클라이언트... - jQuery 수정자'
			,	'클라이언트... - 스크립트 태그에서 로딩하기'
			,	'클라이언트... - $.View와 하위템플릿'
			,	'클라이언트... - 디퍼드'
			,	'클라이언트... - 패키징, 미리 로딩, 성능'
			,	'$.Controller:jQuery 플러그인 팩토리'
			,	'$.Controller... - 개요'
			,	'$.Controller... - 컨트롤러 인스턴스화'
			,	'$.Controller... - 이벤트 바인딩'
			,	'$.Controller... - 템플릿을 사용한 액션'
			,	'모든 기능을 합쳐서 추상CRUD 리스트 만들기'
		) 
    ,'jQuery 자습서'
		=> array( 
				'DOM 탐색'
			,	'DOM 조작'
			,	'이벤트'
			,	'Ajax'
			,	'모범 시민이 되는 방법'
			,	'확장'
			,	'Growl jQuery 플러그인 만들기'
		) 
    ,'CSS확장'
		=> array( 
				'변수'
			,	'믹스인'
			,	'중첩규칙'
			,	'다른 스타일시트 포함하기'
			,	'색'
			,	'Less를 어떻게 이용해야 하는가?'
			,	'Less... - 명령행 이용'
			,	'Less... - 랙 이용'
			,	'Less... - 자바스크립트 이용'
			,	'Less... - Less,app 이용'
		) 
    ,'CSS3 활용하기'
		=> array( 
				'접두어'
			,	'색'
			,	'둥근모서리'
			,	'그림자추가'
			,	'텍스트 그림자'
			,	'그래이디언트'
			,	'다중배경'
			,	'셀렉터'
			,	'셀렉터 - Nth Child'
			,	'셀렉터 - 직계 후손'
			,	'셀렉터 - 셀렉터 반전'
			,	'트랜지션'
			,	'경계 이미지'
			,	'박스 사이징'
			,	'트랜스포메이션'
			,	'유연한 박스 모델'
			,	'폰트'
			,	'자연스러운 디그라대이션'
			,	'자연스러운...- 모더나이저'
			,	'자연스러운...- 구글 크롬 프레임'
			,	'레이아웃 만들기'
		) 
	
) ;



/***/
function get( $s )
{
	if( isset($_GET[$s]) )
		return trim($_GET[$s]);
	else
		return '' ;
}
function post( $s )
{
	if( isset($_POST[$s]) )
		return trim($_POST[$s]);
	else
		return '' ;
}

function getPageTitle()
{
	$sSubTitle = getSubTitle() ;
	if( empty($sSubTitle ) )
		return _TITLE_ ;
	return $sSubTitle.' | '._TITLE_ ;
}

function getTitle()
{
	GLOBAL $_bookMenu ;
	
	$aTitle = array_keys( $_bookMenu ) ;

	$sAction = get('action') ;	
	$key = (int)substr($sAction,0,2) ;
	$subKey = (int)substr($sAction,-2) ;
        if( --$key < 0 ) $key = 1;
        if( --$subKey < 0 ) $subKey = 1;
        
	return $aTitle[ $key ];
}

function getSubTitle()
{
	GLOBAL $_bookMenu ;
	
	$aTitle = array_keys( $_bookMenu ) ;

	$sAction = get('action') ;	
	$key = (int)substr($sAction,0,2) ;
	$subKey = (int)substr($sAction,-2) ;
        if( --$key < 0 ) $key = 1;
        if( --$subKey < 0 ) $subKey = 1;
        
	return $_bookMenu[ $aTitle[ $key ] ][ $subKey ] ;
}



class JsDefault
{
	static function assert(){
		?>
<pre class="brush: javascript;">
	<script type="text/javascript">
	var assert = function(value, msg){
		if( !value )
			throw(msg || ("assert : "+value + " dose not equal true"));
	}

	var assertEqual = function(val1,val2,msg){
		if( val1 !== val2 )
			throw(msg || ("assertEqual : "+val1 + " dose not equal " + val2));
	}
	</script>
</pre>
		
		<?php
	}
	static function char01_class()
	{
		?>
			<section class="panel-group" id="accordion2" style="margin-bottom: 30px;">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="m0"><a data-toggle="collapse" data-parent="#accordion2" href="#collapseOne2">
							chapter 01 공통
						</a></h3>
					</div>

					<div id="collapseOne2" class="panel-collapse collapse in" style="height:0px;">
						<div class="panel-body">
							<pre class="brush: javascript;">
								<script type="text/javascript">
									//chapter0109  클래스 라이브러리에 메소드 추가하기
									//chapter0111  클래스 라이브러리에 상속 기능 추가하기
									
								var Class = function(parent){
									var klass = function(){
										this.init.apply(this, arguments);
									};

									// klass의 프로토타입을 바꾼다
									if( parent ){
										var subclass = function(){};
										subclass.prototype = parent.prototype;
										klass.prototype = new subclass;
									}

									klass.prototype.init = function(){};
									
									klass.fn = klass.prototype;	//프로토타입의 단축형
									klass.fn.parent = klass;	//클래스의 단축형
									klass._super = klass.__proto__;
									
									//클래스 프로퍼티 추가
									klass.extend = function(obj){
										var extended = obj.extended;
										for(var i in obj){
											klass[i] = obj[i];
										}
										if(extended) extended(klass);
									};
									
									//인스턴스 프로퍼티 추가
									klass.include = function(obj){
										var included = obj.included;
										for(var i in obj){
											klass.fn[i] = obj[i];
										}
										
										if(included) included(klass);
									};
									
									// 프록시 함수 추가
									klass.proxy = function(func){
										var self = this;
										return (function(){
											return func.apply(self, arguments);
										});
									}
									klass.fn.proxy = klass.proxy;
									
									return klass;
								};
								</script>
							</pre>
						</div>
					</div>
				</div>
			</section>
		<?php
	}
}