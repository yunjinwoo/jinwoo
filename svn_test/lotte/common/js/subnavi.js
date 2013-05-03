function submenuSelect( topViewIndex , subViewIndex , subSubViewIndex ){
	var setMenu = function(){
			$("div.nav_service ul#nav1 > li > a").eq(topViewIndex).triggerHandler('focus');
			$("div.nav_service ul.sublist > li > a").eq(subViewIndex).triggerHandler('focus');
			$("div.nav_service ul.sublist > li").eq(subViewIndex)
				.find("ul > li > a").eq(subViewIndex).triggerHandler('focus');
		
			$("div.nav_service").data("viewIndex",{topViewIndex:topViewIndex , subViewIndex:subViewIndex , subSubViewIndex:subSubViewIndex}) ;
		}
	if ( window.addEventListener )
		window.addEventListener('load', setMenu);
	else if ( window.attachEvent )
		window.attachEvent("load", setMenu);
}