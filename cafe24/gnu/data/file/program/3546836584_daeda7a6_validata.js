function replaceCommaToChar(str){
	var comma =  /\,/g;
	str = str.replace(comma, "¶");
	return str;
}
// check.js
// 천 단위 콤마(,)넣기
function inputcomma(what){
	tmpwhat = new String(what);
	newwhat = "";
	for(i = tmpwhat.length-1, j = 0; i >= 0 ; i--, j++){
		if(j % 3 == 0 && j != 0) newwhat = ","+newwhat;
		newwhat = tmpwhat.charAt(i) + newwhat;
	}
	return newwhat;
}

// 대문자로 변환하기
function Upper(str){
	var chr= event.keyCode;
	if(chr >= 65 && chr <= 90){
		return str.toUpperCase();
	} else{
		return str;
	}
}

function toUpper(ele){
	var chr= event.keyCode;
	if(chr >= 65 && chr <= 90){
		ele.value = Upper(ele.value);
	} 
}

// 소문자로 변환하기
function Lower(str){
	return str.toLowerCase();
}
// 입력되는 값 대문자로 치환하기
function inputUpper(){
	var chr= event.keyCode;
	if(chr >= 65 && chr <= 90){
		return event.keyCode = parseInt(chr) + 32;
	}
}
function inputLower(){
	if(chr >= 97 && chr <= 122){
		return event.keyCode = parseInt(chr) - 32;
	}
}

// 숫자냐?
function checknum(valuez){
	valuesEx = /[-|][^0-9]/;
	// 0-9 이외의 값이 있느냐?
	// 숫자가 아니면 true 숫자 이면 false;
	if(valuesEx.test(valuez)) return false; else return true;
}
// 영문자나 숫자 -, _ 로 이루어 졌느냐?
function checknumcharWithBar(valuez){
	//A-Za-z0-9이외의 값이 있느냐?
	//A-Za-z0-9이외의 값이 있으면 false 없으면 true를 반환
	valuesEx = /[^A-Za-z0-9 \-_]/;
	if(valuesEx.test(valuez)) return false; else return true;
}
// 영문자나 숫자로 이루어 졌느냐?
function checknumchar(valuez){
	//A-Za-z0-9이외의 값이 있느냐?
	//A-Za-z0-9이외의 값이 있으면 false 없으면 true를 반환
	valuesEx = /[^A-Za-z0-9]/; 
	if(valuesEx.test(valuez)) return false; else return true; 
}

function isAlphaNumOnly(valuez){
	valuesEx = /[A-Za-z0-9]/;
	if(valuesEx.test(valuez)) return true; else return false;
}
function checknumwithbar(valuez){
	valuesEx = /[^0-9\-]/;
	// 0-9 - 이외의 값이 있느냐?
	// 있으면 false 없으면 true;
	if(valuesEx.test(valuez)) return false; else return true;
}
//사용할 수 없는 아이디
function disableId(valuez){
	// 해당 단어가 포함되면 ture 아니면 false;
	valuesEx = /admin|ftp|http|mysql|demon|root|webmaster|master|guest|xitem|administrator/;
	// 상기 단어로 구성 되었는가?
	if(valuesEx.test(valuez)) return true; 
	else if(cellphonenum_tw(valuez)) return true; 
	else if(phonenum_tw(valuez)) return true; 
	else return false;
}
//입력된 값이 전화번호 포멧인가를 체크한다.(입력받을 때)
function phonenum(valuez){
	//전화 번호 포멧이면 true 아니면 false;
	valuesEx = /(011|016|017|018|019|02|031|032|033|041|042|043|051|052|053|054|055|061|062|063|064)(-|)([1-9]{1})([0-9]{2,3})(-|)([0-9]{4})/;
	if(!valuesEx.test(valuez)) return false; else return true;
}

function replaceCharToNum(valuez){
	checklist = new Array();
	checklist[0] = new Array( /공/g , /일/g , /이/g , /삼/g , /사/g , /오/g , /육/g , /칠/g , /팔/g , /구/g );
	checklist[1] = new Array( /O/g, /i/g);
	checklist[2] = new Array( /o/g, /I/g );
	for(k = 0; checklist[k] ; k++){
		cheker = checklist[k];
		for(i = 0; cheker[i] ; i++){
			valuez = valuez.replace(cheker[i], i);
		}
	}
	return valuez;
}

