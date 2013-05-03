function commentAction()
{
	$("#cmt_regist").unbind('focus').bind('focus',function(){$(this).prev().hide();});
	$("#cmt_regist").unbind('blur').bind('blur',function(){ if($(this).val().length==0) $(this).prev().show(); });
	//로그인창보이기 : $("div.login_layer").trigger("open"); 
	//테스트
	$("div.cmt_add input[type='image']").unbind('click').bind('click',function(){ 
		$("div.login_layer").trigger("open"); 
	});
}

function ajaxComment(page)
{
	$.get(page,function(data){
		$("div.comment_wrap div.comment_area").empty().html( $(data).find('div.comment_area').html() ) ;
	});
}


//intro 별 액션
function mainAction(){ 
	// index 가 여러 페이지이므로 각각 페이지에 실행 부분을 넣는다.
}

/*
if(!window.console){
	console={
		 log:function(){}
		,group:function(){}
		,groupEnd:function(){}
	}
}
*/
//=====================================================
$.fn.onoff_link = function( target , eventType ){
	var $this = $(this) ;
	$(this).delegate(target , eventType , function(e){
		e.preventDefault();
		$(document).triggerHandler("onoff-handle", {target:$this});
	});

	//초기화
	$(document).triggerHandler("onoff-handle", {target:$this,val:"remove"});
	return $(this) ;
}

$.fn.mouseMove = function(opt){
	var $box = opt.box ;
	var defaultX = opt.x ;
	var defaultY = opt.y ;
	if( typeof defaultX != "number" ) defaultX = 0 ;
	if( typeof defaultY != "number" ) defaultY = 0 ;
	if( $box.size() == 0 ) return $(this) ;
	$(this).bind('mousemove', function(e){
		var l = (e.offsetX || e.clientX - $(e.target).offset().left);
		var t = (e.offsetY || e.clientY - $(e.target).offset().top);
		var $img = $(this) ; 
		var xSize = ($box.width() - $img.width() )/$img.width() ;
		var ySize = ($box.height()- $img.height())/$img.height();
				
		var ll = Math.ceil(xSize * l) + defaultX;
		var tt = Math.ceil(ySize * t) + defaultY;
		
		$img.css({marginLeft:ll,marginTop:tt}) ;
	});

	return $(this) ;
}

//png 버그
$.fn.fadeInMsie = function( speed , opt){
	if( typeof opt != "function" )
		opt = function(){} ;
	if( $.browser.msie && $.browser.version <= 8 ) {
		$(this).show() ;
		opt() ;
	}else{
		$(this).fadeIn(speed,opt) ;
	}
	return $(this) ;
}
$.fn.fadeOutMsie = function( speed , opt){
	if( typeof opt != "function" )
		opt = function(){} ;
	if( $.browser.msie && $.browser.version <= 8 ) {
		$(this).hide() ;
		opt() ;
	}else{
		$(this).fadeOut(speed,opt) ;
	}
	return $(this) ;
}


$.getDocHeight = function(){
     var D = document;
     return Math.max(Math.max(D.body.scrollHeight,    D.documentElement.scrollHeight), Math.max(D.body.offsetHeight, D.documentElement.offsetHeight), Math.max(D.body.clientHeight, D.documentElement.clientHeight));
};

$.getDocWidth = function(){
     var D = document;
     return Math.max(Math.max(D.body.scrollWidth,    D.documentElement.scrollWidth), Math.max(D.body.offsetWidth, D.documentElement.offsetWidth), Math.max(D.body.clientWidth, D.documentElement.clientWidth));
};


