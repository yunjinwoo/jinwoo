// numberToStrRepeat 
String.prototype.strRepeat = function( len , repeat_str )
{
	var val = this ;
	val = val+"";
	if( typeof repeat_str != "string" )
		repeat_str = "0" ;

	var step = repeat_str.length ;
	var s = '' ;
	for( i = len - val.length ; i > 0 ; i-=step )
		s += repeat_str ;

	return s + val ;
}
Number.prototype.strRepeat = String.prototype.strRepeat ;


function ajaxSubmitModalWrap(formObj)
{
	$.post( $(formObj).attr('action') , $(formObj).serialize() , function(data){
		$.__maskAjax_make(data,{
				// floor.js
				callback:function(){$(document).triggerHandler("popup_5Action");}
		}) ;
	});

	return false ;
}

// popup 된 창에 resize 함수가 포함되어 있다 
function windowOpen( page , w, h, n)
{
	var pop = {close:function(){}};
	try{
		if( typeof n != 'string' ) n = 'popup' ;
		pop = window.open( page, n, 'width='+w+',height='+h ) ;
		pop.focus() ;
		return false ;
	}catch(e){
		return true ;
	}
}
function setPng24(obj) {
    obj.width=obj.height=1;
    obj.className=obj.className.replace(/\bpng24\b/i,'');
    obj.style.filter = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+ obj.src +"',sizingMethod='image');"
    obj.src='';
    return '';
}


/*
function include( id , path )
{
	$.get(path,function(data){
		$("#"+id).html(data) ;
	});
}
*/