function removeDash(valuez){
	var dash =  /\-+/g;
	valuez = valuez.replace(dash, "");
	return valuez;
}

function removeSpace(valuez){
	var space =  /\s+/g;
	valuez = valuez.replace(space, "");
	return valuez;
}

function cellphonenum_tw(valuez){
	valuez = replaceCharToNum_tw(valuez);
	valuez = removeSpace(valuez);
	valuez = removeDash(valuez);
	valuesEx = /09(-|)[0-9]{2}(-|)[0-9]{6}/;
	//valuesEx=/(09)(-|)[0-9]{2}(-|)[0-9]{6}/;
	if(!valuesEx.test(valuez)) return false; else return true;
}

function phonenum_tw(valuez){
	//전화 번호 포멧이면 true 아니면 false;
	valuez = replaceCharToNum_tw(valuez);
	valuez = removeSpace(valuez);
	valuez = removeDash(valuez);
	valuesEx = /0[0-9]{1,2}(-|)([0-9]{7,8})/;
	if(!valuesEx.test(valuez)) return false; else return true;
}

function replaceCharToNum_tw(valuez){
	checklist = new Array();
	checklist[0] = new Array( /0/g , /1/g , /2/g , /3/g , /4/g , /5/g , /6/g , /7/g , /8/g , /9/g );
	checklist[1] = new Array( /O/g, /i/g);
	checklist[2] = new Array( /o/g, /I/g );
	for(k = 0; checklist[k] ; k++){
		cheker = checklist[k];
		for(i = 0; cheker[i] ; i++){
			valuez = valuez.replace(cheker[i], i);
		}
	}
	return valuez;
}

function checkComment(formz){
	if(!submitFrm(formz)) return false;
	if(!checkedinputcash(formz.price)){return false;}
	if(cellphonenum_tw(formz.comment.value)){
		alert(NOT_ALLOW_CELLPHONENUM_FORMAT);
		return false;
	}
	if(phonenum_tw(formz.comment.value)){
		alert(NOT_ALLOW_PHONENUM_FORMAT);
		return false;
	}
	if(check_mail2(formz.comment.value)) {
		alert(NOT_ALLOW_MAIL_FORMAT);
		return false;
	}
	if(formz.price.value <= 0 ) return false;
}

//입력된 값이 전화번호 포멧인가를 체크한다.(체크할 때)
function phonenum2(valuez){
	//전화 번호 포멧이면 true 아니면 false;
	valuez = replaceCharToNum(removeSpace(valuez));
	//alert(valuez);
	return phonenum(valuez);
}
// 입력된 값이 숫자냐?
function checkinputnum(ele) {
	var chr= event.keyCode;
	//alert(chr);
	if(!((chr >= 48 && chr <= 57) || (chr >= 96 && chr <= 105) || (chr >= 35 && chr <= 40) || chr == 9 || chr == 13 || chr == 8 || chr == 46 )){
		  event.returnValue  = false;
		  ele.focus();
		  return false;
	} else {
		return true; 
	}
}

function checkAmpsand(ele){
	var tmp = event.keyCode;
	if(tmp == 38) {
	  event.returnValue  = false;
	  ele.focus();
	  return false;
	}
}
// 입력된 값이 숫나 또는  '-' 입니까?
function checkinputnumwithbar(ele){
	var chr= event.keyCode;
	if(!((chr >= 48 && chr <= 57) || chr == 45)){
		  event.returnValue  = false;
		  ele.focus();
		  return false;
	} else {
		return true;
	}
}
//  0을 제외한 숫자냐?
function checkinputnum1_5(ele) {
	var chr= event.keyCode;
	if(!(chr >= 49 && chr <= 53)){
		  event.returnValue  = false;
		  ele.focus();
		  return;
	}
}

function checkinputcash(ele){
	var chr = event.keyCode;
	if(!(chr >= 48 && chr <= 58)){
		  event.returnValue  = false;
		  ele.focus();
		  return;
	}
	if(ele.value.length == 0){
		if(!(chr >= 49 && chr <= 58)){
			  event.returnValue  = false;
			  ele.focus();
			  return;
		}
	}
}

function removeFirstChar(tmp){
	var len = tmp.length;
	reVal = "";
	for(i = 1; i < len; i++){
		reVal = reVal + "" + tmp.charAt(i);
	}
	return reVal;
}

