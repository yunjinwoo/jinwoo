
//테마별 별 액션
function themeAction()
{
	var $theme_bg = $("#contents > div.article div#theme_bg") ;
	if( $theme_bg.hasClass('stand1') ){
		themeBgPosition($theme_bg, -3617, (33 + 267), -17) ;
	}else if( $theme_bg.hasClass('stand2') ){
		themeBgPosition($theme_bg, -4207, (8 + 292) , -7) ;
	}else if( $theme_bg.hasClass('stand3') ){
		themeBgPosition($theme_bg, -4500, (300) , 0) ;
	}else if( $theme_bg.hasClass('stand4') ){
		themeBgPosition($theme_bg, -4512, (21 + 277) , -12) ;
	}

	$(".lnb").fadeInMsie("fast");
	$("ul.controll").hide().removeClass('none').fadeInMsie("fast");
/*
div.theme_area div.stand1 {background-position:-3617px 0 !important;} 최대넓이 3917px -33px 여백 -267px 넓이 
div.theme_area div.stand2 {background-position:-4207px 0 !important;} 최대넓이 4500px -8px 여백 -292px 넓이 
div.theme_area div.stand3 {background-position:-4200px 0 !important;} 최대넓이 4800px -300px 넓이 
div.theme_area div.stand4 {background-position:-4512px 0 !important;} 최대넓이 4800px -21px 여백 -277px 넓이 
*/
}
function themeBgPosition( $theme_bg, minLeft , stepLeft , deLeft ) 
{
	var thisLeft = minLeft ;
	var roll = function(){
		thisLeft += stepLeft ;
		if( thisLeft >= deLeft )
			thisLeft = deLeft ;
		$theme_bg.attr('style', "background-position:"+thisLeft+"px 0 !important;") ;

		if( thisLeft < deLeft )
			setTimeout( roll , 50 ) ;
		else
			setTimeout( roll2 , 50 ) ;
	}

	var roll2 = function(){
		thisLeft -= stepLeft ;
		if( thisLeft <= minLeft )
			thisLeft = minLeft ;
		$theme_bg.attr('style', "background-position:"+(thisLeft)+"px 0 !important;") ;

		if( thisLeft > minLeft )
			setTimeout( roll2 , 50 ) ;
	}
	roll() ;	
}