// =======================================
$.flareAjaxPageAnimate = function(path, opt, callback){
	var optAnimate = {
		 duration:800
		,easing:"easeOutCubic"
		,complete:function(){
			// 이전 내용을 지운다.
			if( $("#contents > div.article").size() > 1 )
			{
				$("#contents > div.article:first").remove() ;
				$("#contents > div.article").slice(1).remove() ;
			}

			//레어이 팝업 이후에 zindex 조정
			$("#contents").css({zIndex:25});
			
			// 새로운 맵에 대한 정의
			$(document).triggerHandler('img_map_area');
			
			if($(document).data('isUnAction'))
				$(document).triggerHandler('mouseWheelAction') ;
			$(document).data('isActionIng' , false ) ;
			if( typeof callback == "function" ) callback() ;
		} 
	}
	
	$.get(path,function(htmlStr){
		var html_data = $("<div>"+htmlStr+"</div>").find("#contents").html() ;
		//$("#contents > div:eq(0)").before($(html_data).hide()) ;
		$("#contents > div:eq(0)").after($(html_data).hide()) ;

		var $g = $("#contents >  div:eq(1)") ;
		//$("#contents > div").stop().fadeOutMsie(1000);
		if( opt == "actionUp" ){
			$g.css({top:$(window).height()}).show()
			.stop().animate({top:0}, optAnimate);
		}else if( opt == "actionDown" ){
			$g.css({top:$(window).height()*-1}).show()
			.stop().animate({top:0}, optAnimate);
		}else if( opt == "actionLeft" ){
			$g.css({left:$(window).width()*-1}).show()
			.stop().animate({left:0}, optAnimate);
		}else if( opt == "actionRight" ){
			$g.css({left:$(window).width()}).show()
			.stop().animate({left:0}, optAnimate);
		}
	});

	return $ ;
}

// =================================================================== function
function lnbSubPageOn(parentIdx, idx)
{
	var ret = null;
	$(".lnb_sub").eq(parentIdx).find("li").each(function(i){
		if( $(this).hasClass("pageOn") )
			ret = i ;
	});
	if( !isNaN(idx) )
	{
		$(".lnb_sub li").removeClass("pageOn") ;
		$(".lnb_sub").eq(parentIdx).find("li").eq(idx).addClass("pageOn") ;
	}
	return ret ;
}
function lnbPageOn(idx)
{
	var ret = null;
	$(".lnb > li").each(function(i){
		if( $(this).hasClass("pageOn") )
			ret = i ;

	});

	if( !isNaN(idx) )
	{
		$(".lnb > li").removeClass("pageOn").eq(idx).addClass("pageOn") ;
		lnbImgChange(idx) ;
	}
	
	return ret ;
}

function lnbImgChange(idx)
{
	var $img = null ;
	$(".lnb > li").each(function(i){
		if( idx == i )
		{
			$img = $(this).addClass("on").find('img') ;
			$img.attr('src',$img.attr('src').replace('_off.png', '_on.png')) ;
		}else{
			$img = $(this).removeClass("on").find('img') ;			
			$img.attr('src',$img.attr('src').replace('_on.png', '_off.png')) ;
		}
	});
	
}
function actionFalse()
{
	$(document).data('isActionIng' , false ) ;
	return false ;
}

var endingIdx = null ;
function endingAction(step)
{
	if( $("#contents > div").is(":animated") )
		return ;

	if( endingIdx == null ){
		endingIdx = 0 ;
	}else
		endingIdx += step ;

	if( endingIdx < 0 )
	{
		endingIdx += step ;
		$(".lnb").removeClass("ending");
		$(".lnb_sub:last li:last a").triggerHandler('click',{callback:function(){
			$("div#container ul.controll img:eq(0)").triggerHandler('mouseout');
			$("div#container ul.controll img:eq(1)").triggerHandler('mouseout');
		}});
		return ;
	}
	
	if( endingIdx >= $(".lnb_end li a").size() )
	{
		$("div#container ul.controll img:eq(0)").triggerHandler('mouseout');
		endingIdx -= step ;
		return ;
	}
	$(".lnb_end li a").eq(endingIdx).triggerHandler('click',{callback:function(){
		$("div#container ul.controll img:eq(0)").triggerHandler('mouseout');
		$("div#container ul.controll img:eq(1)").triggerHandler('mouseout');
	}});
}

//============================================== bind
$(document).bind("onoff-handle",function(e,o){
	var $target = o.target ;
	var val		= o.val ;
	if( val == "add" ){
		$target.addClass("on");
		return true;
	}
	if( val == "remove" ){
		$target.removeClass("on");
		return false;
	}

	if($target.hasClass("on")){
		$target.removeClass("on");
		return false ;
	}

	$target.addClass("on");
	return true ;
});

