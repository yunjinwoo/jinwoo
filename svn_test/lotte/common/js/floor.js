
$(function(){
	$("ul.floor_list > li > div.tit > a").bind("click", function(e){
		e.preventDefault();
		var idx = $("ul.floor_list > li > div.tit > a").index($(this));
		$("ul.floor_list > li > div.tit > a").parent().parent().removeClass("on").eq(idx).addClass("on") ;
	});

	// 입점브랜드 층별안내 링크
	$("ul.floor_list ul.list").delegate('a','click',function(e){
		e.preventDefault() ;
		$(this).maskAjax({
			callback:function(){$(document).triggerHandler("popup_1Action");}
			,data:{/* ... 여기에 데이타를 .... */}
		}) ;
	});

	// 주요편의시설, 식당가 층별안내 링크
	$("ul.facilities dl dd").delegate('a','click',function(e){
		e.preventDefault() ;
		$(this).maskAjax({
			callback:function(){$(document).triggerHandler("popup_1Action");}
		}) ;
	});

	// 전체 도면 바로보기
	$("p.btn_totalplan").delegate('a','click',function(e){
		e.preventDefault() ;
		$(this).maskAjax({
			callback:function(){$(document).triggerHandler("popup_4Action");}
		}) ;
	});
	

	// _1.html 을 안에 들어가는 액션들
	$(document).bind("popup_1Action", function(){
		// 층별안내 확대 버튼
		$("div#modal_wrap div.plan a").bind('click', function(e){
			e.preventDefault() ;
			$(this).maskAjax({
				callback:function(){$(document).triggerHandler("popup_2Action");}
			}) ;
		});
		// 층별안내 전점 입점 정보 보기 링크
		$("div#modal_wrap div.info table a").bind('click', function(e){
			e.preventDefault() ;
			$(this).maskAjax({
				callback:function(){$(document).triggerHandler("popup_1Action");}
			}) ;
		});
		
		// 팝업내 페이지
		$("div#modal_wrap div.info div.paginate2 a").bind('click', function(e){
			e.preventDefault() ;
			$(this).maskAjax({
				callback:function(){$(document).triggerHandler("popup_1Action");}
			}) ;
		});

		$("div#modal_wrap table tbody").each(function(i){
			$(this).find("tr").removeClass("on").end().find('tr:even').addClass("on");
		});
	});

	// _2.html 을 안에 들어가는 액션들
	$(document).bind("popup_2Action", function(){
		// 확대 보기 페이지에서 이전으로 가기 버튼
		$("div#modal_wrap div.pic a.btn_pre").bind('click', function(e){
			e.preventDefault() ;
			$(this).maskAjax({
				callback:function(){$(document).triggerHandler("popup_1Action");}
			}) ;
		});
		
		// 확대 보기 버튼
		$("div#modal_wrap span.control a:first").bind('click', function(e){
			e.preventDefault() ;
			$("div#modal_wrap div.pic > p.photo img").css({width:"auto"}).mouseMove({box:$("div#modal_wrap div.pic")});
		});
		// 확대 축소 버튼 
		$("div#modal_wrap span.control a:last").bind('click', function(e){
			e.preventDefault() ;
			$("div#modal_wrap div.pic > p.photo img").css({margin:0,width:"100%"}).unbind('mousemove');
		});
	});

	// _4.html (확대보기) 을 안에 들어가는 액션들
	$(document).bind("popup_4Action", function(){
		$("div#modal_wrap ul.fl_list a").bind('click', function(e){
			e.preventDefault() ;
			var idx = $("div#modal_wrap ul.fl_list a").index($(this)) ;
			$("div#modal_wrap ul.fl_list a").parent().removeClass("on").eq(idx).addClass("on");
			var src = $(this).attr('href') ;
			$("div#modal_wrap p.photo2 img").attr('src',src) ;
			$("div#modal_wrap span.control a:last").triggerHandler('click');
		});
		// 확대 보기 버튼
		$("div#modal_wrap span.control a:first").bind('click', function(e){
			e.preventDefault() ;
			$("div#modal_wrap p.photo2 img").css({width:"auto"}).mouseMove({box:$("div#modal_wrap div.pic")});
		});
		// 확대 축소 버튼 
		$("div#modal_wrap span.control a:last").bind('click', function(e){
			e.preventDefault() ;
			$("div#modal_wrap p.photo2 img").css({margin:0,width:"100%"}).unbind('mousemove');
		});
	});

	// 검색후 실행되는 action
	$(document).bind("popup_5Action", function(){
		$("div#modal_wrap dl.srch_list a").bind('click', function(e){
			e.preventDefault() ;
			$(this).maskAjax({
				callback:function(){$(document).triggerHandler("popup_1Action");}
			}) ;
		});
	});
	
	$(document).bind("floor_list-li_bg",function(){
		if( $(window).width() <= 1000 )
			$("ul.floor_list ul.list").each(function(){
				$(this).find('li').removeClass('bg').end().find("li:even").addClass("bg");
			}) ;
		else
			$("ul.floor_list ul.list").each(function(){
				$(this).find('li').removeClass('bg').each(function(i){
					var k = i % 4 ;
					if( k <= 1 ){
						$(this).addClass("bg");
					}
				});
			});
	});
	$(document).data("floor_list-li_bg_timer", null) ;
	$(document).bind("common-resize",function(){
		clearTimeout( $(document).data("floor_list-li_bg_timer") ) ;
		$(document).data("floor_list-li_bg_timer", setTimeout(function(){
			$(document).trigger("floor_list-li_bg");
		}, 300 )) ;
	});
	
	$(document).triggerHandler("common-resize");
});
