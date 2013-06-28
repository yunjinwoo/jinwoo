<?php
/*
Plugin Name: H Naver AJAX Search
Plugin URI: http://hyunsik.me/wordpress/?page_id=277
Description: H Naver AJAX Search plugin is search in naver news, cafe, web and blogs
Version: 1.0.0
Author: HYUNSIK YIM
Author URI: http://hyunsik.me/wordpress/?page_id=277

Copyright 2009 HYUNSIK YIM  (email : hyunsik@hyunsik.me)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function uninstall() { // uninstall function called by uninstall.php
/*foreach ( $this -> options as $k => $v ) { // delete options from wp_options table
	delete_option( $this -> optionPrefix . $k );
}*/
delete_option( $this -> optionPrefix . 'options' ); // delete options from wp_options table
}



//admin panel
function hnaversearch_adminPanel() {
		add_options_page('H Naver AJAX Search', 'H Naver AJAX Search', 10,
		basename(__FILE__), 'hnaversearch_optionsSubpanel');
}




function hnaversearch_optionsSubpanel() {
	if($_POST['action'] == "save") {
		echo "<div class=\"updated fade\" id=\"limitcatsupdatenotice\"><p>" . __("Configuration <strong>updated</strong>.") . "</p></div>";
		
		if(!$_POST[key]) {?><font color="red">you have to get a naver open API Key</font><?}
		else {update_option("hh_naver_search_key", $_POST["key"]);}
		if(!$_POST[url]) {update_option("hh_naver_search_url", "/wordpress/");}
		else {update_option("hh_naver_search_url", $_POST["url"]);}
		
		//updating stuff..
		if(!$_POST[width]) {update_option("hh_naver_search_width", "100");}
		else {	update_option("hh_naver_search_width", $_POST["width"]);}
		/*
		if(!$_POST[value]) {update_option("hh_naver_search_value", "search");}
		else {update_option("hh_naver_search_value", $_POST["value"]);}
		*/
		if(!$_POST[count]) {update_option("hh_naver_search_count", "5"); }
		else {update_option("hh_naver_search_count", $_POST["count"]); }
		
		$hh_naver_search_key   = get_option("hh_naver_search_key");
		$hh_naver_search_url   = get_option("hh_naver_search_url");		
		$hh_naver_search_width   = get_option("hh_naver_search_width");			
		$hh_naver_search_value   = get_option("hh_naver_search_value");
		$hh_naver_search_count   = get_option("hh_naver_search_count");
     }

		?>
		
		<div class="wrap">
		<h2>H Naver AJAX Search</h2>	
		<br>
		<form method="post">
	    <fieldset class="options">
		<legend>Configuration(설정)</legend>
		<table class="optiontable">
			
		<tr valign="top">
		<th scope="row">
		<label><strong>REQUIRED(필수):</strong><br/>Naver open API Key<br>네이버 오픈 API키</label>
		</th>
		<td>
			
		<input type="text" name="key" size="90" value='<?php echo get_option('hh_naver_search_key'); ?>'>
		<br/>
		Get a Naver Open API key<br>네이버 오픈 API를 받으실 수 있습니다.<br> <a href="http://dev.naver.com/openapi/register" target="_blank">here(여기)</a>.
		</td>
		</tr>
	
		</table>
		</fieldset>
		<br>
		<fieldset class="options">
		<legend>Style Configuration(모양에 관한 설정)</legend>
		<table class="optiontable">
		<tr valign="top">
		<th scope="row">
		<label><strong>REQUIRED(필수):</strong>Your WordPress position(defualt: /wordpress/)<br>워드프레스의 위치 ( 공란일 경우 : /wordpress/ )</label>
		</th>
		<td>		
		<input type="text" name="url" size="20" value="<?php echo get_option('hh_naver_search_url'); ?>"><br>
		</td>
		</tr>						
		<tr valign="top">
		<th scope="row">
		<label>Search Box Width(defualt: 100)<br>검색의 텍스트박스 영역의 가로길이( 공란일 경우 : 100 ) </label>
		</th>
		<td>
		<input type="text" name="width" size="3" value="<?php echo get_option('hh_naver_search_width'); ?>">px<br> 			
		</td>
		</tr>
		
		<!--<tr valign="top">
		<th scope="row">
		<label>Button's name(defualt: search )</label>
		</th>
		<td>		
		<input type="text" name="value" size="4" value="<?php echo get_option('hh_naver_search_value'); ?>"><br>
		</td>
		</tr>-->
		<tr valign="top">
		<th scope="row">
		<label>count (defualt: 5 )<br> 검색결과의 갯수 ( 공란일 경우 : 5 )</label>
		</th>
		<td>		
		<input type="text" name="count" size="4" value="<?php echo get_option('hh_naver_search_count'); ?>"><br>
		</td>
		</tr>

		
		</table>
	    </fieldset>

		<fieldset class="options">
		<div class="submit">
		<input type="hidden" name="action" value="save">
		<input type="submit" value="Save">
		</div>
		</fieldset>
		</form>
		<br><br>
	
	</div>
		<?
} 


	
	