$(document).bind("img_map_area", function(){
	var over = function (idx,e){
		if( isNaN(idx) ) return ;
		var $t = $(".product_layer").eq(idx).show() ;
		var l = (e.pageX - $("div#contents div.section").offset().left ) ;
		var t = (e.pageY - $("div#contents div.section").offset().top) ;
		l += 10 ;
		t +=  - $t.height() - 40 ;
		
		$t.css( {top:t,left:l} ) ;
	};
	var out = function (idx,x,y){
		if( isNaN(idx) && idx < 0 ) 
			$(".product_layer").hide() ;
		else
			$(".product_layer").eq(idx).hide() ;
	};

	$("#contents map area").bind('mousemove', function(e){
		var idx = $("#contents map area").index( $(this) ) ;
		over(idx,e) ;
	});
	$("#contents map area").bind('mouseout', function(e){
		var idx = $("#contents map area").index( $(this) ) ;
		out(idx) ;
	});
	$(".product_layer").bind('mousemove', function(e){
		var idx = $(".product_layer").index( $(this) ) ;
		over(idx,e) ;
	});
	$(".product_layer").bind('mouseout', function(e){
		var idx = $(".product_layer").index( $(this) ) ;
		out(idx) ;
	});

	$("#contents map area, div.product_layer a, div.layer_wrap ul.thumb_a1 a").bind('click', function(e){
		e.preventDefault() ;
		e.stopPropagation();
		var page = $(this).attr('href') ;
		if(page.substring(0,1)=="#")  return false;

		$.get(page,function(htmlStr){
			$(".pop_data:eq(0)").fadeOutMsie("fast",function(){$(this).remove();});
			var $layer = $($(htmlStr).find("#contents").html()).hide() ;
			$("#contents > div:eq(0)").after($layer) ;
			$layer.fadeInMsie("fast").addClass("pop_data");
			$(document).triggerHandler('layer_exec');
		}) ;
	});
	
	if( $("div.enlarge_layer").size() >= 1 )
	{
		$("#contents img.theme_img").css({cursor:"pointer"}).unbind('click').bind('click',function(e){
			$(document).triggerHandler('unmouseWheelAction') ;
			e.preventDefault() ;
			e.stopPropagation();
			$("#contents").css({zIndex:40});
			$("ul.social").css({zIndex:0});
			$("div.enlarge_layer").hide().removeClass("none").fadeInMsie("fast") ;
		});


		$("div.enlarge_layer img:first").css({cursor:'move'}).mouseMove({box:$("div.enlarge_layer")});
		$("div.enlarge_layer a.btn_close, div.enlarge_layer").bind('click',function(e){
			e.preventDefault() ;
			e.stopPropagation();
			$("#contents").css({zIndex:25});
			$("ul.social").css({zIndex:49});
			$("div.enlarge_layer").stop().fadeOutMsie("fast");
			$(document).triggerHandler('mouseWheelAction') ;
		});
	}

	$(window).triggerHandler('resize');

	// ending 용
	$("div.opa5_000").hide().removeClass("none") ;
	$("div.login_layer").hide().removeClass("none") ;
	$("div.mileage_layer").hide().removeClass("none") ;
	$("div.mileage a").bind('click', function(e){
		e.preventDefault();
		$("div.opa5_000").fadeInMsie("fast");
		$("div.mileage_layer").fadeInMsie("fast");
	});
	$("div.mileage_layer div.btn_close a, div.mileage_layer div.ac a:eq(1)").bind('click',function(e){
		e.preventDefault() ;
		$("div.opa5_000").fadeOutMsie("fast");
		$("div.mileage_layer").fadeOutMsie("fast");
	});

	// 로그인 보이는곳이 없다.
	$("div.login_layer div.btn_close a").bind('click',function(e){
		e.preventDefault() ;
		$("div.opa5_000").fadeOutMsie("fast");
		$("div.login_layer").fadeOutMsie("fast");
	});
	$("div.login_layer").bind('open',function(){
		$("div.opa5_000").fadeInMsie("fast");
		$(this).fadeInMsie("fast");
	});
}) ;


$(document).bind("layer_exec",function(){
	$(document).triggerHandler('unmouseWheelAction') ;
	$("#contents").css({zIndex:40});
	$("ul.social").css({zIndex:0});
	

	$(".layer_wrap").find('.btn_close').unbind('click')
		.bind('click', function(e){
		e.preventDefault() ;
		e.stopPropagation();
		$(".layer_wrap").parent().fadeOutMsie("fast",function(){
			$("#contents").css({zIndex:25});
			$("ul.social").css({zIndex:49});
			$(document).triggerHandler('mouseWheelAction') ;
			$(this).remove() ;
		});
	}) ;

	
	$(".item_view_blowup a.blowup").unbind('click').bind('click', function(e){
		e.preventDefault() ;
		e.stopPropagation();
		$(".item_view_blowup").fadeOutMsie('slow',function(){
			$(document).triggerHandler('mouseWheelAction') ;
		});
	});

	$(".item_view div.photo a, .item_view ul.thumb_a1 a").unbind('click').bind('click', function(e){
		e.preventDefault() ;
		e.stopPropagation();
		var src = $(this).attr('href');
		
		$(".item_view_blowup > div > img").attr('src', src).css({marginLeft:0,marginTop:0}) ;
		$(".item_view_blowup").hide().removeClass("none").fadeInMsie('slow',function(){
			$(".item_view_blowup > div > img").css({cursor:'move'}).mouseMove({box:$(".item_view_blowup > div")});
		});
	});
	
}) ;


