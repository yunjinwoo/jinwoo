
	<div id="lnb">
		<ul class="lnb_tab">
			<li class="pc"><a href="admin_member.php">PC</a></li>
			<li class="mobile active"><a href="m_main.php">Mobile</a></li>
		</ul>
		<h2 class="lnb_title">Mobile Admin Mode</h2>
		<dl class="lnb_menus">
			<dt class="lnb_menus_first">Main 관리</dt>
			<dd><a href="m_main.php?view=01">Main 제품 관리</a></dd>
			<dd><a href="m_main.php?view=02">Worldwide VATECH 관리</a></dd>
			
			<dt>Product 관리</dt>
			<dd><a href="m_product.php?view=01">제품 관리</a></dd>
			<dd><a href="m_product.php?view=02">제품 목록</a></dd>
			<dd><a href="m_product.php?view=03">제품 등록</a></dd>
			
			<dt class="active"><a href="m_etc.php?view=01">회사 관리</a></dt>
			
			<dt><a href="m_etc.php?view=02">Contact us</a></dt>
		</dl>
	</div>


<script type="text/javascript">
$(function(){
	var menuIdx = '<?=_a_menuIdx?>' ;
	if( !isNaN(menuIdx) )
		$("#lnb .lnb_menus a").parent().removeClass("active").eq(menuIdx).addClass("active") ;
		
});</script>