$(function(){
	// 한칸 클릭 베너
	(function(){
		$("div.box2 ul").find("li:first").addClass("view");
		$("div.box2 .control").delegate("a",'click' ,function(e){
			e.preventDefault() ;
			var idx = 0 ;
			var $li = $(this).parent().parent().find("li") ;
			$li.each(function(i){
				if($(this).hasClass("view")) idx = i ;
			});
			if( $(this).hasClass('pre') ){
				if(--idx<0) idx = $li.size() - 1 ;
			}else{
				if(++idx>=$li.size()) idx = 0 ;			
			}
			
			$li.hide().removeClass('view').eq(idx).show().addClass('view');
		});
		$("div.box2 .control a").click();
	})();	

	// 메인 롤링,클릭 베너
	(function(delay){
		var btnStopFlag = false ;
		var stopFlag = false ;

		var $li		= $("div.box1 ul.banner li");
		var $btn	= $("div.box1 p.banner_art a");
		var viewIndex = 0 ;
		var viewSize = $li.size() ;
	
		// ie7 에서 밀림 현상 
		//$li.css({position:"absolute"}) ;
		$btn.bind("click",function(e){
			e.preventDefault() ;
			viewIndex = $btn.index($(this));

			$li.removeClass("view").hide()
				.eq(viewIndex).addClass("view").show() ;
			
			$btn.find("img").each(function(i){
				if( i == viewIndex )
					$(this).attr('src', $(this).attr('src').replace('_off.png','_on.png') );
				else
					$(this).attr('src', $(this).attr('src').replace('_on.png','_off.png') );
			});
		});

		$("div.box1").hover(function(){
			stopFlag = true ;
		},function(){
			stopFlag = false ;
			timer = setTimeout(roll,delay);
		});

		$("div.box1 ul.banner a").focus(function(){clearTimeout(timer);stopFlag = true ;}) ;
		$("div.box1 ul.banner a").blur(function(){stopFlag = false ;timer = setTimeout(roll,delay);}) ;
		
		$("div.box1 .control a:eq(0)").bind('click' ,function(e){ e.preventDefault() ;btnStopFlag = true ; });
		$("div.box1 .control a:eq(1)").bind('click' ,function(e){ e.preventDefault() ;btnStopFlag = false ; timer = setTimeout(roll,delay);});
		
		var timer = null ;
		var roll = function(){
			clearTimeout(timer);
			if( stopFlag ) return ;
			if( btnStopFlag ) return ;

			viewIndex++ ;
			if( viewIndex >= viewSize )
				viewIndex = 0 ;

			$btn.eq(viewIndex).click();
			timer = setTimeout(roll,delay);
		}

		// 초기화
		$btn.eq(0).click();
		timer = setTimeout(roll,delay);
	})(4000);

	// 김포공항점 달력 탭 부분
/*
	$("div.calendar_wrap ul.artc > li > a").bind('click', function(){
	console.log('e11e') ;
		var idx = $("div.calendar_wrap ul.artc > li > a").index($(this));
		$("div.calendar_wrap ul.artc > li > a").each(function(i){
			if( idx == i ){
				$(this).parent().addClass("selectd");
				$($(this).attr('href')).removeClass("none");
			}else{
				$(this).parent().removeClass("selectd");
				$($(this).attr('href')).addClass("none");
			}
		});
	}).eq(0).click();
*/
	
	$("div.calendar_wrap ul.artc > li > a").parentNone({className:"selectd"});
	
	$("div.calendar_wrap ul.artc > li > a").bind('click',function(e){
		e.preventDefault() ;
		var idx = $("div.calendar_wrap ul.artc > li > a").index($(this));
		$(".table_msg").hide().eq(idx).show();
	});
	$(".table_msg").hide().eq(0).show();

	
$(document).bind("main.set.service", function(){});
$(document).bind("main.unset.service", function(){});

$(document).bind("main.set.branch", function(){
	$("div#side ul#nav2 a").bind('mouseenter focus', function(){$(this).parent().addClass("on");}) ;
	$("div#side ul#nav2 a").bind('mouseleave blur', function(){$(this).parent().removeClass("on");}) ;
});

$(document).bind("main.unset.branch", function(){

	$("div#side a").parent().removeClass("on");
	$("div#side ul#nav2 a").unbind('mouseenter focus') ;
	$("div#side ul#nav2 a").unbind('mouseleave blur') ;
});

	//sub 용을 지우고 메인만 넣는다.
	$(document).unbind("sub-resize");
	$(document).triggerHandler("sub.unset.branch");
	$(document).triggerHandler("sub.unset.service");
	$(document).triggerHandler("mobile.unset.branch");
	$(document).triggerHandler("mobile.unset.service");

	$(document).bind("main-resize",function(){
		if( $(window).width() <= 480 ){
			if( !is$Data("main.unset.branch") )
			{
				set$Data("main.set.branch"		,"") ;
				set$Data("main.unset.branch"		,"main.unset.branch") ;
				$(document).triggerHandler("main.unset.branch");
				$(document).triggerHandler("main.unset.service");
				$(document).triggerHandler("mobile.set.branch");
				$(document).triggerHandler("mobile.set.service");
			}
		}else if( $(window).width() < 1001 ){
			//console.log('ee');
			$("p.desc_challenge").css({display:''}) ;
			$("div.evt20130409").css({display:''}) ;
		}else{
			if( !is$Data("main.set.branch") )
			{
				set$Data("main.set.branch"		,"main.set.branch") ;
				set$Data("main.unset.branch"	,"") ;
				$(document).triggerHandler("main.set.branch");
				$(document).triggerHandler("main.set.service");
				$(document).triggerHandler("mobile.unset.branch");
				$(document).triggerHandler("mobile.unset.service");
			}
		}

		//console.group($(window).width());
		//console.log(is$Data("main.set.branch"));
		//console.log(is$Data("main.unset.branch"));
		//console.groupEnd();
	});


	$(document).bind("css-resize",function(){
		var w = $(window).width() ;
		if( w >= 1264  )
			$("ul.evt_list li").show();
		else if( w >= 984 )
			$("ul.evt_list li").hide().slice(0,2).show();
		else if( w > 480 ){	
			// 모바일 액션값 삭제
		//	$("div.nav_service").attr('style','').find("h2").removeClass("on").end().find("*").attr('style','') ;
		//	$("div#side").attr('style','').find("h2").removeClass("on").end().find("*").attr('style','') ;
		}else if( w <= 480 ){
			// action 값
			$("ul.evt_list li").show().not(".view").hide() ;
		}
	});

	$(window).bind('resize',function(){
		$(document).triggerHandler("main-resize");
		$(document).triggerHandler("css-resize");
	}).resize() ;
});