<div id="lnb">
	
		<ul class="lnb_tab">
			<li class="pc active"><a href="admin_member.php">PC</a></li>
			<li class="mobile"><a href="m_main.php">Mobile</a></li>
		</ul>
	
		<h2 class="lnb_title">PC Admin Mode</h2>
		<dl class="lnb_menus">
			<dt class="lnb_menus_first">관리자 설정</dt>
			<dd><a href="admin_member.php?view=01">운영자 설정</a></dd>
			<dd class="active"><a href="admin_member.php?view=04">접속 IP 설정</a></dd>
			
			<dt>Site 관리</dt>
			<dd><a href="sites.php?view=01">제품 카테고리 관리</a></dd>
			<dd><a href="sites.php?view=02">GNB 이미지 관리</a></dd>
			<dd><a href="sites.php?view=03">메인 비주얼 관리</a></dd>
			<dd><a href="sites.php?view=04">메인 제품 관리</a></dd>
			<dd><a href="sites.php?view=05">Worldwide VATECH 관리</a></dd>
			<dd><a href="sites.php?view=06">OverView 상단 관리</a></dd>
			
			<dt>Product 관리</dt>
			<dd><a href="product.php?view=01">제품 목록</a></dd>
			<dd><a href="product.php?view=02">제품 등록</a></dd>
			<dd><a href="product.php?view=03">제품 아이콘 관리</a></dd>
			
			<dt>미디어센터 관리</dt>
			<dd><a href="media.php?view=01">News</a></dd>
			<dd><a href="media.php?view=03">Event</a></dd>
			<dd><a href="media.php?view=08">social Media(Youtube)</a></dd>
			<dd><a href="media.php?view=05">Green Clinic Members</a></dd>
			<dd><a href="media.php?view=06">Testimonial</a></dd>
			
			<dt>회사정보 관리</dt>
			<dd><a href="info.php?view=01">About VATECH Global</a></dd>
			<dd><a href="info.php?view=02">Overseas Subsidiary</a></dd>
			<dd><a href="info.php?view=04">Business Partners</a></dd>
			<dd><a href="info.php?view=06">VATECH Networks</a></dd>
			
			<dt><a href="etc.php?view=03">Privacy Policy</a></dt>
			
			<dt><a href="etc.php?view=01">문의 관리</a></dt>
			
			<dt><a href="https://www.google.com/analytics/web/?et&authuser=0#report/visitors-overview/a44242263w74518780p76929784/" target="_blank">접속자통계</a></dt>
		</dl>
	</div>

<script type="text/javascript">$(function(){
	var menuIdx = '<?=_a_menuIdx?>' ;
	if( !isNaN(menuIdx) )
		$("#lnb .lnb_menus a").parent().removeClass("active").eq(menuIdx).addClass("active") ;
		
});</script>