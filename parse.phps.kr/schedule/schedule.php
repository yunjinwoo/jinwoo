<?php require_once 'schedule.pro.php';?>
<!DOCTYPE html>
<html>
<head>
	<title>스케줄 관리</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link type="text/css" rel="stylesheet" href="schedule.css"/>
	<script type="text/script" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
</head>
<body>
<div>
	<div id="right_menu">
		<ul>
			<li>
				<dl>
					<dt><a href="">얼굴</a></dt>
					<dd>영역</dd>
				</dl>
			</li>
			<li>
				<dl>
					<dt><a href="">설정</a></dt>
					<dd><strong>출력일자</strong>
						<ul>
							<li><label><input type="radio" name="count_day" value="50">50일</label></li>
							<li><label><input type="radio" name="count_day" value="40">40일</label></li>
							<li><label><input type="radio" name="count_day" value="30">30일</label></li>
							<li><label><input type="radio" name="count_day" value="20" checked="checked">20일</label></li>
						</ul>
					</dd>
				</dl>
			</li>
		</ul>
	</div>	
	<ul id="day_list">
		<li>
			<strong>1</strong>
			<div>박스1</div>
			<div>박스2</div>
			<div>박스3</div>
		</li>
	</ul>
</div>
	
	<script type="text/javascript">
		$(function(){
			printDayList() ;
		});
		
		function printDayList( date )
		{
			$.get("schedule.pro.php",{action:"list",day:"",len:$("input[name='count_day']:checked").val()},function(data){
				$("#day_list").append(data);
			});
		}
	</script>
</body>
</html>