$(document).data('isActionIng' , false ) ;
$(document).bind('mouseWheelAction',function(){
	// 마우스 휠
	actionFalse();
	$('#wrapper')
		.unmousewheel()
		.mousewheel(function(event, delta, deltaX, deltaY) {
			if( $(document).data('isActionIng') )
			{
				actionFalse();
				return true ;
			}
			$(document).data('isActionIng', true) ;

			if( $("#contents div").is(":animated") )
				return true ;

			var o = '';
			var opt = {
				callback:function(){
					$("div#container ul.controll img:eq(0)").triggerHandler('mouseout');
				}
			}
			if (delta > 0 ){// 좌  와 같음
				if( $(document).scrollTop() == 0)
					if( $('ul.lnb li').hasClass("pageOn") || $('ul.lnb').hasClass("ending")){
						$("div#container ul.controll img:eq(1)").triggerHandler('mouseenter');
						$(".btn_l a").triggerHandler('click',{callback:function(){
							$("div#container ul.controll img:eq(1)").triggerHandler('mouseout');
						}}) ;
					}
			}else if (delta < 0){// 우  와 같음
				if( !$('ul.lnb li').hasClass("pageOn") && !$('ul.lnb').hasClass("ending") ){
					$("div#container ul.controll img:eq(0)").triggerHandler('mouseenter');
					$("ul.lnb a").eq(0).triggerHandler('click',opt) ;
				}else if( $(document).scrollTop() > 0 && $.getDocHeight() - $(document).scrollTop() == $(window).height() ){
					$("div#container ul.controll img:eq(0)").triggerHandler('mouseenter');
					$(".btn_r a").triggerHandler('click',opt) ;
				}else if( $(document).scrollTop() == 0 && $.getDocHeight() <= $(window).height() + 100 ){
					$("div#container ul.controll img:eq(0)").triggerHandler('mouseenter');
					$(".btn_r a").triggerHandler('click',opt) ;				
				}				
			}
		});

	// 키보드
	$(document).unbind("keyboardAction").bind("keyboardAction",function(e,o){
		if( $(document).data('isActionIng') )
		{
			actionFalse();
			return true ;
		}
		$(document).data('isActionIng', true) ;

		var lnbIdx		= lnbPageOn("index");
		var lnbSubIdx	= lnbSubPageOn(lnbIdx, "index");
		
		if( $("#contents div").is(":animated") )
			return true ;

		switch(o.keycode){
			case 37 : // 좌
				if($(document).scrollLeft() > 0 && $.getDocWidth() - $(document).scrollLeft() > $(window).width() )
					return actionFalse();
				if( lnbIdx == null ) return actionFalse();

				$("div#container ul.controll img:eq(1)").triggerHandler('mouseenter');
				if( lnbSubIdx == 0 )
				{
					$(".lnb a").eq(lnbIdx).triggerHandler('click',{actionName:'actionLeft',callback:function(){
						$("div#container ul.controll img:eq(1)").triggerHandler('mouseout');
					}});
					return ;
				}

				if( lnbSubIdx > $(".lnb_sub").eq(lnbIdx).find("li a").size() - 1 ) 
					lnbSubIdx = $(".lnb_sub").eq(lnbIdx).find("li a").size() - 1 ;
				else lnbSubIdx -= 1;

				$(".lnb_sub").eq(lnbIdx).find("li a").eq(lnbSubIdx).triggerHandler('click',{actionName:'actionLeft',callback:function(){
					$("div#container ul.controll img:eq(1)").triggerHandler('mouseout');
				}});
				break ;
			case 39 : // 우 
				if( $(document).scrollLeft() != 0 && !($.getDocWidth() - $(document).scrollLeft() == $(window).width()) )
					return actionFalse();
				if( lnbIdx == null ) return actionFalse();

				$("div#container ul.controll img:eq(0)").triggerHandler('mouseenter');
				if( lnbSubIdx == $(".lnb_sub").eq(lnbIdx).find("li a").size() - 1 )
				{
					$(".lnb a").eq(lnbIdx).triggerHandler('click',{actionName:'actionRight',callback:function(){
						$("div#container ul.controll img:eq(0)").triggerHandler('mouseout');
					}});
					return ;
				}
				

				if( lnbSubIdx == null ) lnbSubIdx = 0 ;
				else lnbSubIdx += 1;

				console.log(lnbSubIdx+'ee' +":"+ $(document).scrollLeft() +":"+ lnbIdx) ;
				$(".lnb_sub").eq(lnbIdx).find("li a").eq(lnbSubIdx).triggerHandler('click',{callback:function(){
					$("div#container ul.controll img:eq(0)").triggerHandler('mouseout');
				}});
				break ;
				
			case 38 : // 상
				if( $(document).scrollTop() != 0 )
					return actionFalse();

				if( lnbIdx == 0 && !$(".lnb").hasClass("ending"))
				{
					$("h1 a").triggerHandler('click');
					return ;
				}else if( $(".lnb").hasClass("ending") )
				{
					$(".lnb").removeClass("ending");
					$(".lnb a").eq($(".lnb a").size()-1).triggerHandler('click',{actionName:'actionDown'}) ;
					return actionFalse();
				}else if( lnbIdx == null && !$(".lnb").hasClass("ending") )
				{
					return actionFalse();
				}
				
				var $lnb = $(".lnb a").eq(--lnbIdx) ;
				if( $lnb.size() >= 1 )
					$lnb.triggerHandler('click') ;
				
				break ;
			case 40 : // 하 
				if( $(document).scrollTop() > 0 && $.getDocHeight() - $(document).scrollTop() > $(window).height() )
					return actionFalse();

				if( $(".lnb").hasClass("ending") || lnbIdx == $(".lnb li").size() - 1 )
				{
					$('.lnb').addClass('ending') ;
					endingAction(1) ;
					return actionFalse();
				}
				$('.lnb').removeClass('ending') ;
				
				if( lnbIdx == null ) lnbIdx = 0 ;
				else lnbIdx += 1 ;

				$(".lnb a").eq(lnbIdx).triggerHandler('click') ;
				break ;
		}
	});
});
$(document).bind('unmouseWheelAction',function(){
	$(document).data('isUnAction' , true ) ;
	$('#wrapper').unmousewheel() ;
	$(document).unbind('keyboardAction');
});