function hnaversearch_header() {
	register_sidebar_widget(array('H Naver AJAX Search', 'widgets'), 'widget_hnaversearch');	
}	



function widget_hnaversearch_init() {

	if ( !function_exists('register_sidebar_widget') )
		return;
	
	function widget_hnaversearch($args) {
		
		extract($args);

		$options = get_option('widget_hnaversearch');
		$title = $options['title'];

		echo $before_widget . $before_title . $title . $after_title;
        		$h_url = "wp-content/plugins/h-naver-ajax-search";
		?>
			<div style="width:100%;">
				<INPUT type="hidden" id="h_count" value="<?php echo get_option('hh_naver_search_count'); ?>">
				<INPUT type="hidden" id="h_key" value="<?php echo get_option('hh_naver_search_key'); ?>">
				<INPUT type="text" id="h_text" value="" style="vertical-align:middle;height:20px;border:5px solid green;padding:0;width:<?php echo get_option('hh_naver_search_width'); ?>px;" tabindex="1" onkeypress="if(event.keyCode==13) {call_h_search_naver();}">
				<input tabindex="2" type="image" style="vertical-align:middle;padding:0;margin:0;" src="<?php echo get_option('hh_naver_search_url'); ?><?=$h_url?>/search.gif" onclick="call_h_search_naver();" /><a tabindex="3"><img style="vertical-align:middle;cursor:pointer;margin:0;" onclick="h_delete_naver();" src="<?php echo get_option('hh_naver_search_url'); ?><?=$h_url?>/delete.gif" /></a>
				<input type="hidden" id="h_num">
				<div id="h_box" style="display:none;" align="center">
					<img src="<?php echo get_option('hh_naver_search_url'); ?><?=$h_url?>/ajax-loader.gif" />
				</div>
				<div id="h_news_result">
					<span onclick="h_check_show(0)" id="h_check_show_0" style="color:blue;cursor:pointer;display:none" onmouseover="this.style.backgroundColor='#D3D3D3'" onmouseout="this.style.backgroundColor=''">▷this blog</span>		
					<span id="h_naver_show_0" ></span>		
					<span onclick="h_check_show(1)" id="h_check_show_1" style="color:green;cursor:pointer;display:none" onmouseover="this.style.backgroundColor='#D3D3D3'" onmouseout="this.style.backgroundColor=''">▷news</span>
					<span id="h_naver_show_1" ></span>
					<span onclick="h_check_show(2)" id="h_check_show_2" style="color:green;cursor:pointer;display:none" onmouseover="this.style.backgroundColor='#D3D3D3'" onmouseout="this.style.backgroundColor=''">▷blog</span>
					<span id="h_naver_show_2" ></span>
					<span onclick="h_check_show(3)" id="h_check_show_3" style="color:green;cursor:pointer;display:none" onmouseover="this.style.backgroundColor='#D3D3D3'" onmouseout="this.style.backgroundColor=''">▷cafe</span>
					<span id="h_naver_show_3" ></span>
					<span onclick="h_check_show(4)" id="h_check_show_4" style="color:green;cursor:pointer;display:none" onmouseover="this.style.backgroundColor='#D3D3D3'" onmouseout="this.style.backgroundColor=''">▷cafearticle</span>
					<span id="h_naver_show_4" ></span>
					<span onclick="h_check_show(5)" id="h_check_show_5" style="color:green;cursor:pointer;display:none" onmouseover="this.style.backgroundColor='#D3D3D3'" onmouseout="this.style.backgroundColor=''">▷webkr</span>
					<span id="h_naver_show_5" ></span>
				</div>
			</div>		
				
		<SCRIPT type="text/javascript">
		
		//var hnaver_xmlHttp_check;		
		function call_h_search_naver(){
			document.getElementById('h_news_result').style.display = 'none';					
			document.getElementById('h_box').style.display = "block";//= HttpObj.responseText;
			for(i=0; i<=5; i++) {
				document.getElementById('h_naver_show_' + i ).style.display = "none";
				document.getElementById('h_check_show_' + i ).style.display = "none";
			}
			
			var add_pars;
			for(i=0; i<=5; i++)	{								
				//if(hnaver_xmlHttp_check >= 1 && hnaver_xmlHttp_check <= 5) i = hnaver_xmlHttp_check;
				document.getElementById('h_num').value = i;
				if(i==0) add_pars = '&cate=blog';
				else if(i==1) add_pars = '&cate=news';
				else if(i==2) add_pars = '&cate=blog';
				else if(i==3) add_pars = '&cate=cafe';
				else if(i==4) add_pars = '&cate=cafearticle';
				else if(i==5) add_pars = '&cate=webkr';
				h_search_naver(add_pars, i);				
			}
			document.getElementById('h_box').style.display = "none";//= HttpObj.responseText;
			document.getElementById('h_news_result').style.display = 'block';					
				
		}
		
		function h_search_naver(add_pars, num) {				
			num = document.getElementById('h_num').value;
			var h_query;
			h_query = document.getElementById('h_text').value;
			h_query = encodeURIComponent(h_query);
			
			if(num == 0) {
				okno = "<?=$_SERVER['HTTP_HOST']?>";
			}
			else {
				okno = "";
			}
			
			
			document.getElementById('h_box').style.display = "block";//= HttpObj.responseText;
			
			document.getElementById('h_check_show_' + num).style.display = 'block';
			document.getElementById('h_news_result').style.display = 'block';
			var strResponseURL = '<?php echo get_option('hh_naver_search_url'); ?><?=$h_url?>/ajax_naver_search.php';
			var pars = "in=" + okno + "&query=" + h_query + "&count=" + document.getElementById('h_count').value + "&key=" + document.getElementById('h_key').value + add_pars;
			var hnaver_xmlHttp;
 			/*@cc_on @*/
			/*@if (@_jscript_version >= 5)
			try {
				hnaver_xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
			try {
				hnaver_xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e2) {
			hnaver_xmlHttp = false;
			}
			}
			@end @*/
			
			if (!hnaver_xmlHttp && typeof XMLHttpRequest != 'undefined') 
			{
				hnaver_xmlHttp = new XMLHttpRequest();
			}
			
			
			
			//if (document.implementation && document.implementation.createDocument) {                
					//hnaver_xmlHttp.onreadystatechange = h_check();			
		    //}
		    //else if (window.ActiveXObject) {         //IE		        	
		    		
		    //}
		   	
		   	var url = strResponseURL + "?" + pars;
		   	
	   		hnaver_xmlHttp.open('GET', url, false);
		   	hnaver_xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
		   	hnaver_xmlHttp.send();			 
									var HttpObj;
							   		if(hnaver_xmlHttp.readyState == 4)
							   		{
								   		HttpObj = hnaver_xmlHttp;
										var xmldoc;
								        if (document.implementation && document.implementation.createDocument) {                
											dp = new DOMParser();
											xmldoc = dp.parseFromString(HttpObj.responseText, 'application/xml');		                
								        }else if (window.ActiveXObject) {         //IE		        	
							                xmldoc = new ActiveXObject("Microsoft.XMLDOM");                
							                xmldoc.loadXML(HttpObj.responseText);
								        }
								        var html = "";
								        var x = xmldoc.getElementsByTagName('item');        
								        for (var i=0;i<x.length;i++)  {
								
								                for ( var j=0;j<x[i].childNodes.length;j++) {
								                        var node = x[i].childNodes[j].nodeName;
								                        var nv ;
								                        if (node == "title")  {
								                                nv = x[i].childNodes[j].firstChild.nodeValue;
								                                var title  =  nv;
								                        } else if (node == "link"){
								                                nv = x[i].childNodes[j].firstChild.nodeValue;
								                                var link = nv;
								                        } else if (node == "date" || node=="pubDate" || node=="dc:date" ){
								                                nv = x[i].childNodes[j].firstChild.nodeValue;                                
								                                var date = nv;
								                        } 
								                }
								                
								                html = html + "<li><a href=" + link + " target=_blank>" + title + "</a></li>";
								                                
								        }        
										if(html == "") {
											document.getElementById('h_check_show_' + num).style.display = 'block';
											document.getElementById('h_naver_show_' + num).innerHTML = "no result"//= HttpObj.responseText;
										}
										else {
											document.getElementById('h_naver_show_' + num).innerHTML = html;
										}
							   		}
							   		else {
							   			document.getElementById('h_naver_show_' + num).innerHTML = " sorry( AJAX loading fail ^^ ) " + hnaver_xmlHttp.readyState;	   			
							   			
							   		}	   				   		
		   	
		   	
		}
		
		function h_check() {			

		}
		
		function h_check_show(num) {
			if(document.getElementById('h_naver_show_' + num).style.display == 'none') {
				document.getElementById('h_naver_show_' + num).style.display = 'block';
			}
			else {
				document.getElementById('h_naver_show_' + num).style.display = 'none';						
			}
		}
		function h_delete_naver() {
			if(document.getElementById('h_news_result').style.display == 'block'){	
				document.getElementById('h_news_result').style.display = 'none';					
			}
			else {
				document.getElementById('h_news_result').style.display = 'block';				
			}
		}
		function _fail() {}
		</SCRIPT>		
        <?
        
        echo $after_widget;  // end widget_hnaversearch($args)
			
	}
	

	function widget_hnaversearch_control() {

		$options = get_option('widget_hnaversearch');
		if ( !is_array($options) )
			$options = array('title'=>'', 'buttontext'=>__('H Naver AJAX Search', 'widgets'));
		if ( $_POST['hnaversearch-submit'] ) {

			$options['title'] = strip_tags(stripslashes($_POST['hnaversearch-title']));
			update_option('widget_hnaversearch', $options);
			$buttontext = htmlspecialchars($options['buttontext'], ENT_QUOTES);
		}

			echo '<p style="text-align:right;"><label for="hnaversearch-title">' . __('Title:') . ' <input style="width: 200px;" id="hnaversearch-title" name="hnaversearch-title" type="text" value="'.$title.'" /></label></p>';
			
			echo '<input type="hidden" id="hnaversearch-submit" name="hnaversearch-submit" value="1" />';
	}
	
	
	register_sidebar_widget(array('H Naver AJAX Search', 'widgets'), 'widget_hnaversearch');

	register_widget_control(array('H Naver AJAX Search', 'widgets'), 'widget_hnaversearch_control', 300, 100);
}


add_action('plugins_loaded', 'widget_hnaversearch_init');

//user hooks
add_action('wp_head', 'hnaversearch_header');
//admin hooks
add_action('admin_menu', 'hnaversearch_adminPanel');

?>