/**
 * @author Administrator
 */

var $imgSet;
var $imgItem;

$(function(){
	borderInit();
});

function borderInit(){
	$imgSet = $('.networks_image ul');
	
	var $imgItem = $imgSet.eq(0).find('li');
	$imgItem.eq(0).addClass('net_left_top');
	$imgItem.eq(1).addClass('net_center_top');
	$imgItem.eq(2).addClass('net_right_top');
	
	for(var i=1; i<=$imgSet.length-2; i++){
		var $imgItem = $imgSet.eq(i).find('li');
		$imgItem.eq(0).addClass('net_left_middle');
		$imgItem.eq(1).addClass('net_center_middle');
		$imgItem.eq(2).addClass('net_right_middle');
	}
	
	var $imgItem = $imgSet.eq($imgSet.length-1).find('li');
	$imgItem.eq(0).addClass('net_left_bottom');
	$imgItem.eq(1).addClass('net_center_bottom');
	$imgItem.eq(2).addClass('net_right_bottom');
}