function checkedinputcash(ele){
	if(isNaN(ele.value)) {alert(MSG_INPUTNUMERIC);ele.value= isNaN(ele.defaultValue) ? 0 : ele.defaultValue;ele.select();return false;}
	var tmp = ele.value;
	while(tmp.charAt(0) == "0"){
		tmp = removeFirstChar(tmp);
	}
	ele.value = tmp;
	chrlength = tmp.length;
	lastchar = tmp.charAt(chrlength-1);
	if(lastchar != 0 && lastchar != "0")  { alert(MSG_CASHWILL10TIMES); ele.select(); return false;}
	else if(tmp -1 <= ele.form.minFee.value - 1) {
		re = new RegExp(); 
		re = /_minFee_/gi;
		while(re.test(MSG_UNDERFEE)) MSG_UNDERFEE=MSG_UNDERFEE.replace('_minFee_', ele.form.minFee.value); alert(MSG_UNDERFEE);
		ele.select(); 
		return false;}
	else if(isNaN(tmp)) { alert(MSG_INPUTNUMERIC);  ele.select(); return false; }
	else return true;
}
//
// 입력된 값이 숫자나 문자냐?
function checkinputnumchar(ele)   
{
var chr= event.keyCode;
	if(!((chr >= 48 && chr <= 57) || chr==8 || chr==9 || chr==46 || chr==229 || chr==37 || chr==39 || (chr >= 65 && chr <= 90) || (chr >= 97 && chr <= 122)))
	{
	  event.returnValue  = false;
	  ele.focus();
	  //return false;
   }
}
function checkinputnumchar2(ele)   
{
	if(!checknumchar(String.fromCharCode(event.keyCode)))
	{
		  event.returnValue  = false;
		  ele.focus();
		  return false;
	}
}
function checkLength(ele, limit) {
	if(ele.value.length > limit){
		  event.returnValue  = false;
		  ele.focus();
		  return false;
	} else {
		return true;
	}
}
function check_creditNo(card_no){
	// 카드 번호 형태 이면 true 아니면 false
	cardEx = /[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}/;
	if(cardEx.test(card_no)) return true;
	else return false;
}
// 입력된 값이 이메일 포멧인가를 체크한다.

function check_mail(chmail){
	// 메일 포멧이면 true 아니면 false를 반환
	emailEx1 = /[^@]+@[A-Za-z0-9_\-]+\.[A-Za-z]+/;
	emailEx2 = /[^@]+@[A-Za-z0-9_\-]+\.[A-Za-z0-9_\-]+\.[A-Za-z]+/;
	emailEx3 = /[^@]+@[A-Za-z0-9_\-]+\.[A-Za-z0-9_\-]+\.[A-Za-z0-9_\-]+\.[A-Za-z]+/;
	emailEx4 = /[^@]+@[A-Za-z0-9_\-]+\.[A-Za-z0-9_\-]+\.[A-Za-z0-9_\-]+\.[A-Za-z0-9_\-]+\.[A-Za-z]+/;
	if(!emailEx1.test(chmail)){
		if(!emailEx2.test(chmail))
			if(!emailEx3.test(chmail))
				if(!emailEx4.test(chmail))
					return false;
	}
	else{
		return true;
	}
}
// 내용 중에서 검색
function check_mail2(chmail){
	// 메일 포멧이면 true 아니면 false를 반환
	chmail = removeSpace(chmail);
	return check_mail(chmail);
}
// 입력된 이메일이 한메일 계정인가?
function ishanmail(chmail){
	// 한메일 계정이면 true 아니면 false
	emailEx = /[^@]+@(hanmail.net|daum.net)/;
	if(!emailEx.test(chmail)) return false; else return true;
}
function checkjuminno(jumin) {
	 // 주번이면 true 그렇지 않으면 false 반환
	   var strA, strB, strC, strD, strE, strF, strG, strH, strI, strJ, strK, strL, strM, strN, strZ;
	   var nCalA, nCalB, nCalC;
	   strA = jumin.substr(0, 1); 
	   strB = jumin.substr(1, 1);
	   strC = jumin.substr(2, 1);
	   strD = jumin.substr(3, 1);
	   strE = jumin.substr(4, 1);
	   strF = jumin.substr(5, 1);
	   strG = jumin.substr(6, 1); 
	   strH = jumin.substr(7, 1);
	   strI = jumin.substr(8, 1);
	   strJ = jumin.substr(9, 1);
	   strK = jumin.substr(10, 1);
	   strL = jumin.substr(11, 1);
	   strM = jumin.substr(12, 1);
	   strZ = strA*2 + strB*3 + strC*4 + strD*5 + strE*6 + strF*7 + strG*8 + strH*9 + strI*2 + strJ*3 + strK*4 + strL*5;
	   nCalA = eval(strZ);
	   nCalB = nCalA % 11;
	   nCalC = 11 - nCalB;
	   nCalC = nCalC % 10;
	 if ( nCalC != strM) return false; else return true;
} 

