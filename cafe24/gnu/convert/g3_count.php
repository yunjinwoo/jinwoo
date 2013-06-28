<?
include_once("./_common.php");

if ($is_admin != "super")
    alert("최고관리자만 변환 가능합니다", "$g4[bbs_path]/login.php?url=".urlencode($_SERVER[PHP_SELF]));

$g4[title] = "방문자수 변환 : 그누보드3 -> 그누보드4";
include_once("$g4[path]/head.sub.php");

$source = "gb_count";
$source_sum = "gb_count_sum";

$target = $g4[visit_table];
$target_sum = $g4[visit_sum_table];

if ($_POST[proc]) {
    $sql = " select * from $source ";
    $result = sql_query($sql);
    // 자료가 있을 경우에만 타켓 테이블 내용 삭제
    if (mysql_num_rows($result))
    {
        sql_query(" delete from $target ");
        sql_query(" delete from $target_sum ");
    }

    sql_query(" insert into $target select * from $source ");
    sql_query(" insert into $target_sum select * from $source_sum ");

    echo <<<HEREDOC
    <script language="JavaScript">
        alert("변환 하였습니다.");
    </script>
HEREDOC;
}
?>

<br>
<br>
<br>
<table align=center>
<form name=f method=post action="javascript:f_submit(document.f);">
<input type=hidden name=proc value=1>
<tr>
	<td height=50 align=center><strong><?=$g4[title]?></strong></td>
</tr>
<tr>
	<td height=30>그누보드3 = 원본 , 그누보드4 = 복사본</td>
</tr>
<tr>
	<td height=30>원본과 복사본은 같은 DB 내에 있다고 가정합니다.</td>
</tr>
<tr>
	<td align=center><br><input name=trans type=submit value=" 변환하기 "> <input type=button value="메뉴" onclick="location.href='./';"></td>
</tr>
</form>
</table>

<script language="JavaScript">
function f_submit(f)
{
    f.trans.value = " 변환중... ";
    f.trans.disabled = true;
    f.action = "";
    f.submit();
}
</script>

<?
include_once("$g4[path]/tail.sub.php");
?>
