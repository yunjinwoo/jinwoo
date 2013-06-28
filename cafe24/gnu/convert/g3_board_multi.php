<?
include_once("./_common.php");

if ($is_admin != "super")
    alert("최고관리자만 변환 가능합니다", "$g4[bbs_path]/login.php?url=".urlencode($_SERVER[PHP_SELF]));

$g4[title] = "게시판 멀티 변환 : 그누보드3 -> 그누보드4";
include_once("$g4[path]/head.sub.php");
?>

<br>
<form name=fmulti method=post action='./g3_board_multi_update.php'>
<p align=center><input type=submit value='   변   환   '>
<br><br>
<table align=center cellpadding=5 cellspacing=0 bordercolordark=white border=1>
<tr align=center>
	<td><b>그누보드3</b></td>
	<td width=30 align=center rowspan=2>→</td>
	<td><b>그누보드4</b></td>
</tr>
<tr>
	<td valign=top style='line-height:200%;'>
        <?
        $sql = " select bo_table, bo_subject from gb_board order by bo_table ";
        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++)
        {
            $count = 0;
            $sql2 = " select count(*) as cnt from gb_write_{$row[bo_table]} ";
            $result2 = @mysql_query($sql2);
            if ($result2)
            {
                $disabled = "";
                $row2 = sql_fetch_array($result2);
                $count = $row2[cnt];
            }
            else
                $disabled = " disabled ";
            echo "<input type=radio name=source value='$row[bo_table]' $disabled id='source$i'> <a href=\"javascript:;\" onclick=\"document.getElementById('source$i').checked=true;\">$row[bo_subject] ($row[bo_table] : $count)</a>";
            echo "<br>";
        }
        ?>
    </td>
	<td valign=top style='line-height:200%;'>
        <?
        $sql = " select bo_table, bo_subject from $g4[board_table] order by bo_table ";
        $result = sql_query($sql);
        for ($i=0; $row=sql_fetch_array($result); $i++)
        {
            $count = 0;
            $sql2 = " select count(*) as cnt from {$g4[write_prefix]}{$row[bo_table]} ";
            $result2 = @mysql_query($sql2);
            if ($result2)
            {
                $disabled = "";
                $row2 = sql_fetch_array($result2);
                $count = $row2[cnt];
            }
            else
                $disabled = " disabled ";
            echo "<input type=radio name=target value='$row[bo_table]' $disabled id='target$i'> <a href=\"javascript:;\" onclick=\"document.getElementById('target$i').checked=true;\">$row[bo_subject] ($row[bo_table] : $count)</a>";
            echo "<br>";
        }
        ?>
    </td>
</tr>
</table>

<p align=center><input type=submit value='   변   환   '>
</form>

<br>
<table align=center cellpadding=5 cellspacing=0>
<tr>
    <td>
        ※ 선택하지 못하는 게시판은 존재하지 않기 때문입니다.<br>
        ※ data/file 밑의 자료는 직접 복사해 주시기 바랍니다.
    </td>
</tr>
</table>
<br><br>


<?
include_once("$g4[path]/tail.sub.php");
?>