function fillZero(str, len){
	str += "";
	while(str.length < len){
		str = "0" + str;
	}
	return str;
}

function checkAdult(jumin){
	limitAge = (arguments.length > 1) ? arguments[1] : limitAge = 19;
	preYear =  (jumin.charAt(6) == "1" || jumin.charAt(6) == "2") ?  "19": "20";
	limitYear = preYear + jumin.substr(0, 2) ;
	limitYear = (limitYear -1 + 1) + limitAge ;
	limitMonth = jumin.substr(2, 2);
	limitDay = jumin.substr(4, 2);
	var limitDate = new Date(limitYear, limitMonth, limitDay);
	var toDate = new Date();
	if(limitDate < toDate) return true; else return false;
}


/*********************************************
* 기능: 유연한 자동 폼 검사기
* 만든이: 거친마루 <comfuture@maniacamp.com>
* 수정: 김봉재 <bjkim92@korea.com>
* 날짜: 2002-10-01
* == change log == by 거친마루
* 2003-10-02 여러칸으로 나눠진 항목에 대한 검사기능 추가
* 2003-10-02 패스워드등 두개 항목에 대한 비교 기능 추가
* == change log == by 김봉재
* 2004-08-02 파일 업로드 확장자 제한 추가
* 2004-08-02 수정사항이 없는 경우 폼 전송을 하지 않도록 수정하였습니다.
*- 여러 필드로 나누어진 항목에 대한 검사 방법이 추가되었습니다.
***********************************************
*ex) 3개 필드로 나누어진 전화번호 입력란 만들기
*<input type="text" name="phone1" size="3" hname="전화번호" option="phone" required span="3"> -
*<input type="text" name="phone2" size="4"> -
*<input type="text" name="phone3" size="4">
*span 값이 있으면 해당 엘리먼트로부터 span값만큼의 엘리먼트의 값을 합친걸 기준으로 phone 형식 검사를 수행합니다. 이때 span 되는 엘리먼트에 대해서는 option을 따로 주지 않아도 됩니다.
*
*ex2) 2개 항목으로 나누어진 이메일 입력란 만들기
*<input type="text" name="email1" hname="이메일" option="email" required span="2" glue="@">@
*<input type="text" name="email2">
*여러개 항목으로 나눠져있지만 구분자는 입력에 들어가지 않을경우 glue 속성에 적어주시면 해당 문자로 합쳐집니다. 
*-> email1@email2 에대한 이메일 패턴 검사 결과를 출력합니다. 
*
*- 패스워드 확인등 두개의 항목값이 같아야 하는 상황에 대한 체크 방법이 추가되었습니다.
*
*ex) 패스워드 confirm 구현하기
*<input type="password" name="passwd" hname="패스워드" required match="passwd2">
*한번더 <input type="password" name="passwd2" required> 
*이때는 passwd 항목과 passwd2 항목이 같지 않을경우 경고창을 출력하게 됩니다.
**********************************************/

/// 에러메시지 포멧 정의 ///
var NO_BLANK = "{name+을를} 입력 하십시오";
var NO_CHECKED = "{name+을를} 체크 하십시오.";
var NOT_VALID = "{name+이가} 올바르지 않습니다";
// var TOO_LONG = "{name}의 길이가 초과되었습니다 (최대 {maxbyte}바이트)";
// Xi 에 의해서 추가되어습니다.
var MSG_NOTEXISTANYCHANGE = "변경된 내용이 없습니다";
var MSG_LIMITEXTENSION = "는 제한된 확장자 입니다.\n";
var MSG_LIMITONLY = "만 업로드 하실 수 있습니다";
var MSG_LIMITNOTUSE= "는 업로드 하실 수 없습니다";
var MSG_RECOMENDFIELD = "필수 항목이 빠졌습니다.";

