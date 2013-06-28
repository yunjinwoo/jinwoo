<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

include_once("$g4[path]/head.sub.php");
include_once("$g4[path]/lib/outlogin.lib.php");
include_once("$g4[path]/lib/poll.lib.php");
include_once("$g4[path]/lib/visit.lib.php");
include_once("$g4[path]/lib/connect.lib.php");
include_once("$g4[path]/lib/popular.lib.php");

//print_r2(get_defined_constants());

// 사용자 화면 상단과 좌측을 담당하는 페이지입니다.
// 상단, 좌측 화면을 꾸미려면 이 파일을 수정합니다.

$table_width = 1004;
?>



<TABLE cellpadding="0" cellspacing="0" border="0" width="100%">
<TR>
<TD width=250 height=100 align=center class="borderRIGHT" ><A HREF="http://<?=$HTTP_HOST?>"><FONT SIZE="6" COLOR="#717171" ><B>ADDBASIC</B></FONT>.com</A></TD>
<TD align=right> <table border="0" cellspacing="0" cellpadding="0">
        <tr>
            <!-- 처음으로 버튼 -->
            <td width="78"><a href="<?=$g4['path']?>/"><img src="<?=$g4['path']?>/img/top_m01.gif" width="78" height="31" border="0"></a></td>

            <? if (!$member['mb_id']) { ?>
            <!-- 로그인 이전 -->
            <td width="78"><a href="<?=$g4['bbs_path']?>/login.php?url=<?=$urlencode?>"><img src="<?=$g4['path']?>/img/top_m02.gif" width="78" height="31" border="0"></a></td>
            <td width="78"><a href="<?=$g4['bbs_path']?>/register.php"><img src="<?=$g4['path']?>/img/top_m03.gif" width="78" height="31" border="0"></a></td>
            <? } else { ?>
            <!-- 로그인 이후 -->
            <td width="78"><a href="<?=$g4['bbs_path']?>/logout.php"><img src="<?=$g4['path']?>/img/top_m04.gif" width="78" height="31" border="0"></a></td>
            <td width="78"><a href="<?=$g4['bbs_path']?>/member_confirm.php?url=register_form.php"><img src="<?=$g4['path']?>/img/top_m05.gif" width="78" height="31" border="0"></a></td>
            <? } ?>
            
            <!-- 최근게시물 버튼 -->
            <td width="78"><a href="<?=$g4['bbs_path']?>/new.php"><img src="<?=$g4['path']?>/img/top_m06.gif" width="78" height="31" border="0"></a></td>

        </tr>
        </table></TD>
</TR>
<TR>
<TD class="borderTOP borderRIGHT" valign=top>&nbsp;
	<div align=center>
		<?=outlogin("basic"); // 외부 로그인 ?>

        <div style='height:10px;'></div>

        <?=poll("basic"); // 설문조사 ?>

        <div style='height:10px;'></div>

        <?=visit("basic"); // 방문자수 ?>

        <div style='height:10px;'></div>

        <?=connect(); // 현재 접속자수 ?>
	</div></TD>
<TD class="borderTOP"  valign=top>
		<div class="padding10">
				
<!-- 검색 시작 -->
<table width="<?=$table_width?>" cellspacing="0" cellpadding="0">
<tr>
    <td>
        <table height="33" cellspacing="0" cellpadding="0">
        <form name="fsearchbox" method="get" action="javascript:fsearchbox_submit(document.fsearchbox);">
        <!-- <input type="hidden" name="sfl" value="concat(wr_subject,wr_content)"> -->
        <input type="hidden" name="sfl" value="wr_subject||wr_content">
        <input type="hidden" name="sop" value="and">
        <tr>
            <td width="136" valign="middle" bgcolor="#F4F4F4"><INPUT name="stx" maxlengt=20 style="BORDER : 0px solid; width: 125px; HEIGHT: 20px; BACKGROUND-COLOR: #F4F4F4" maxlength="20"></td>
            <td width="48"><input type="submit" value="search" border="0"></td>
        </tr>
        </form>
        </table></td>   
</tr>
</table>

		</div>	


<script language="JavaScript">
function fsearchbox_submit(f)
{
    if (f.stx.value == '')
    {
        alert("검색어를 입력하세요.");
        f.stx.select();
        f.stx.focus();
        return;
    }

    /*
    // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
    var cnt = 0;
    for (var i=0; i<f.stx.value.length; i++)
    {
        if (f.stx.value.charAt(i) == ' ')
            cnt++;
    }

    if (cnt > 1)
    {
        alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
        f.stx.select();
        f.stx.focus();
        return;
    }
    */

    f.action = "<?=$g4['bbs_path']?>/search.php";
    f.submit();
}
</script>
<!-- 검색 끝 -->

<div style='height:18px;'></div>

<style type="text/css">
#middiv {
	width:<?=$table_width?>px;
	position:relative;
	margin:0px auto;
    vertical-align:top;
    float:left;
}
#middiv #mleft  { width:220px; float:left; padding:0 0 0 43; }
#middiv #mright { width:683px; float:left; padding:0 0 0 15; }
</style>
