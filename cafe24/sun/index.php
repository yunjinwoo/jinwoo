<?php

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <title> jquery - test </title>
  <meta name="generator" content="editplus" />
  <meta name="author" content="" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
 </head>

 <body>
  
<h3>Jquery 관련된 내용 정리및 테스트 파일 링크들</h3>

<xmp>
https://developers.google.com/speed/libraries/devguide?hl=ko#jquery


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="http://cdn.jquerytools.org/1.2.7/full/jquery.tools.min.js"></script>

jQuery
snippet: <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
site: http://jquery.com/
versions: 1.8.1, 1.8.0, 1.7.2, 1.7.1, 1.7.0, 1.6.4, 1.6.3, 1.6.2, 1.6.1, 1.6.0, 1.5.2, 1.5.1, 1.5.0, 1.4.4, 1.4.3, 1.4.2, 1.4.1, 1.4.0, 1.3.2, 1.3.1, 1.3.0, 1.2.6, 1.2.3
note: 1.2.5 and 1.2.4 are not hosted due to their short and unstable lives in the wild.
jQuery UI
snippet: <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>

</xmp>

브라우저별 클래스 넣기

<script type="text/javascript">

document.write( navigator.appName ) ;
document.write("<br />"+ navigator.appVersion ) ;
document.write("<br />"+ navigator.userAgent ) ;

function userAgentTypeClass()
{
	var body = document.body ;
	if( navigator.userAgent.indexOf("MSIE 6") > -1){	
		body.className = "ie6" ;
	}else if(navigator.userAgent.indexOf("MSIE 7") > -1){
		body.className = "ie7" ;
	}else if(navigator.userAgent.indexOf("MSIE 8") > -1){
		body.className = "ie8" ;
	}else if(navigator.userAgent.indexOf("MSIE 9") > -1){
		body.className = "ie9" ;
	}else if(navigator.userAgent.indexOf("MSIE 10") > -1){
		body.className = "ie10" ;
	}else if(navigator.userAgent.indexOf("Firefox") > -1){
		body.className = "ff" ;
	}else if(navigator.userAgent.indexOf("Opera") > -1){
		body.className = "op" ;
	}else if(navigator.userAgent.indexOf("Safari") > -1){
		if(navigator.userAgent.indexOf("Chrome") > -1){
			body.className = "ch" ;
		}else
			body.className = "sa" ;
	}
}

document.body.onload = function(){
	userAgentTypeClass() ;	
}
</script>

 </body>
</html>