/// 스트링 객체에 메소드 추가 ///
String.prototype.trim = function(str) { 
	str = this != window ? this : str; 
	return str.replace(/^\s+/g,'').replace(/\s+$/g,''); 
}

String.prototype.hasFinalConsonant = function(str) {
	str = this != window ? this : str; 
	var strTemp = str.substr(str.length-1);
	return ((strTemp.charCodeAt(0)-16)%28!=0);
}

String.prototype.bytes = function(str) {
	str = this != window ? this : str;
	len = 0
	for(j=0; j < str.length; j++) {
		var chr = str.charAt(j);
		len += (chr.charCodeAt() > 128) ? 2 : 1
	}
	return len;
}


function checkFrm(frm)
{
	// 변경된 내용이 없으면 전송할 필요가 없죠 ㅡㅡ.
	var denyFileExtCheck = (arguments.length > 1) ? arguments[1] : true;
	var changed = true; // mm
	if(frm.denyCheckChange) if(frm.denyCheckChange.value == "1") changed = true;
	for(i=0; i < frm.length && !changed;i++){
		if(frm.elements[i].value != frm.elements[i].defaultValue)
		{
			changed = true;
			break;
		}
	}

	if(!changed){
		alert(MSG_NOTEXISTANYCHANGE);
		return false;
	}

	for(i=0; i < frm.length; i++){
		var el = frm.elements[i];
		if (el.tagName == "FIELDSET") continue;
		
		if(el.value) el.value = el.value.trim();

		// option 은
		// email(이메일), phone(전화번호), hphone(휴대전화)
		// userid(사용자아이디), hangul(한글), engonly(영문전용)
		// jumin(주민번호), bizno(사업자등록번호)
		var option = el.getAttribute("OPTION");
		var minbyte = el.getAttribute("MINBYTE");
		var maxbyte = el.getAttribute("MAXBYTE");
		var match = el.getAttribute("MATCH");
		var glue = el.getAttribute('GLUE');
		var denyZero = el.getAttribute("DENYZORO");
		
		if ((el.getAttribute("REQUIRED") != null) && !el.disabled) {
			
			if(el.type == "radio" || el.type == "checkbox"){
				tmp_obj_id = el.id  ? el.id : el.name;
				tmp_ele = eval("document.all."+tmp_obj_id);
				tmp_checked = false;
				if(tmp_ele[0]){
					for(k = 0 ; tmp_ele[k] ; k++){
						if(tmp_ele[k].checked ) {
							tmp_checked = true;
							break;
						}
					}
				} else {	
					tmp_checked = tmp_ele.checked;
				}
				if(!tmp_checked){
					return doError(el,NO_CHECKED);
				};
			} else {
				if(el.getAttribute("SPAN") != null){ 
					span = el.getAttribute("SPAN");
					tmp_str = "";
					for(j = 0 ; j < span ; j++){
						tmp_str += frm.elements[i+j].value;
					}
					if (( tmp_str == null || tmp_str == "")) return doError(el,NO_BLANK);
				} else if (( el.value == null || el.value == "")) {
					return doError(el,NO_BLANK);
				}
			}
		}
		
		if((el.getAttribute("DENYZERO") != null) && el.value != ""){
			if (el.value == 0) {
				return doError(el,"{name+은는} 0 을 사용할 수 없습니다.");
			}
		}

		if (minbyte != null && el.value != "") {
			if (el.value.bytes() < parseInt(minbyte)) {
				return doError(el,"{name+은는} 최소 "+minbyte+"바이트 이상 입력해야 합니다.");
			}
		}

		if (maxbyte != null && el.value != "") {
			var len = 0;
			if (el.value.bytes() > parseInt(maxbyte)) {
				return doError(el,"{name}의 길이가 초과되었습니다 (최대 "+maxbyte+"바이트)\n\n영문/숫자 "+maxbyte+" 자, 한글 "+parseInt(maxbyte/2)+" 이내로 입력하세요.");
			}
		}

		if (match && (el.value != frm.elements[match].value)) return doError(el,"{name+이가} 일치하지 않습니다");

		if (option != null && el.value != "") {
			if (el.getAttribute('SPAN') != null) {
				var _value = new Array();
				for (span=0; span<el.getAttribute('SPAN');span++ ) {
					_value[span] = frm.elements[i+span].value;
				}
				var value = _value.join(glue == null ? '' : glue);
				if (!funcs[option](el,value)) return false;
			} else {
				if (!funcs[option](el)) return false;
			}
		}

		if( 0 && denyFileExtCheck && el.type == "file" && el.value != "") {
			if(frm.up_limit_ext_deny && frm.up_limit_ext){
				if(frm.up_limit_ext_deny.value == "allow"){
					if(!checkExtention(el.value, frm.up_limit_ext.value)){
						fileExtention = getExtention(el.value);
						return doError(el, fileExtention  + MSG_LIMITEXTENSION +frm.up_limit_ext.value + MSG_LIMITONLY);
					}
				} else {
					if(checkExtention(el.value, frm.up_limit_ext.value)){
						fileExtention = getExtention(el.value);
						return doError(el, fileExtention  + MSG_LIMITEXTENSION +frm.up_limit_ext.value + MSG_LIMITNOTUSE);
					}
				}
			}
		}
		// 화일 확장자
		if(el.type == "file" && el.value != ""){
			allowExt = el.getAttribute("allow");
			denyExt = el.getAttribute("deny");
			if(allowExt== "" && allowExt == "All" && allowExt == null){
				if(denyExt == "" && denyExt == "All" && denyExt == null){
					if(checkExtention(el.value, denyExt)){
						fileExtention = getExtention(el.value);
						return doError(el, fileExtention  + MSG_LIMITEXTENSION + denyExt + MSG_LIMITNOTUSE);
					} else {
						alert("모든 종류의 화일 업로드가 금지 되어 있습니다. 관리자에게 문의 하세요");
						return false;
					}
				}
			} else {
				if(!checkExtention(el.value, allowExt)){
					fileExtention = getExtention(el.value);
					return doError(el, fileExtention  + MSG_LIMITEXTENSION + allowExt + MSG_LIMITONLY);
				}
			}
		}
	}
	return true;
}