if(!window.console){
	console={
		 log:function(){}
		,group:function(){}
		,groupEnd:function(){}
	}
}
$(document).ready(function(){
	/** 링크 드롭다운 보기 **/
	//$("dl.dropdown").onoff_link("dt a","click") ;
	/** popup
	$("a.popup").bind("click",function(e){
		e.preventDefault();
		var page = $(this).attr('href') ;
		window.open( page , page, 'width=500,scrollbars=no' ).focus() ;	
	});
	 **/
	/** 검색 **/
	$("#total_srch").bind("focus",function(){	$(this).prev().hide();	});
	$("#total_srch").bind("blur" ,function(){	if( $(this).val() == "" ) $(this).prev().show();	});
	/** //검색 **/

	/** 지점 보기 **/
	$("#bsel").onoff_div({
		 btnOpen:$("h1 > span > a")
		,btnClose:$("#bsel p.btn a")
		,eventType:'click'}); 
	$("h1 > span > a").bind('click',function(e){
		e.preventDefault();
		if( $(window).width() <= 480 )
			if( $("#bsel").hasClass("on") )
				$("div.util_area").hide() ;
			else
				$("div.util_area").show() ;
	});
	$("#bsel p.btn a").bind('click',function(e){
		e.preventDefault();
		$("div.util_area").show() ;
	});

	$(document).bind("common-resize",function(){
		if( $(window).width() <= 480 ){
			if( $("#bsel").hasClass("on") )
				$("div.util_area").hide() ;
			else
				$("div.util_area").show() ;
		}else {
			$("div.util_area").show() ;
		}
	});

	/** 달력 보기 **/
	$("#calendar").onoff_div({
		 btnOpen:$("dl.schedule dt a")
		,btnClose:$("#calendar div.btn a")
		,eventType:'click'});


	$("div.calendar_wrap ul.artc > li > a").parentNone({className:"selectd"});
	$("div.calendar_wrap ul.artc > li > a").bind('click',function(e){
		e.preventDefault() ;
		var idx = $("div.calendar_wrap ul.artc > li > a").index($(this));
		$(".table_msg").hide().eq(idx).show();
	});
	$(".table_msg").hide().eq(0).show();


	/** 링크 드롭다운 보기 **/
	$("dl.dropdown").on_add_remove({target:["dd"]}) ;
	$("dl.dropdown2").on_add_remove({target:["dt","dd"]});

	// 본문 탭 공통
	// 탭에는 오버가 없다.
	//$(".tab_a1 li a").hover_parent_on();


	/* 롯데 갤러리 역영 */ 
	$(".photo_list li a").hover_parent_on();
	$(".gallery_prog .photo_list li a").bind('click', function(e){
		e.preventDefault() ;

		// hover_parent_on 초기화
		$(".gallery_prog .photo_list li").removeClass("pageOn").removeClass("on") ;
		$(this).parent().addClass("pageOn").addClass("on");

		var src = $(this).attr('href');
		var alt = $(this).find('img').attr('alt');
		$(".gallery_prog .pic").find('img').attr('src',src);
		$(".gallery_prog .pic").find('strong').html(alt);
	});
	$(".gallery_prog .btn a.pre").bind('click', function(e){
		e.preventDefault() ;
		
		var $back = null ;
		var isBack = false ;
		$(".gallery_prog .photo_list li a").each(function(i){
			if($(this).parent().hasClass("pageOn")){
				isBack = true ;
				if( $back == null )
					$back = $(".gallery_prog .photo_list li a:last");
			}
	
			if( !isBack )
				$back = $(this) ;
		});

		$back.triggerHandler("click");
	});	
	$(".gallery_prog .btn a.nxt").bind('click', function(e){
		e.preventDefault() ;
		
		var isNext	= false ;
		var size	= $(".gallery_prog .photo_list li a").size() - 1 ;
		var $next	= null ;
		$(".gallery_prog .photo_list li a").each(function(i){
			if(isNext){
				$next = $(this) ;
				isNext = false ;
			} 

			if($(this).parent().hasClass("pageOn"))
				isNext = true ;
		});

		if( $next == null )
			$next = $(".gallery_prog .photo_list li a:first")
		$next.triggerHandler("click");
	});	

	
	$(".photo_list2 li a").hover_parent_on();
	$(".photo_zone .photo_list2 li a").bind('click', function(e){
		e.preventDefault() ;

		// hover_parent_on 초기화
		$(".photo_zone .photo_list2 li").removeClass("pageOn").removeClass("on") ;
		$(this).parent().addClass("pageOn").addClass("on");

		var src = $(this).attr('href');
		var tit1 = $(this).find('span:first').html();
		var tit2 = $(this).find('span:last').html();
		$(".photo_zone .pic").find('img').attr('src',src);
		$(".photo_zone .pic").find('strong').html(tit2);
		$(".photo_zone dl dt").html(tit1);
	});	
	$(".photo_zone .btn a.pre").bind('click', function(e){
		e.preventDefault() ;
		
		var $back = null ;
		var isBack = false ;
		$(".photo_zone .photo_list2 li a").each(function(i){
			if($(this).parent().hasClass("pageOn")){
				isBack = true ;
				if( $back == null )
					$back = $(".photo_zone .photo_list2 li a:last");
			}
	
			if( !isBack )
				$back = $(this) ;
		});

		$back.triggerHandler("click");
	});	
	$(".photo_zone .btn a.nxt").bind('click', function(e){
		e.preventDefault() ;
		
		var isNext	= false ;
		var size	= $(".photo_zone .photo_list2 li a").size() - 1 ;
		var $next	= null ;
		$(".photo_zone .photo_list2 li a").each(function(i){
			if(isNext){
				$next = $(this) ;
				isNext = false ;
			} 

			if($(this).parent().hasClass("pageOn"))
				isNext = true ;
		});

		if( $next == null )
			$next = $(".photo_zone .photo_list2 li a:first")
		$next.triggerHandler("click");
	});	
	// 주요편의시설, 식당가 층별안내 링크 ) ;
	$(".multi_wrap ul.list_a7 li a").bind('click',function(e){
		e.preventDefault() ;
		$(this).maskAjax({
			cont : "#pop_lookbook",
			resizeType:'left',
			css:{backgroundColor:"#fff"},
			callback:function(){$(document).triggerHandler("pop_lookbook");}
		}) ;
	});

	
	/* // 롯데 갤러리 역영 */



	
	/* 쇼핑뉴스, 진행이벤트 */
	(function(delay){
		var btnStopFlag = false ;
		var stopFlag = false ;

		var $li		= $("div.roll_banner ul li");
		var $btn	= $("div.roll_banner span.page a");
		var viewIndex = 0 ;
		var viewSize = $li.size() ;
	
		$btn.bind("click",function(e){
			e.preventDefault() ;
			viewIndex = $btn.index($(this));

			$li.removeClass("view").hide()
				.eq(viewIndex).addClass("view").show() ;
			
			$btn.find("img").each(function(i){
				if( i == viewIndex )
					$(this).attr('src', $(this).attr('src').replace('_off.gif','_on.gif') );
				else
					$(this).attr('src', $(this).attr('src').replace('_on.gif','_off.gif') );
			});
		});

		$("div.roll_banner").hover(function(){
			stopFlag = true ;
		},function(){
			stopFlag = false ;
			timer = setTimeout(roll,delay);
		});

		$("div.roll_banner a").focus(function(){clearTimeout(timer);stopFlag = true ;}) ;
		$("div.roll_banner a").blur(function(){stopFlag = false ;timer = setTimeout(roll,delay);}) ;
		
		$("div.roll_banner .control a:eq(0)").bind('click' ,function(e){ e.preventDefault() ;btnStopFlag = false ; timer = setTimeout(roll,delay);});
		$("div.roll_banner .control a:eq(1)").bind('click' ,function(e){ e.preventDefault() ;btnStopFlag = true ; });
		
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

	if( $(".new_rgt .status dl dt a").size() >= 1 )
	{
		$(".new_rgt .status dl dt a").bind('click',function(e){
			e.preventDefault() ;
			var $t = $(this).parent().parent() ;
			var $img = $(this).find('img');
			if($t.hasClass('on')){
				$t.removeClass('on');
				$img.attr('src', $img.attr('src').replace('_down.gif','_top.gif') );
			}else{			
				$t.addClass('on');
				$img.attr('src', $img.attr('src').replace('_top.gif','_down.gif') );
			}
		});
	}
	/* // 쇼핑뉴스, 진행이벤트 */

	//제주 res1.html 
	$("div.lounge_photo").delegate('a','click',function(e){
		e.preventDefault() ;
		$('p img', e.delegateTarget).attr('src',$(this).attr('href')) ;
	});
	$("a.maskAjax2").bind('click',function(e){
		e.preventDefault() ;
		$(this).maskAjax({
			cont : "#modal_wrap2",
			resizeType:'ALL',
			callback:function(){}
		}) ;
	});
	$("a.maskAjaxLeft").bind('click',function(e){
		e.preventDefault() ;
		$(this).maskAjax({
			cont : "#modal_wrap3",
			resizeType:'left',
			callback:function(){}
		}) ;
	});
	$("a.maskAjaxLeft4").bind('click',function(e){
		e.preventDefault() ;
		$(this).maskAjax({
			cont : "#modal_wrap4",
			btnClose:'.btn_b2',
			resizeType:'left',
			callback:function(){}
		}) ;
	});
	$("a.maskAjaxLeft5").bind('click',function(e){
		e.preventDefault() ;
		$(this).maskAjax({
			cont : "#modal_wrap5",
			resizeType:'left',
			callback:function(){}
		}) ;
	});
	$("a.maskAjaxLeft6").bind('click',function(e){
		e.preventDefault() ;
		$(this).maskAjax({
			cont : "#modal_wrap6",
			resizeType:'left',
			callback:function(){}
		}) ;
	});
	$("a.maskAjaxLeft7").bind('click',function(e){
		e.preventDefault() ;
		$(this).maskAjax({
			cont : "#modal_wrap7",
			btnClose:'.btn_b2',
			resizeType:'left',
			callback:function(){}
		}) ;
	});

	//mypage #pop_dm
	$("a.noneAction").bind('click',function(e){
		e.preventDefault();
		var $t = $($(this).attr('href')) ;
		if($t.hasClass('none'))
		{
			$t.removeClass("none") ;
		}else{
			$t.addClass("none") ;
		}
	});
	$("#pop_dm").delegate('p.btn a','click',function(e){
		e.preventDefault() ;
		$(e.delegateTarget).addClass("none");
	});

	//mypage 위드유 마일리지
	$("ul.earn_list a").tab_a_none_parent_on({isImg:true});

	//멤버스 카드 소개
	$("ul.tab_c1 a").tab_a_none_parent_on();
	
	
});

$(function(){
/** 네비 안 베너 보기 **/
	$("div.banner").each(function(num){
		$(this).find('a:even').bind('click',function(e){
			e.preventDefault();
			$("div.banner").eq(num).find("a:odd").hide() ;
			$($(this).attr("href")).show() ;

			var idx = $(this).parent().parent().find("a:even").index($(this));
			$(this).parent().parent().find("a:even img").each(function(i){
				if( idx == i )
					$(this).attr('src', $(this).attr('src').replace('_off.gif','_on.gif'));
				else
					$(this).attr('src', $(this).attr('src').replace('_on.gif','_off.gif'));
			});

			return false ;
		}) ;

		$(this).find('a:even').eq(0).triggerHandler("click") ;
	});
});

// 모션
$(function(){
	function ulDisplayOneCreate( $target )
	{
		if( $target.data('ulDisplayOneCreate') == "create" )
			return ;
		
		$target.data('ulDisplayOneCreate', "create");
		$target.find("ul").width( $target.find("ul li:first").width() );
		$target.ulDisplayOne().find("ul").resizeWidth("li",1).end();
	}
	function ulDisplayOneRemove( $target )
	{
		if( $target.data('ulDisplayOneCreate') != "create" )
			return ;
		
		$target.data('ulDisplayOneCreate', "remove");
		$target.find("ul").unwrap().attr('style','') ;
		$target.find("ul li a").unbind('focus');
	}
	$(document).bind("common-resize",function(){
		if( $(window).width() < 1001 ){
			ulDisplayOneCreate($(".selreop"));
		}else {
			 ulDisplayOneRemove($(".selreop"));
		}
	});
	$(".have").ulDisplayOne().find("ul").resizeWidth("li",1).end();
});
	//========================

(function($){
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

	//마이페이지 사은행사장 안내
	$(document).bind("venue_list-li_bg",function(){
		if( $(window).width() <= 1000 )
			$("ul.venue_list").each(function(){
				$(this).find('li').removeClass('bg').end().find("li:odd").addClass("bg");
			}) ;
		else
			$("ul.venue_list").each(function(){
				$(this).find('li').removeClass('bg').each(function(i){
					var k = i % 4 ;
					if( k >= 2 ){
						$(this).addClass("bg");
					}
				});
			});
	});
	$(document).data("venue_list-li_bg_timer", null) ;
	$(document).bind("common-resize",function(){
		clearTimeout( $(document).data("venue_list-li_bg_timer") ) ;
		$(document).data("venue_list-li_bg_timer", setTimeout(function(){
			$(document).trigger("venue_list-li_bg");
		}, 300 )) ;
	});

			
	// pop_lookbook 안에 들어가는 액션들
	$(document).bind("pop_lookbook", function(){
		// 레이어 하단 ul
		$("div#pop_lookbook div.pic_control").ulDisplayMove() ;
		// ul focus 
		$("div#pop_lookbook div.pic_control ul li a").bind('mouseenter focus',function(e){
			$("div#pop_lookbook div.pic_control ul li").removeClass("on");
			$(this).parent().addClass('on');
			$("div#pop_lookbook div.look_pic > p > img").attr('src', $(this).attr('href') );
		});
		$("div#pop_lookbook div.pic_control ul li a").bind('click',function(e){
			e.preventDefault();
			$(this).triggerHandler('focus');
		});	
	});


	//$("dl.dropdown").onoff_link("dt a","click") ;
	$.fn.onoff_link = function( target , eventType ){
		$(this).delegate(target , eventType , function(e){
			e.preventDefault();
			var $dd = $(this).parent().parent().find("dd") ;
			$(document).triggerHandler("onoff-handle", {target:$dd});
		});

		//초기화
		$(document).triggerHandler("onoff-handle", {target:$(this).find("dd"),val:"remove"});
		return $(this) ;
	}

	
	$.fn.on_add_remove = function(opt){
		var defaultOpt = {
			target		: ["dt"],
			btnEvent	: "dt a",
			closeEvent	: "a:last",
			eventType	: "click"
		}
		$.extend( defaultOpt , opt ) ;

		var aTarget		= defaultOpt.target ;
		var target		= defaultOpt.target[0] ;
		var btnEvent	= defaultOpt.btnEvent ;
		var closeEvent	= defaultOpt.closeEvent ;
		var eventType	= defaultOpt.eventType ;
		$(this).each(function(i){
			var $this = $(this) ;
			$(this).find(btnEvent).bind(eventType, function(e){
				e.preventDefault() ;
				var ii = null ;
				if($this.find(target).hasClass("on"))
				{
					for( ii in aTarget)
						$this.find(aTarget[ii]).removeClass("on");
				}else{
					for( ii in aTarget)
						$this.find(aTarget[ii]).addClass("on");
				}
			});
			
			$(this).find(closeEvent).bind('blur',function(){
				$this.triggerHandler("mouseout");
			});
			$(this).hover(function(){},function(){
				$(this).find(target).addClass("on") ;
				$(this).find(btnEvent).triggerHandler(eventType);
			});
			//초기화
			$(this).triggerHandler("mouseout");
		});
		
		return $(this) ;
	} ;

	// $("#bsel").onoff_div( {btnOpen:$("a#btn_bsel"),btnClose:$("#bsel p.btn a"),eventType:'click'});
	$.fn.onoff_div = function( obj ){
		var $this = $(this) ;
		var defaults = {
			 btnOpen:$this
			,btnClose:$this
			,eventType:'click'
		}
		$.extend(defaults,obj);
		var $btnOpen = defaults.btnOpen ;
		var $btnClose = defaults.btnClose ;
		var eventType = defaults.eventType ;
		
		$(this).bind("onoff_div-on",function(){
			if($(document).triggerHandler("onoff-handle", {target:$(this)})) {
				$this.addClass("on").show();	
			}else{
				$this.removeClass("on").hide();
			}
		});
		$(this).bind("onoff_div-off",function(){
			$(document).triggerHandler("onoff-handle", {target:$btnOpen,val:"remove"});
			$this.hide();
		});
		$btnOpen.bind(eventType , function(e){
			e.preventDefault();
			$this.triggerHandler("onoff_div-on");
		});
		$btnClose.bind(eventType , function(e){
			e.preventDefault();
			$this.triggerHandler("onoff_div-off");
		});

		//초기화
		$btnClose.triggerHandler(eventType) ;
		return $(this) ;
	}

	// $(".tab_a1 li a").on_hover();
	$.fn.on_hover = function(){
		return $(this).each(function(i){
			if($(this).hasClass("on"))
				$(this).addClass("pageOn");

			$(this).bind('mouseenter focus',function(){
				if(!$(this).hasClass("pageOn")) $(this).addClass("on");
			});
			$(this).bind('mouseout blur',function(){
				if(!$(this).hasClass("pageOn")) $(this).removeClass("on");		
			});
		});	
	}

	$.fn.tab_a_none_parent_on = function(opt){
		var defaultOpt = {
			eventType : 'click',
			attr:'href',
			isImg:false,
			imgSrc:['_on.gif','_off.gif']
		}
		$.extend(defaultOpt, opt);

		var eventType = defaultOpt.eventType ;
		var attr = defaultOpt.attr ;
		var isImg = defaultOpt.isImg ;
		var aImgSrc = defaultOpt.imgSrc ;

		var $this = $(this) ;
		var $img = null ;
		$(this).bind(eventType,function(e){
			e.preventDefault() ;
			$this.each(function(i){
				$(this).parent().removeClass('on');
				$($(this).attr(attr)).addClass('none');
				if( isImg )
				{
					$img = $(this).find('img') ;
					if( $img.size() >= 1 )
						$img.attr('src' , $img.attr('src').replace(aImgSrc[0], aImgSrc[1]));
				}
				
			});
			$(this).parent().addClass('on');
			$($(this).attr(attr)).removeClass('none');
			if( isImg )
				{
					$img = $(this).find('img') ;
					if( $img.size() >= 1 )
						$img.attr('src' , $img.attr('src').replace(aImgSrc[1], aImgSrc[0]));
				}
		});

		//초기화
		$(this).eq(0).triggerHandler(eventType);
		return $(this);
	}

	$.fn.hover_parent_on = function(){
		return $(this).each(function(i){
			if($(this).parent().hasClass("on"))
				$(this).parent().addClass("pageOn");

			$(this).bind('mouseenter focus',function(){
				if(!$(this).parent().hasClass("pageOn")) $(this).parent().addClass("on");
			});
			$(this).bind('mouseout blur',function(){
				if(!$(this).parent().hasClass("pageOn")) $(this).parent().removeClass("on");		
			});
		});
	}

	
	$.fn.parentNone = function(opt){
		var defaults = {
			className : "on"
		,	eventType : "click"
		,	attr : "href"
		}
		$.extend( defaults , opt ) ;

		var className = defaults.className ;
		var eventType = defaults.eventType ;
		var attr = defaults.attr ;

		var $this = $(this) ;

		$(this).bind(eventType, function(e){
			e.preventDefault();
			var idx = $this.index($(this));

			$this.each(function(i){
				if( idx == i ){
					$(this).parent().addClass(className);
					$( $(this).attr(attr) ).removeClass("none");
				}else{
					$(this).parent().removeClass(className);
					$( $(this).attr(attr) ).addClass("none");
				}
			});
		});
		
		$(this).eq(0).triggerHandler(eventType) ;
		return $(this);

	}

	
	$.fn.mouseMove = function(opt){
		var $box = opt.box ;
		if( $box.size() == 0 ) return $(this) ;
		$(this).bind('mousemove', function(e){
			var l = (e.offsetX || e.clientX - $(e.target).offset().left);
			var t = (e.offsetY || e.clientY - $(e.target).offset().top);

			var $img = $(this) ; 
			var xSize = ($box.width() - $img.width() )/$img.width() ;
			var ySize = ($box.height()- $img.height())/$img.height();
			
			// 최대치까지 안넘어가서..			
			var ll = Math.ceil(xSize * l) + 1;
			var tt = Math.ceil(ySize * t) + 1;
			if( $img.width() > $box.width() && l >= 10 ) ll -= 3 ;
			if( $img.height() > $box.height() && t >= 10 ) tt -= 3 ;
			
			$img.css({marginLeft:ll,marginTop:tt}) ;
		});

		return $(this) ;
	}

	$.fn.maskAjax = function(opt, data){
		var defaultOpt = {
			 cont : "#modal_wrap"
			,attr : "href"
			,page : ""
			,btnClose : ".btn_close a"
			,resizeType : "all"
			,callback : function(){}
		}
		$.extend(defaultOpt, opt) ;

		var attr = defaultOpt.attr ;
		var page = defaultOpt.page ;
		if( page == "" ) page = $(this).attr(attr) ;

	//	$.get(page, data, function(htmlStr){
		$.post(page, data, function(htmlStr){
			$.__maskAjax_make(htmlStr,defaultOpt) ;
			
		});

		return $(this) ;
	}

	// post,get 모두 사용하기 위해서
	$.__maskAjax_make = function(htmlStr,opt){
		var defaultOpt = {
			 cont : "#modal_wrap"
			,attr : "href"
			,page : ""
			,btnClose : ".btn_close a"
			,resizeType : "all"
			,callback : function(){}
		}
		var css = {} ;
		$.extend(defaultOpt, opt) ;
		$.extend(css, opt.css) ;
				
		var cont = defaultOpt.cont ;
		var attr = defaultOpt.attr ;
		var btnClose	= defaultOpt.btnClose ;

		htmlStr = '<div>' + htmlStr + '</div>';
		var $layer = $(htmlStr).find(cont).clone();

		// 데이타가 없으면 반응 취소
		if( $layer.html() == null ) return ;
		
		var resizeType = 'all' ;
		if( defaultOpt.resizeType == "left" )
			resizeType = 'left' ;
		
		$layer.maskLayer({btnClose:btnClose,isDel:true,css:css}).resizeCenter(resizeType);


		if( typeof defaultOpt.callback == "function" )
			defaultOpt.callback() ;
	}

	$.fn.maskLayer = function(opt){
		var idStr = '__jquery_maskLayer_area__' ;
		var btnClose = '.btn_close a' ;
		var eventType = 'click' ;

		if( typeof opt.idStr == "string" )		idStr = idStr + opt.idStr ;
		if( typeof opt.btnClose == "string" )	btnClose = opt.btnClose ;
		if( typeof opt.eventType == "string" )	eventType = opt.eventType ;

		if( opt.isDel === true ) $("#"+idStr).empty() ;
		
		var $activeObj = $(document.activeElement) ;
		
		if( $("#"+idStr).size() == 0 ){
			$m = $("<div id='"+idStr+"'/>")
					.css({zIndex:"999",width:'100%',height:'100%',position:'fixed',top:0,left:0})
					.hide() ;
			//$("#accessibility").before($m);
			$("#accessibility").after($m);
			$(document).bind("maskClose",function(){
				//@fade 요청시
				//$m.fadeOut("fast",function(){$m.remove();});
				
				//console.log( $activeObj ) ;
			//	//$activeObj.attr('tabindex',0).bind('blur',function(){
				//	$(this).removeAttr('tabindex') ;
				//}).focus();

				$m.hide().remove();
				//$(activeObj).parent().trigger("focus");
				
				// 다른 방식들은 focus 이후 넘어가질 않네;;;
				$("#contents").trigger("focus");
			});

			$("#accessibility, #footer").delegate('a','focus',function(){
				$(document).triggerHandler("maskClose");
			});
		}

		if( $("#"+idStr).find("#__jquery_maskLayer__").size() == 0 ){
			var defaultCss = {
				position:"absolute",
				opacity:"0.5", 
				width:'100%',height:'100%',
				top:"0px",   left:"0px",
				textAlign:"center",
				backgroundColor:"#000"} ;
			$.extend(defaultCss,opt.css) ;
			
			$d = $('<div id="__jquery_maskLayer__"/>').css(defaultCss);
			
			$d.appendTo($m).after($(this)) ;
			//@fade 요청시
			//$m.fadeIn("slow");
			$m.show();

			$m.find(btnClose).bind(eventType,function(e) {
				e.preventDefault();
				$(document).triggerHandler("maskClose");
			});
		}
		
		$(this).attr('tabindex',0).focus() ;
		return $(this).focus() ;
	}

	$.fn.resizeCenter = function(type){
		var $this = $(this) ;

		// floor 에서는 모바일때 사라진다.
		var resizeMask = function(){
			var w = $(window).width() ;
			var h = $(window).height() ;
		
			if( w <= 480 )
				$(document).triggerHandler("maskClose");

			maskLeft = (w - $this.width())/ 2 ;
			maskTop  = $(window).scrollTop() + (h - $this.height())/2 ;
			// 모바일 버전이랑 왔다리 하면 밑으로 떨어져서 나오넹
			if( maskTop*2 + $this.height() > h )
				maskTop = 50 ;


			if( $.browser.msie && $.browser.version.substr(0,1) == '6')
			{
				$this.css({top:maskTop,left:maskLeft});
			}else{
				$this.css({top:"0px",left:"0px",marginTop:maskTop,marginLeft:maskLeft,position:'fixed'});
			}		
		};

		// lookbook 은 모바일때 fixed 가 풀린다.
		var resizeMaskWidth = function(){
			var w = $(window).width() ;
			var h = $(window).height() ;
		
			maskLeft = (w - $this.width())/ 2 ;
			maskTop  = $(window).scrollTop() + (h - $this.height())/2 ;
			// 모바일 버전이랑 왔다리 하면 밑으로 떨어져서 나오넹
			if( maskTop*2 + $this.height() > h )
				maskTop = 50 ;


			if( $.browser.msie && $.browser.version.substr(0,1) == '6')
			{
				$this.css({top:maskTop,left:maskLeft});
			}else{
				if( w <= 480 )
				{
					$this.parent().css({height:$.getDocHeight(),position:'absolute'});
					$this.css({top:"0px",left:"0px",marginTop:"20px",marginLeft:maskLeft,position:'absolute'});
				}else{
					$this.parent().css({height:$.getDocHeight(),position:'fixed'});
					$this.css({top:"0px",left:"0px",marginTop:maskTop,marginLeft:maskLeft,position:'fixed'});
				}
			}		
		};
		
		if( type == "left" )
			$(document).bind('resizeMask', resizeMaskWidth) ;
		else if( type == "top" ) // 없음
			$(document).bind('resizeMask', resizeMaskWidth) ;
		else
			$(document).bind('resizeMask', resizeMask)
		
		$(document).triggerHandler('resizeMask') ;
		$(document).bind('common-resize', function(){
			$(document).triggerHandler('resizeMask') ;
		}) ;

		return $(this);
	}

	
	$.fn.ulDisplayOne = function(opt, aniOpt){
		var defaultOpt = {
			btnPrev		: "p a.pre",
			btnNext		: "p a.nxt",
			target		: "ul",
			minSize		: 1,
			isWrap		: true
		};
		var animateOpt = {
			 duration : 200
			,easing :"swing"
		//	,queue:true
		//	,specialEasing
		//	,progress
			,complete:function(){}
		//	,done
		//	,fail
		//	,always
		}

		$.extend( defaultOpt , opt ) ;
		$.extend( animateOpt , aniOpt ) ;
		
		var $this = $(this);
		var $btnPrev = $(this).find(defaultOpt.btnPrev);
		var $btnNext = $(this).find(defaultOpt.btnNext);
		var $target = $(this).find(defaultOpt.target);

		
		var m = defaultOpt.minSize ;
		var s = $target.find("li").size() ;
		var w = $target.find("li:first").width() ;
		var i = 0 ;
		var isAction = true ;
		if( m >= s ) isAction = false ;

		if( defaultOpt.isWrap )
		{
			var $d = $("<div />").css({position:"relative",overflow:"hidden",height:$target.find("li:first").height(),width:$target.find("li:first").width()});
			$target.wrap($d);
		}
		
		var animatePrevOpt = animateOpt.constructor() ;
		var animateNextOpt = animateOpt.constructor() ;
		$btnPrev.bind('click',function(e){
			e.preventDefault();
			if( !$target.is(":animated") && isAction)
			{
				i-- ;
				if( i < 0 ) {
					i = s - 1;
					var $f = $target.find("li:first").clone() ;
					$target.append($f).css({marginLeft:w*s*-1}) ;
					animatePrevOpt.complete = function(){
						$target.find("li:last").remove() ;
						animateOpt.complete();
					}
				}else{
					animatePrevOpt.complete = function(){
						animateOpt.complete() ;
					}
				}
				$target.stop().animate({marginLeft:w*i*-1},animatePrevOpt);
			}				
		});
		$btnNext.bind('click',function(e){
			e.preventDefault();
			if( !$target.is(":animated") && isAction )
			{
				i++ ;
				if( i >= s ) {
					var $f = $target.find("li:first").clone() ;
					$target.append($f) ;
					animateNextOpt.complete = function(){
						i = 0 ;
						$target.css({marginLeft:0}).find("li:last").remove() ;
						animateOpt.complete();
					}
				}else{
					animateNextOpt.complete = function(){
						animateOpt.complete() ;
					}
				}
				$target.stop().animate({marginLeft:w*i*-1},animateNextOpt);
			}
		});
		$target.find('li a').bind('focus',function(){
			var idx = $target.find('li a').index($(this));
			$target.css({marginLeft:idx*w*-1});
		});

		
		return $(this);
	};


	$.fn.ulDisplayMove = function(opt, aniOpt){
		var defaultOpt = {
			btnPrev		: "p.btn_control a.pre",
			btnNext		: "p.btn_control a.nxt",
			target		: "ul",
			minSize		: 3,
			isWrap		: false
		};
		var animateOpt = {
			 duration : 400
			,easing :"swing"
		//	,queue:true
		//	,specialEasing
		//	,progress
			,complete:function(){}
		//	,done
		//	,fail
		//	,always
		}

		$.extend( defaultOpt , opt ) ;
		$.extend( animateOpt , aniOpt ) ;
		
		var $this = $(this);
		var $btnPrev = $(this).find(defaultOpt.btnPrev);
		var $btnNext = $(this).find(defaultOpt.btnNext);
		var $target = $(this).find(defaultOpt.target);

		
		var m = defaultOpt.minSize ;
		var s = $target.find("li").size() ;
		var w = $target.find("li:first").outerWidth(true) ;
		var i = 0 ;
		var l = Math.floor(s / m) ;
		var isAction = true ;
		if( m >= s ) isAction = false ;

		if( defaultOpt.isWrap )
		{
			var $d = $("<div />").css({position:"relative",overflow:"hidden",height:$target.find("li:first").outerHeight(true),width:$target.find("li:first").outerWidth(true)});
			$target.wrap($d);
		}
		
		$btnPrev.bind('click',function(e){
			e.preventDefault();
			if( !$target.is(":animated") && isAction)
			{
				if( --i < 0 ) 
					i = l ;
				var ml = w * i * m * -1 ;
				console.log( ml + ":"+ i  );
				
				$target.stop().animate({marginLeft:ml},animateOpt);
			}				
		});
		$btnNext.bind('click',function(e){
			e.preventDefault();
			if( !$target.is(":animated") && isAction )
			{
				if( ++i > l ) 
					i = 0 ;
				var ml = w * i * m * -1 ;
				$target.stop().animate({marginLeft:ml},animateOpt);
			}
		});

/*
ie 에서 자동으로 무언가를 변화 시키는듯하네... 안맞는다...
		$target.find('li a').bind('focus',function(){
			var idx = $target.find('li a').index($(this));
			console.log(  Math.floor(idx / m) );
			var ml = Math.floor(idx / m)*w*m*-1 ;
			console.log( ml ) ;
			$target.css({marginLeft:ml});				
		});
*/		
		return $(this);
	};


	$.fn.resizeWidth = function(target, clone){
		var $this = $(this);
		return $(this).each(function(){
			if( isNaN(clone) ) clone = 0 ;
			var s = $this.find(target).size() + clone ;
			var w = $this.find(target).eq(0).outerWidth(true) ;
			$this.width(w*s) ;
		});
	};

	$.getDocHeight = function(){
		 var D = document;
		 return Math.max(Math.max(D.body.scrollHeight,    D.documentElement.scrollHeight), Math.max(D.body.offsetHeight, D.documentElement.offsetHeight), Math.max(D.body.clientHeight, D.documentElement.clientHeight));
	};

	$.getDocWidth = function(){
		 var D = document;
		 return Math.max(Math.max(D.body.scrollWidth,    D.documentElement.scrollWidth), Math.max(D.body.offsetWidth, D.documentElement.offsetWidth), Math.max(D.body.clientWidth, D.documentElement.clientWidth));
	};

	$.fn.windowResize = function(str1,str2) {
		var w,h ;
		
		if( !isNaN(str1) && !isNaN(str2) ){
			w = str1 ;
			h = str2 ;
		}else if( $(str1).size() == 1 ){
			w = $(str1).outerWidth(true)  ;
			h = $(str1).outerHeight(true) ;
		}else{
			w = $(document).width() ;
			h = $(document).height() - 200 ;
		}

		try{
			if( h >= $(opener).height() && $(opener).height() != null )
				h = $(opener).height() ;
		}catch(e){}

		if (navigator.userAgent.indexOf("MSIE") >= 0) { // ie
			if (navigator.userAgent.indexOf("Windows NT 6") >= 0) { // window 7 이상인경우...
				if(navigator.userAgent.indexOf("MSIE 7") >= 0 || navigator.userAgent.indexOf("MSIE 8") >= 0){// IE 9
					h += 71;    
					w += 20; 
				}else{								
					h += 67;
					w += 16;
				}							
			}else{
				h += 79;    
				w += 10 ;
			}
		}else if(navigator.userAgent.indexOf("Firefox") >= 0){  // FF
			h += 65;
			w += 16;  
		}else if(navigator.userAgent.indexOf("Chrome") >= 0){  // Chrome
			h += 64;
			w += 16;  
		}else if(navigator.userAgent.indexOf("Opera") >= 0){  // Opera
			 h += 57; 
			 w += 19 ; 
		}else if(navigator.userAgent.indexOf("Netscape") >= 0){  // Netscape
			 h += 16;   
		}else if(navigator.userAgent.indexOf("Safari") >= 0){  // Safari
			h += 39;
			w += 16;  
		}   
		
		
		window.resizeTo(w, h) ;
		
		
		return $(this) ;
	}

})(jQuery);	


(function($){
	$.fn.CalendarBody = function(opt){
		var defaultOpt = {
			 today : "2013-04-01"
			,dayLen : "1"
			,html : "{{day}}"
		}
		$.extend(defaultOpt , opt ) ;
		var todayStr = defaultOpt.today ;
		var dayLen	= defaultOpt.dayLen ;
		var html	= defaultOpt.html ;
		if( typeof todayStr != "string" || !/[0-9]{4}[\-\.][0-9]{1,2}[\-\.][0-9]{1,2}$/g.test(todayStr) )
		{
			var today = new Date() ;
			todayStr = today.getFullYear() +"-"+ (today.getMonth()+1).strRepeat(dayLen) +"-" + today.getDate().strRepeat(dayLen) ;
		}

		var printCal = new Date() ;
		var aToday = todayStr.split(/[\-\.]/);
		printCal.setFullYear(aToday[0] , (aToday[1]-1) , "1" ) ;
		
		var dateArr = [] ;
			
		var startDay = printCal.getDay() ;
		var printMonth = printCal.getMonth() ;
		var forDate = new Date() ;
		forDate.setTime( printCal.getTime() - (startDay*86400)*1000 ) ;

		var pd = '' ;
		var pm = '' ;
		var tag = '' ;
		var td = '' ;
		var dateStr = '' ;
		var $trBody = $("<tbody />") ;
		for( m = 0 ; m < 6 ; m++ )
		{
			$tr = $("<tr />") ;
			for( j = 0 ; j < 7 ; j++ )
			{
				pd = forDate.getDate() ; 
				pm = forDate.getMonth() ;
				$td = $("<td />") ;
				if( pm == printMonth ){
					s = (pd+"").strRepeat(dayLen) ;
					tag = html.replace( /{{day}}/g, s) ;
					tag = tag.replace( /{{date}}/g, forDate.getFullYear()+"."+(forDate.getMonth()+1).strRepeat(2)+"."+forDate.getDate().strRepeat(2)) ;
					$td.attr("data-date",pd).html(tag).appendTo( $tr ) ;
				}else
					$td.html("").appendTo( $tr ) ;
				
				forDate.setDate(pd+1) ;
			}
			$trBody.append($tr);
		}

		$(this).append($trBody.html());
		return $(this) ;
	}
})(jQuery);