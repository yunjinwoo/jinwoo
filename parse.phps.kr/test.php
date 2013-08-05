<?php

setcookie("TestCookie", 't1e2s3t4', strtotime('+1 year') );  /* expire in 1 hour */

// http://mobile.passion-hd.com/ 
echo preg_replace( '/\&page\=([\d]{0,})/i' , '&page=%d', '?board_id=board_test&keyword=&page=21125125153263265&mode=list') ;
exit ;
class myClass {
    public $mine;
    public $xpto;
    static public $test;

    static function test() {
        var_dump(property_exists('myClass', 'xpto')); //true
    }
}

echo '<xmp>' ;
var_dump(property_exists('myClass', 'mine'));   //true
var_dump(property_exists(new myClass, 'mine')); //true
var_dump(property_exists('myClass', 'xpto'));   //true, as of PHP 5.3.0
var_dump(property_exists(new myClass, 'xpto'));   //true, as of PHP 5.3.0

var_dump(property_exists('myClass', 'test'));   //true, as of PHP 5.3.0
var_dump(property_exists(new myClass, 'test'));   //true, as of PHP 5.3.0
var_dump(property_exists('myClass', 'bar'));    //false
var_dump(property_exists('myClass', 'test'));   //true, as of PHP 5.3.0
myClass::test();
exit;
/*
BoardSet Object
(
    [f_board_id] => board_id
    [f_board_name] => board_name
    [f_page_num] => page_num
    [f_board_skin] => board_skin
    [f_board_type] => board_type
    [f_is_use_file] => is_use_file
    [f_is_use_secret] => is_use_secret
    [f_category] => category
    [f_level_admin] => level_admin
    [f_level_write] => level_write
    [f_level_view] => level_view
    [f_level_comment] => level_comment
    [f_img_new_hour] => img_new_hour
    [f_img_hot_cnt] => img_hot_cnt
    [f_list_count] => list_count
)
BoardSetRow Object
(
    [board_id] => board_test
    [board_name] => 제목1
    [page_num] => 10
    [board_skin] => basic
    [board_type] => free
    [is_use_file] => Y
    [is_use_secret] => Y
    [category] => 
    [level_admin] => 9
    [level_write] => 9
    [level_view] => 0
    [level_comment] => 0
    [img_new_hour] => 48
    [img_hot_cnt] => 50
    [list_count] => 10
    [skin_path] => /home/parse/www/skin/board/basic
    [start_num] => 
    [page] => 
    [search_field] => 
exit;
?>
배태욱| 02.29 13:12 클린지수 /100점다른댓글보기

추천 5
반대 4
추천하였습니다
니네가 좌빨좀비 좌빨좀비 하는데, 논리도없이 몰아붙이고 까면서 
대화자체를 거부한다면 좀비랑 다를게 뭐가 있냐? 논리적으로 대화를 해보자니까ㅋㅋㅋ
오류고 나발이고 그냥 밀어붙이라고?ㅋㅋㅋㅋㅋㅋ 시바 북한이냐?ㅋㅋㅋㅋ
.
반대하는 사람을 무조건 좌빨로 몰아붙이는 개티즌들에 할말을 잃었다ㅋㅋㅋ
개인적으로 제주해군기지 있어야 되고, 국방력은 더욱더 강해져야 생각한다.
반대는 제주해양기지 건설자체에 대한 반대가 아니라
현정권의 불도저식 몰아붙이기를 반대하는거다.
.
.
제주시보유 계약서, 해군 계약서, 정부에 해군이 보고한 내용이 다름, MOU 이중계약
http://www.newscham.net/news/view.php?board=news&nid=64782 
.
설계오류확인 but 강행의지 (함정조차 들어오지 못하는 기지가 민군복합형관광미항?)
http://www.jejusori.net/news/articleView.html?idxno=109065
.
공권력 투입
http://www.nocutnews.co.kr/Show.asp?IDX=2005397
.
제주해양기지 건설하되, 오류같은건 정확하게 짚고나서 건설하자.

<?php
$charset = 'UTF-8' ;
$fromname = '도금몰' ;
$fromemail = 'admin@dogeumtong.com' ;


$toname = '윤진우' ;
$toemail = 'jinwoo@brainweaver.co.kr' ;

$subject = ' class.phpmailer test ' ;


$g_mail_header = "
<html>
<head>
<title>$cf_mall_title</title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<style type='text/css'>
<!--
BODY {margin-left:0px; margin-right:0px; scrollbar-face-color: #FFFFFF; scrollbar-highlight-color: #91a3be; scrollbar-3dlight-color: #FFFFFF; scrollbar-shadow-color: #91a3be; scrollbar-darkshadow-color: #FFFFFF; scrollbar-track-color: #FFFFFF; scrollbar-arrow-color: #91a3be}
IMG {border:none;}
TD {font-size:9pt; color: #333333; font-family:verdana,굴림,tahoma; text-decoration: none; line-height:140%;letter-spacing: -1pt}
input, select, textarea {font-family:돋움, seoul, arial, helvetica; border-width:1; border-color:#cccccc; border-style:groove; font-size:12px; color:#333333; margin-top:0; margin-bottom:0; line-height:125%}

.thm7{font-size:7pt; font-family:tahoma;letter-spacing: 0pt}
.thm13{font-size:13pt; font-family:tahoma;letter-spacing: 0pt}
.thm15{font-size:15pt; font-family:tahoma;letter-spacing: 0pt}
.dod8{font-size:8pt; font-family:돋움;letter-spacing: 0pt}
.gul8{font-size:8pt; color: #828282;font-family:굴림;letter-spacing: -1pt}
.dod11{font-size:11pt; font-family:돋움;letter-spacing: -1pt}

A:link {color:#333333;text-decoration:none;}
A:visited {color:#333333;text-decoration:none;}
A:active {color:#000000;text-decoration:none;}
A:hover {color:#589818;position:relative;}
-->
</style>
</head>

<body bgcolor='#FFFFFF' text='#000000'>
<table width='793' border='0' cellspacing='0' cellpadding='0' align='center'>
  <tr> 
    <td><img src='$g_all_link_dir/image/mail_box_01.gif' height='52'></td>
  </tr>
  <tr><td align='center' valign='top' background='$g_all_link_dir/image/mail_box_02.gif'>
";

$g_mail_bottom = "
		</td>
        </tr>
  <tr><td><img src='$g_all_link_dir/image/mail_box_03.gif' height='52'></td>
  </tr>
  <tr>
    <td bgcolor='white'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
              <tr>
                <td width='69%'>
					<table width='96%' border='0' cellspacing='0' cellpadding='0'>
					  <tr>
						<td style='padding-bottom:10'>
						  <table width='100%' border='0' cellspacing='0' cellpadding='0'>
							<tr>
							  <td width='50'><img src='$g_all_link_dir/image/H_bottom_tel.gif' width='40' height='37'></td>
							  <td align='left'><b>상담시간</b> <font color='#666666' class=cat_g>&nbsp;&nbsp;&nbsp;$cf_client_time</font><br>
								<b>상담 및 문의전화 <font color='#FF6600'>&nbsp;&nbsp;&nbsp;$cf_ceo_phone</font></b> 
								<font color='#666666' class=cat_g>( <img src='$g_all_link_dir/image/H_icon_mail.gif' width='13' height='10'> $cf_client_email )</font></td>
							</tr>
						  </table></td>
					  </tr>
					  <tr>
						<td bgcolor='#E7E7E7' height='1'></td>
					  </tr>
					  <tr>
						<td style='padding-top:7' align='left'>$cf_mall_address<br>
						  사업자등록번호 : $cf_company_num&nbsp;&nbsp;&nbsp;<font color='#CCCCCC'>|</font>&nbsp;&nbsp;&nbsp;통신판매업신고 : $cf_sale_num <br>
						  대표 : $cf_ceo_name&nbsp;&nbsp;&nbsp;<font color='#CCCCCC'>|</font>&nbsp;&nbsp;&nbsp;개인정보 관리책임자 : $cf_charge_name&nbsp;&nbsp;&nbsp;<font color='#CCCCCC'>|</font>&nbsp;&nbsp;&nbsp;개인정보 
						  보호기간 : 회원탈퇴시 <br>
						  <font color='#999999' class='thm7'>Copyright $cf_mall_name All rights reserved. Developed by CMGMALL.COM</font></td>
					  </tr>
					</table>
				</td>
				<td><a href='$cf_mall_url' target='_blank'><img src='$g_all_link_dir/image/mail_box_bt_01.gif'></a>
				</td>
			</tr>
		</table></td>
        </tr>
      </table>
</body>
</html>
";


$g_mall_end .= "
                    <tr> 
                      <td height='30' align='left' bgcolor='#EAE2D9' style='border-bottom: 1 solid #D0C3B3 ; padding-left:10'><font color='#666666'>적립포인트</font></td>
                      <td align='left' bgcolor='#FFFFFF' style='border-bottom: 1 solid #D0C3B3 ; padding-left:10;padding-top:5;padding-bottom:5'>".($bu_list[buyer_point])."점<b><font color='#D90088'></font></b></td>
                    </tr>
                    <tr> 
                      <td height='30' align='left' bgcolor='#EAE2D9' style='border-bottom: 1 solid #D0C3B3 ; padding-left:10'><font color='#666666'>특별적립포인트</font></td>
                      <td align='left' bgcolor='#FFFFFF' style='border-bottom: 1 solid #D0C3B3 ; padding-left:10;padding-top:5;padding-bottom:5'>".($bu_list[buyer_add_point])."점 
                        <font color='#669900'>(회원 등급별로 특별적립금이 다릅니다.)</font></td>
                    </tr>";


$g_mall_end .= "
                    <tr>
                      <td height='30' align='left' bgcolor='#EAE2D9' style='border-bottom: 1 solid #D0C3B3 ; padding-left:10'><font color='#666666'>기타하실말씀</font></td>
                      <td align='left' bgcolor='#FFFFFF' style='border-bottom: 1 solid #D0C3B3 ; padding-left:10;padding-top:5;padding-bottom:5'>$bu_list[buyer_main] &nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
   </tr>
            </table>
            ";



	$mail_subject = " phps test !!!! ";
			$추가내용 = "<table border=0 align=center cellpadding='7' cellspacing='0'><tr><td style='padding-bottom:10'><b><font style='font-size:14' color=#6633FF>아래의 상품에 대한 결제가 확인되었습니다. 곧 상품을 준비하여 찾아뵙겠습니다. 감사합니다.</font></b></td></tr></table>";
			$buyer_delivery_confirm = "1";
	
/* multipart/mixed
$charset = 'UTF-8' ;
$fromname = '도금몰' ;
$fromemail = 'admin@dogeumtong.com' ;


$toname = '윤진우' ;
$toemail = 'jinwoo@brainweaver.co.kr' ;

$subject = ' class.phpmailer test ' ;
$content = '<html>
**/