function josa(str,tail) {
	return (str.hasFinalConsonant()) ? tail.substring(0,1) : tail.substring(1,2);
}

function doError(el,type,action) {
	var pattern = /{([a-zA-Z0-9_]+)\+?([가-힝]{2})?}/;
	var name = (hname = el.getAttribute("HNAME")) ? hname : el.getAttribute("NAME");
	pattern.exec(type);
	var tail = (RegExp.$2) ? josa(eval(RegExp.$1),RegExp.$2) : "";
	alert(type.replace(pattern,""+eval(RegExp.$1)+"" + tail));
	if (action == "sel") {
		el.select();
	} else if (action == "del")	{
		el.value = "";
	}
	eleType = el.type
	var pattern = /^(hidden|select)(.*)/;
	if(!pattern.test(eleType)) el.focus(); 
	//var pattern = /^(select)(.*)/;
	//if(!pattern.test(eleType)) el.focus(); 
	return false;
}	

/// 특수 패턴 검사 함수 매핑 ///
var funcs = new Array();
// funcs[option] = functions;

funcs['email'] = isValidEmail;
funcs['phone'] = isValidPhone;
funcs['mobile'] = isValidMobile;
funcs['userid'] = isValidUserid;
funcs['hangul'] = isValidHasHangul;
funcs['denyhan'] = isValidDenyHangul;
funcs['number'] = isValidNumeric;
funcs['engonly'] = isValidAlphaOnly;
funcs['hanonly'] = isValidHangulOnly;
funcs['engnumonly'] = isValidAlphaNumericOnly;
funcs['jumin'] = isValidJumin;
funcs['bizno'] = isValidBizNo;
funcs['domain'] = isValidDomain;
funcs['date'] = isValidDate;
funcs['coupon'] = isValidCoupon;


/// 패턴 검사 함수들 ///
function isValidEmail(el,value) {
	var value = value ? value : el.value;
	//var pattern = /^[_a-zA-Z0-9-\.]+@[\.a-zA-Z0-9-]+\.[a-zA-Z]+$/;
	var pattern = /[_a-zA-Z0-9-\.]+@[\.a-zA-Z0-9-]+\.[a-zA-Z]+$/;
	return (pattern.test(value)) ? true : doError(el,NOT_VALID);
}

function isValidUserid(el) {
	var pattern = /^[a-zA-Z]{1}[a-zA-Z0-9_\.]{3,9}$/;
	return (pattern.test(el.value)) ? true : doError(el,"{name+은는} 4자이상 10자 미만이어야 하고,\n 영문,숫자, _ , . 문자만 사용할 수 있습니다");
}

