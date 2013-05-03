
/*********************************************/
/*************        SUB       **************/
/*********************************************/
$(document).bind("sub.set.service", function(){
	var viewIndex = -1 ;
	$("div.nav_service div.depth_in").css({position:'relative'});
	$("div.nav_service ul#nav1 > li > a").bind('mouseenter focus', function(e){
		//console.log('ul#nav1 a ');
		var idx = $("div.nav_service ul#nav1 > li > a").index($(this));
		//console.log( e.type + ":" + $("ul#nav1 > li").eq(idx).hasClass("on") +":"+idx ) ;
		$("ul#nav1 > li").removeClass("on").eq(idx).addClass("on") ;
		// 기존과 같으면 fade가 없다.

		
		var $target = $("ul#nav1") ;

		if( viewIndex == idx )
		{
			$target.find(".depth").hide().find(".depth_in").hide() ;
				$(this).parent().find(".depth").show().end().find(".depth_in")
				.stop().show().animate({height:198,opacity:1},{duration:400,easing:"easeOutCubic",complete:function(){}}) ;
			return ;
		}

		if( !$target.hasClass('depth_on') )
		{
			$target.find(".depth").hide().find(".depth_in").hide() ;
				$(this).parent().find(".depth").show().end().find(".depth_in")
				.stop().css({height:0})
				.show().animate({height:198,opacity:1},{duration:400,easing:"easeOutCubic",complete:function(){}}) ;

			$target.addClass('depth_on');
		}else{
			$target.find(".depth").hide().find(".depth_in").hide() ;
			$(this).parent().find(".depth").show().end().find(".depth_in").css({height:198,opacity:0}).show()
				.stop().animate({opacity:1},{duration:300,complete:function(){}}) ;
		}
		
		viewIndex = idx ;
	});
	$("div.nav_service ul.sublist > li > a").bind('mouseenter focus', function(e){
		$(this).parent().parent().find("> li").removeClass("on").end().find("ul").removeClass("block") ;
		$(this).parent().addClass("on").find("ul").addClass("block") ;
	});
	$("div.nav_service ul.sublist ul > li > a").bind('mouseenter focus', function(e){
		$(this).parent().parent().find("> li").removeClass("on") ;
		$(this).parent().addClass("on") ;
	});
	
	$("ul#nav1").bind('mouseleave', function(){
		$(this).removeClass('depth_on').find(".depth_in").stop().animate({height:0,opacity:0},{duration:400,easing:"easeOutCubic",complete:function(){
			$("ul#nav1 li").removeClass("on") ;
			$(this).parent().hide() ;
			$("ul#nav1").removeClass('depth_on');
		}})
		/*
		var resetMenuIndex = $("div.nav_service").data("viewIndex") ;
		if( typeof resetMenuIndex == "object" && resetMenuIndex.length == 3 )
		{
			if( !isNaN(resetMenuIndex.topViewIndex) )
				$("ul#nav1 > li").removeClass("on").eq(resetMenuIndex.topViewIndex).addClass("on") ;
			if( !isNaN(resetMenuIndex.subViewIndex) )
				$("div.nav_service ul.sublist > li > a").eq(resetMenuIndex.subViewIndex).triggerHandler('focus');
			if(  !isNaN(resetMenuIndex.subViewIndex) && !isNaN(resetMenuIndex.subSubViewIndex) )
				$("div.nav_service ul.sublist > li").eq(resetMenuIndex.subViewIndex)
					.find("ul > li > a").eq(resetMenuIndex.subSubViewIndex).triggerHandler('focus');
		}
		*/
		
		viewIndex = -1 ;
	});

	$("ul.util_nav").delegate('a', 'focus', function(e){
		// 키보드 접근시 사리진다.
		if( $("ul#nav1").hasClass('depth_on') )
			$("ul#nav1").triggerHandler('mouseleave');
	});
});
$(document).bind("sub.unset.service", function(){
	$("div.nav_service ul#nav1 > li > a").unbind('mouseenter focus');
	$("div.nav_service ul.sublist > li > a").unbind('mouseenter focus');
	$("ul#nav1").unbind('mouseleave');

	$("ul#nav1").removeClass('depth_on').find(".depth").attr('style','').find(".depth_in").attr('style','')
		.find("li").removeClass("on").find("ul").removeClass("block") ;
});
/********** sub 구분 ***************/

$(document).bind("sub.set.branch", function(){
	$("div#side ul#nav2 a").bind('mouseenter focus', function(){
		$(this).parent().addClass("on");
		// 키보드 접근시 사리진다.
		$("ul#nav1").triggerHandler('mouseleave');
	}) ;
	$("div#side a").bind('mouseleave blur', function(){$(this).parent().removeClass("on");}) ;
});
$(document).bind("sub.unset.branch", function(){
	$("div#side a").parent().removeClass("on");
	$("div#side ul#nav2 a").unbind('mouseenter focus') ;
	$("div#side ul#nav2 a").unbind('mouseleave blur') ;
});