//=================================================================
$(document).ready(function(){
	$("h1 a").bind('click', function(e){
		e.preventDefault() ;
		if( $("#contents div").is(":animated") )
			return false ;


		$("ul.controll img:eq(0)").triggerHandler('mouseout');
		$("ul.controll img:eq(1)").triggerHandler('mouseout');
		$("ul.controll").fadeOutMsie("slow",function(){
			$(this).addClass('none') ;
		});

		// 메인으로 초기화...
		$.flareAjaxPageAnimate($(this).attr("href"), "actionDown" , function(){
			$(".lnb li").removeClass("pageOn").removeClass("on");
			$(".lnb").fadeOutMsie("fast");
			lnbImgChange("ALL");
			mainAction() ;
		});
	});
	mainAction() ;
	/***************/
	/* 다른호 보기 */
	$("dl.other_arc").onoff_link("dt a","click") ;

	/***************/
	/*   lnb 
	*/
	// focus, over, blur, out action
	

	var focus = function(){
		clearTimeout($(".lnb").data('timer'));

		var idx = $(".lnb a").index($(this));
		lnbImgChange(idx);
	} ;

	$(".lnb").delegate('a','mouseenter focus', focus);
	
	var reset = function(){
		clearTimeout($(".lnb").data('timer'));
		$(".lnb").data('timer', setTimeout(function(){
			$(".lnb > li").each(function(i){
				if($(this).hasClass("pageOn")){
					$img = $(this).addClass("on").find('img') ;
					$img.attr('src',$img.attr('src').replace('_off.png', '_on.png')) ;
				}else{
					$img = $(this).removeClass("on").find('img') ;			
					$img.attr('src',$img.attr('src').replace('_on.png', '_off.png')) ;
				}
			});
		},300));
	} ;

	$(".lnb").delegate('a','blur', reset);
	$(".lnb").hover(function(){}, reset );
	// end // focus, over, blur, out action	

	$(".lnb a").bind('click', function(e,opt){
		e.preventDefault();

		if( $("#contents div").is(":animated") )
			return false ;

		$(".lnb").removeClass("ending");
		endingIdx = null ;
		var idx = $(".lnb a").index($(this));
		var callIdx = lnbPageOn(idx);

		var isAnimate = false ;
		var path = '' ;
		var actionName = 'actionDown' ;
		if( idx > callIdx || callIdx == null )	{isAnimate = true ; actionName = 'actionUp' ;}
		else if( idx < callIdx )	{isAnimate = true ;}
		else if( callIdx >= 0 )		{isAnimate = true ;}
		// idx != callIdx && 조건 제외 이전버튼때 문제가 있네...
		if( typeof opt == "object" && typeof opt.actionName == "string" && (opt.actionName == 'actionLeft' || opt.actionName == 'actionRight' || opt.actionName == 'actionDown') )
			actionName = opt.actionName ;

		var callback = function(){} ;
		if( typeof opt == "object" && typeof opt.callback == "function" )
			callback = opt.callback ;
		
		if(isAnimate)
		{
			$.flareAjaxPageAnimate($(".lnb > li").eq(idx).find('a').attr("href"), actionName , function(){
				$(".lnb_sub li").removeClass("pageOn");
				if( $("ul.controll").hasClass('none') )
					$("ul.controll").hide().removeClass('none').fadeInMsie("fast");
				
				callback() ;
				lnbImgChange(idx);
				themeAction() ;
			});
		}

	});
	////////////////////////////////// lnb 끝
	$("div#container ul.controll img").hover(function(){
		$(this).attr('src', $(this).attr('src').replace('_off.png', '_on.png') );
	},function(){
		$(this).attr('src', $(this).attr('src').replace('_on.png', '_off.png') );
	});

	
	// 다음 돌기
	$(".btn_r a").bind('click',function(e,opt){
		e.preventDefault() ;
		var dOpt = {
			callback:function(){$("div#container ul.controll img:eq(0)").triggerHandler('mouseout');}
		} ;

		$.extend(dOpt, opt);
		
		if( $("#contents div").is(":animated") )
		{
			dOpt.callback() ;
			return false ;
		}

		var pageOnIdx = null ;
		var selectedThemeIdx = lnbPageOn("index") ;
		$(".lnb_sub:eq("+selectedThemeIdx+") li").each(function(i){
			if( $(this).hasClass("pageOn") )
				pageOnIdx = i ;
		});
		
		var liSize = $(".lnb_sub:eq("+selectedThemeIdx+") li").size() ;

		if( $('.lnb').hasClass('ending') || $('.lnb li').size() - 1 == selectedThemeIdx && pageOnIdx != null && pageOnIdx + 1 >= liSize ){
			$('.lnb').addClass('ending') ;
			endingAction(1);
		}else if( pageOnIdx + 1 < liSize && pageOnIdx != null ){
			$(".lnb_sub:eq("+selectedThemeIdx+") li").eq(pageOnIdx+1).find('a').triggerHandler('click',dOpt);		
		}else if( pageOnIdx != null && pageOnIdx + 1 >= liSize ){
			$(".lnb a").eq(selectedThemeIdx+1).trigger('click',dOpt);		
		}else{
			$(".lnb_sub:eq("+selectedThemeIdx+") li:eq(0)").find('a').triggerHandler('click',dOpt);
		}

	});

	// 이전 돌기
	$(".btn_l a").bind('click',function(e,opt){
		e.preventDefault() ;
		
		if( $("#contents div").is(":animated") )
			return false ;

		var pageOnIdx = null ;
		var selectedThemeIdx = lnbPageOn("index") ;
		$(".lnb_sub:eq("+selectedThemeIdx+") li").each(function(i){
			if( $(this).hasClass("pageOn") )
				pageOnIdx = i ;
		});

		if( $('.lnb').hasClass('ending') ){
			endingAction(-1);
		}else if ( selectedThemeIdx == 0 && pageOnIdx == null ){
			// 이전이 없을땐 메인으로 돌아간다.
			$("h1 a").triggerHandler('click');
		}else if ( selectedThemeIdx == 0 && pageOnIdx == 0 ){
			$(".lnb a").eq(0).trigger('click',opt);	
		}else if( selectedThemeIdx > 0 && pageOnIdx == null ){
			$(".lnb_sub:eq("+(selectedThemeIdx-1)+") li:last").addClass("back").find('a').triggerHandler('click',opt);
		}else if( selectedThemeIdx > 0 && pageOnIdx == 0 ){
			$(".lnb a").eq(selectedThemeIdx).trigger('click',opt);	
		}else if( pageOnIdx > 0 ){
			$(".lnb_sub:eq("+(selectedThemeIdx)+") li").eq(pageOnIdx-1).find('a').triggerHandler('click',opt);
		}
		
	});

	// 확대보기
	$(".enlarge a").bind('click',function(e){
		$("#contents img.theme_img").triggerHandler('click');
	});
	////////////////////////////////
	
	$(".lnb_sub li a").bind('click',function(e,opt){
		e.preventDefault() ;

		$("ul.controll").fadeInMsie("slow");
		if( $("#contents div").is(":animated") )
			return false ;

		$(".lnb").removeClass("ending");
		endingIdx = null ;

		var themeIndex = $(".lnb_sub").index($(this).parent().parent());
		var subIndex = $(".lnb_sub").eq(themeIndex).find("li a").index($(this));
		lnbPageOn(themeIndex);
		var callIdx = lnbSubPageOn(themeIndex, subIndex) ;

		var href = $(this).attr("href");
		var actionName = 'actionLeft' ;
		if( callIdx <= subIndex )
			actionName = 'actionRight' ;
		if( $(this).parent().hasClass('back') )
		{
			$(this).parent().removeClass('back') ;
			actionName = 'actionLeft' ;
		}
		
		if( typeof opt == "object" && typeof opt.actionName == "string" && (opt.actionName == 'actionLeft' || opt.actionName == 'actionRight') )
			actionName = opt.actionName ;
		var callback = function(){} ;
		if( typeof opt == "object" && typeof opt.callback == "function" )
			callback = opt.callback ;

		$.flareAjaxPageAnimate(href, actionName , callback) ;
	});
	
	$(".lnb_end li a").bind('click',function(e, opt){
		e.preventDefault() ;
		var dOpt = {
			callback:function(){}
		} ;

		$.extend(dOpt, opt);
		$("ul.controll").fadeInMsie("slow");

		if( $("#contents > div").is(":animated") ){
			dOpt.callback();
			return ;
		}
			

		var endingIndex = $(".lnb_end li").index($(this).parent());
		if( endingIndex >= $(".lnb_end li").size() )
		{
			dOpt.callback();
			return ;
		}
		

		var href = $(this).attr("href");
		var actionName = 'actionUp' ;

		$.flareAjaxPageAnimate(href, actionName, function(){
			$(".lnb li").removeClass("pageOn").removeClass("on");
			lnbImgChange("ALL");

			dOpt.callback();
			commentAction() ;
		}) ;
	});

	/**
	* GNB ajax 호출
	*/
	$("a.ajax_mask").bind('click', function(e){
		e.preventDefault() ;
		var page = $(this).attr('href') ;
		if(page.substring(0,1)=="#") return false;

		$.get(page,function(htmlStr){
			$(".pop_data:eq(0)").fadeOutMsie("fast",function(){$(this).remove();});
			var $layer = $($(htmlStr).find("#contents").html()).hide() ;
			$("#contents > div:eq(0)").after($layer) ;
			$layer.fadeInMsie("fast").addClass("pop_data");
			$(document).triggerHandler('layer_exec');
			$(document).triggerHandler('img_map_area');
		}) ;
	});

	$(document).triggerHandler('mouseWheelAction') ;

	

	$(document).bind('keyup',function(e){
		$(document).triggerHandler('keyboardAction', {keycode:e.keyCode});
	});

	$(window).bind('resize', function(){
		var w = $(window).width();
		var h = $(window).height();

		if( h <= 846 ){
			$("#wrapper").width(w).height("846px");
			$(".enlarge_layer").width(w).height("800px");
			$("#contents").width(w).height("846px").css({marginBottom:-46});
			return ;
		}
		$("#contents").width(w).height(h);
		$("#wrapper").width(w).height(h);
		$(".enlarge_layer").width(w).height(h-$("#gnb").height());

		
	}).resize();
});