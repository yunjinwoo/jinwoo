<?
include_once("./_common.php");

if ($is_admin != "super")
    alert("최고관리자만 변환 가능합니다", "$g4[bbs_path]/login.php?url=".urlencode($_SERVER[PHP_SELF]));

$g4[title] = "자료 변환";
include_once("$g4[path]/head.sub.php");
?>

<br>
<ol>그누보드3 에서 변환
    <li><a href="./g3_member.php">회원, 포인트</a>
    <li><a href="./g3_board.php">게시판</a>
    <li><a href="./g3_dabsagi.php">답사기 게시판</a>
    <li><a href="./g3_count.php">방문자수</a>
    <li><a href="./g3_vote.php">투표</a>
    <li><a href="./g3_board_multi.php">게시판 멀티</a>
</ol>

<?
include_once("$g4[path]/tail.sub.php");
?>