function isValidHasHangul(el) {
	var pattern = /[가-힝]/;
	return (pattern.test(el.value)) ? true : doError(el,"{name+은는} 반드시 한글을 포함해야 합니다");
}

function isValidDenyHangul(el) {
	var pattern = /[가-힝]/;
	return (pattern.test(el.value)) ? doError(el,"{name+은는} 한글을 사용하실 수 없습니다.") : true;
}

// 아스키코드값을 이용한 한글만 입력받기
function isValidHangulOnly(el){
	str = el.value
	if( str.length > 0 )
	{
			var len;
			len = str.length;
			for (var i = 0; i < len; i++)  {
					if (str.charCodeAt(i) < 128 )
					{
							return doError(el,"{name+은는} 한글만 사용하실 수 있습니다.");;
					}
			}
	}
	return true;
}

function isValidAlphaNumericOnly(el){
	//var pattern = /[a-zA-Z][a-zA-Z0-9]+$/;
	var pattern = /[a-zA-Z0-9_]+$/;
	return (pattern.test(el.value)) ? true : doError(el,"{name+은는} 영문 대소문자, 숫자만 사용하실 수 있습니다.");
}

function isValidAlphaOnly(el) {
	var pattern = /^[a-zA-Z ]+$/;
	return (pattern.test(el.value)) ? true : doError(el,"{name+은는} 영문 대소문자만 사용하실 수 있습니다.");
}

function isValidNumeric(el) {
	var pattern = /^[0-9]+$/;
	return (pattern.test(el.value)) ? true : doError(el,"{name+은는} 반드시 숫자로만 입력해야 합니다");
}

function isValidDate(el,value){
	str = value ? value : el.value;
	var pattern = /^[1|2][0-9]{3}([0][0-9]|[1][0-2])([0-2][0-9]|[3][0-1])/;
	if(pattern.test(str)){
		str = str.substr(0, 4)+"-"+str.substr(4,2)+"-"+str.substr(6,2)
	} else {
		var pattern = /^[1|2][0-9]{3}[\.]([0][0-9]|[1][0-2])[\.]([0-2][0-9]|[3][0-1])/;
		if(pattern.test(str)){
			str = str.substr(0, 4)+"-"+str.substr(5,2)+"-"+str.substr(8,2)
		} 
	}
	var pattern = /^[1|2][0-9]{3}[\-]([0][0-9]|[1][0-2])[\-]([0-2][0-9]|[3][0-1])/;
	if(!value) el.value = str;
	return (pattern.test(str)) ? true : doError(el,"{name+은는} 날짜(YYYY-MM-DD) 형식이여야 합니다.");
}

function isValidJumin(el,value) {
	var pattern = /^([0-9]{6})-?([0-9]{7})$/; 
	var num = value ? value : el.value;
	if (!pattern.test(num)) return doError(el,NOT_VALID); 
	num = RegExp.$1 + RegExp.$2;

	var sum = 0;
	var last = num.charCodeAt(12) - 0x30;
	var bases = "234567892345";
	for (var i=0; i<12; i++) {
		if (isNaN(num.substring(i,i+1))) return doError(el,NOT_VALID);
		sum += (num.charCodeAt(i) - 0x30) * (bases.charCodeAt(i) - 0x30);
	}
	var mod = sum % 11;
	return ((11 - mod) % 10 == last) ? true : doError(el,NOT_VALID);
}

function isValidBizNo(el, value) { 
	var pattern = /([0-9]{3})-?([0-9]{2})-?([0-9]{5})/; 
	var num = value ? value : el.value;
	if (!pattern.test(num)) return doError(el,NOT_VALID); 
	num = RegExp.$1 + RegExp.$2 + RegExp.$3;
	var cVal = 0; 
	for (var i=0; i<8; i++) { 
		var cKeyNum = parseInt(((_tmp = i % 3) == 0) ? 1 : ( _tmp  == 1 ) ? 3 : 7); 
		cVal += (parseFloat(num.substring(i,i+1)) * cKeyNum) % 10; 
	} 
	var li_temp = parseFloat(num.substring(i,i+1)) * 5 + '0'; 
	cVal += parseFloat(li_temp.substring(0,1)) + parseFloat(li_temp.substring(1,2)); 
	return (parseInt(num.substring(9,10)) == 10-(cVal % 10)%10) ? true : doError(el,NOT_VALID); 
}