include_once('class.phpmailer.php');

$mail             = new PHPMailer();
//0
$body             = $content;
$body             = eregi_replace("[\]",'',$body);

$mail->IsSMTP();
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server

$mail->Username   = "yjw3647@gmail.com";  // GMAIL username
$mail->Password   = "jinwoo321";            // GMAIL password

$mail->AddReplyTo("admin@dogeumtong.com","도금몰");

$mail->From       = "admin@dogeumtong.com";
$mail->FromName   = "도금몰";

$mail->Subject    = "PHPMailer Test Subject via gmail";

//$mail->Body       = "Hi,<br>This is the HTML BODY<br>";                      //HTML Body
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->WordWrap   = 50; // set word wrap

$mail->MsgHTML($body);

$mail->AddAddress("jinwoo@brainweaver.co.kr", "윤진우");
$mail->AddAddress("yjw3647@naver.com", "윤진우");
$mail->AddAddress("yjw3647@nate.com", "윤진우");
$mail->AddAddress("yjwyoke@hanmail.net", "윤진우");

//$mail->AddAttachment("images/phpmailer.gif");             // attachment

$mail->IsHTML(true); // send as HTML
/**
$charset = 'UTF-8' ; 

//$mail_content  = iconv('UTF-8','EUC-KR',$g_mail_header.$추가내용.$g_mall_end.$g_mail_bottom) ;
//$mail_subject = iconv('UTF-8','EUC-KR',$mail_subject) ;
$mail_content  = $g_mail_header.$추가내용.$g_mall_end.$g_mail_bottom ;
$mail_subject = $mail_subject ;

$mail             = new PHPMailer();
$body             = $mail_content;
$body             = eregi_replace("[\]",'',$body);

/*
$mail->IsSendmail(); // telling the class to use SendMail transport

$mail->Encoding = 'base64';
$mail->ContentType = 'text/html; charset="'.$charset.'"' ;

$mail->From       = "admin@dogeumtong.com";
$mail->FromName   = '=?'.$charset.'?b?'.base64_encode("도금몰").'?=' ;

$mail->Subject    =$mail_subject ;

//$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$mail->AddAddress("jinwoo@brainweaver.co.kr",	"윤진우" );
$mail->AddAddress("yjw3647@naver.com",	"윤진우" );
$mail->AddAddress("yjwyoke@hanmail.net",	"윤진우" );

//$mail->AddAddress("jinwoo@brainweaver.co.kr",	'=?'.$charset.'?b?'.base64_encode("윤진우") ).'?=';
//$mail->AddAddress("yjw3647@naver.com",			'=?'.$charset.'?b?'.base64_encode("윤진우") ).'?=';
//$mail->AddAddress("yjw3647@nate.com",			'=?'.$charset.'?b?'.base64_encode("윤진우") ).'?=';
//$mail->AddAddress("yjwyoke@hanmail.net",		'=?'.$charset.'?b?'.base64_encode("윤진우") ).'?=';

**/ 

if(!$mail->Send()) {
  echo "Mailer Error:!! " . $mail->ErrorInfo;
} else {
  echo "Message sent!!!";
}


return ;
require_once 'class.phpmailer.php';
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'ssl';
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->Username = 'admin@dogeumtong.com' ;
$mail->Password = '!qazxsw@';
$mail->SetFrom($fromemail, '=?'.$charset.'?b?'.base64_encode($fromname).'?=');
$mail->Subject = '=?'.$charset.'?b?'.base64_encode($subject).'?=';
$mail->ContentType = 'text/html' ;
$mail->CharSet = $charset;
$mail->Encoding = 'base64';
$mail->Body = $contents;
$mail->AddAddress($toemail, '=?'.$charset.'?b?'.base64_encode($toname).'?=');
for($i = 0; $i < 3; $i ++) {
if($mail->Send()) return;
sleep(1);
} 