/*********************************************/
/*************      MOBLIE      **************/
/*********************************************/
$(document).bind("mobile.set.branch", function(){
	$("div#side h2 a").bind('click', function(e){
		e.preventDefault() ;
		// 활성화 되어 있으면 활성화를 풀고 끝낸다		
		if( $(this).parent().hasClass("on") )
		{
			$(this).parent().removeClass("on").parent().find("> ul").removeClass("block") ;
			return  ;
		}
		$(this).parent().addClass("on").parent().find("> ul").addClass("block") ;
		$("div.nav_service").find("h2").removeClass("on").end().find("ul").removeClass("block").find("div.depth").removeClass("block");

		return ;
	}) ;
	$("div#side ul#nav2 > li > a").bind('click',function(e){
		if( $(this).parent().find('ul').size() < 1  )
			return ;
		
		e.preventDefault() ;
		if( $(this).parent().hasClass("on") )
		{
			//$("div#side ul#nav2 > li").removeClass("on").find("ul").removeClass("block");
			$("div#side ul#nav2 > li").removeClass("on");
			return  ;
		}
		$("div#side ul#nav2 > li").removeClass("on");
		//var $submenu = $(this).parent().addClass("on").find("ul") ;
		var $submenu = $(this).parent().addClass("on") ;
		/*
		if( $submenu.hasClass("block") )
			$submenu.removeClass("block") ;
		else{
			$(this).parent().parent().find("ul").removeClass("block");
			$submenu.addClass("block");
		}
		*/
	}) ;
});
$(document).bind("mobile.unset.branch", function(){
	$("div#side").find("h2").removeClass("on").end().find("ul").removeClass("block");
	$("div#side h2 a").unbind('click') ;
	$("div#side ul#nav2 > li > a").unbind('click') ;
});
/********** mobile 구분 ***************/

$(document).bind("mobile.set.service", function(){
	$("div.nav_service h2 a").bind('click', function(){
		// 활성화 되어 있으면 활성화를 풀고 끝낸다		
		if( $(this).parent().hasClass("on") )
		{
			$(this).parent().removeClass("on").parent().find("> ul").removeClass("block") ;
			return false ;
		}
		$(this).parent().addClass("on").parent().find("> ul").addClass("block") ;			
		$("div#side").find("h2").removeClass("on").end().find("ul").removeClass("block");

		return false ;
	}) ;
	$("div.nav_service ul#nav1 > li > a").bind('click',function(){
		//console.log('nav_service ul#nav1 > li > a - click');
		var $submenu = $(this).parent().find("div.depth") ;
		if( $submenu.hasClass("block") )
			$submenu.removeClass("block") ;
		else{
			$(this).parent().parent().find("div.depth").removeClass("block");
			$submenu.addClass("block");
		}
	}) ;
});
$(document).bind("mobile.unset.service", function(){
	$("div.nav_service").find("h2").removeClass("on").end().find("ul").removeClass("block").find("div.depth").removeClass("block");
	$("div.nav_service h2 a").unbind('click') ;
	$("div.nav_service ul#nav1 > li > a").unbind('click') ;
});
/*********************************************/
function is$Data(s)
{
	return $(document).data(s) == s  ;
}
function set$Data(s,s1)
{
	if( typeof s1 == "string" )
		 $(document).data(s,s1) ;
	else $(document).data(s,s) ;
}


$(function(){
	//resize 될때 필요한 것들을 bind 시킨다.
	$(document).bind("common-resize",function(){});

	$(document).bind("sub-resize",function(){
		if( $(window).width() <= 480 ){
			if( !is$Data("sub.unset.branch") )
			{
				set$Data("sub.set.branch"		,"") ;
				set$Data("sub.unset.branch"		,"sub.unset.branch") ;
				$(document).triggerHandler("sub.unset.branch");
				$(document).triggerHandler("sub.unset.service");
				$(document).triggerHandler("mobile.set.branch");
				$(document).triggerHandler("mobile.set.service");
			}
		}else{
			if( !is$Data("sub.set.branch") )
			{
				set$Data("sub.set.branch"		,"sub.set.branch") ;
				set$Data("sub.unset.branch"		,"") ;
				$(document).triggerHandler("sub.set.branch");
				$(document).triggerHandler("sub.set.service");
				$(document).triggerHandler("mobile.unset.branch");
				$(document).triggerHandler("mobile.unset.service");
			}
		}
	});

	$(window).bind('resize',function(){
		$(document).triggerHandler("sub-resize");
		$(document).triggerHandler("common-resize");
	}).resize() ;
});