function isValidPhone(el,value) {
	var pattern = /^([0]{1}[0-9]{1,2})-?([1-9]{1}[0-9]{2,3})-?([0-9]{4})$/;
	var num = value ? value : el.value;
	if (pattern.exec(num)) {
		if(RegExp.$1 == "02" || RegExp.$1 == "031" || RegExp.$1 == "032" || RegExp.$1 == "033" || RegExp.$1 == "041" || RegExp.$1 == "042" || RegExp.$1 == "043" || RegExp.$1 == "051" || RegExp.$1 == "052" || RegExp.$1 == "053" || RegExp.$1 == "054" || RegExp.$1 == "055" || RegExp.$1 == "061" || RegExp.$1 == "062" || RegExp.$1 == "063" || RegExp.$1 == "064" ) {
			if (!el.getAttribute('SPAN')) el.value = RegExp.$1 + "-" + RegExp.$2 + "-" + RegExp.$3;
		}
		return true;
	} else {
		return doError(el,NOT_VALID);
	}
}

function isValidMobile(el,value) {
	var pattern = /^([0]{1}[0-9]{1,2})-?([1-9]{1}[0-9]{2,3})-?([0-9]{4})$/;
	var num = value ? value : el.value;
	if (pattern.exec(num)) {
		if(RegExp.$1 == "011" || RegExp.$1 == "016" || RegExp.$1 == "017" || RegExp.$1 == "018" || RegExp.$1 == "019") {
			if (!el.getAttribute('SPAN')) el.value = RegExp.$1 + "-" + RegExp.$2 + "-" + RegExp.$3;
		}
		return true;
	} else {
		return doError(el,NOT_VALID);
	}
}
function isValidCoupon(el, value){
	var pattern = /[A-Z0-9]{3}[0-9]{2}-?[A-Z0-9]{5}-?[0-9]{8}/;
	var num = value ? value : el.value;
	return (pattern.test(num)) ? true : doError(el,"{name+은는} 잘못된 쿠폰 번호 입니다.");
}
function isValidDomain(el) {
}

function getExtention(fileName){	;

	dotPoint = fileName.lastIndexOf(".");
	if(dotPoint > 0){
		fileExtention = fileName.substr(dotPoint+1, fileName.length);
	} else {
		fileExtention = "";
	}
	return fileExtention;
}

function getFileName(fileName){
	slashPoint = fileName.lastIndexOf("\\");
	if(slashPoint > 0){
		reVal = fileName.substr(slashPoint+1, fileName.length);
	} else {
		reVal = fileName;
	}
	return reVal;
}

function checkExtention(valuez, extentions){
	ext = extentions;
	while(ext.search(",") != -1){
		ext = ext.replace(",", "|");
	}
	var ptrn = new RegExp(ext, "g");
	valuez = valuez.toLowerCase();
	fileExtention = getExtention(valuez);
	if(ptrn.test(fileExtention)) result = true; else result = false;
	return result;
}

function checkSelect(formz)
{
	if(formz.isSel) {
		if(formz.isSel[0])
		{
			for(i = 0; formz.isSel[i]; i++)
			{
				if(formz.isSel[i].checked) return true;
			}
		} else {
			if(formz.isSel.checked) return true;
			else return false;
		}
	} else { return false; }
}

function selectProcess(formz){
	var arg = arguments;
	var argc = arg.length;
	if(argc > 1) selType = arg[1];
	else selType = "a";
	// a : 전체 ; n : 해제 ; c : 반전

	//alert('why call me?');

	if(!formz.delBtn) return; 
	if(selType == "c"){
		if(formz.isSel[0])
		{
			for(i = 0; formz.isSel[i]; i++)
			{
				if(!formz.isSel[i].disabled) formz.isSel[i].checked = !formz.isSel[i].checked;
			}
		} else if(formz.isSel)
		{
			if(!formz.isSel.disabled) formz.isSel.checked = !formz.isSel.checked;
		} 
	} else {
		if(selType == "a") convert = true;
		else convert = false;
		
		if(formz.isSel[0])
		{
			for(i = 0; formz.isSel[i]; i++)
			{
				if(!formz.isSel[i].disabled) formz.isSel[i].checked = convert;
			}
		} else if(formz.isSel)
		{
			if(!formz.isSel.disabled) formz.isSel.checked = convert;
		} 
	}
}

