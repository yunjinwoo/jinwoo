	/**
	 *  http://www2.phpschool.com/gnuboard4/bbs/board.php?bo_table=tipntech&wr_id=65031&sca=%BD%BA%C5%A9%B8%B3%C6%AE&page=15
	 *  사용방법은 

    * 아래처럼, 자바스크립트 라이브러리를 포함하고, 

      &lt;script src="validator.js" type="text/javascript"></script> 

    * 다음과 같이 form 요소를 작성한다 

      <input class="required validate-number" id="field1" name="field1"  title="필드 1" /> 

      validation type을 class 속성을 통해 전달 한다. 

    * 그 다음, 아래와 같이 자바스크립트를 초기화 하면 된다. 

      document.폼이름.onsubmit = function() { return Validator.validate(this); } 

지원하는 validation type 

    * required : 반드시 값을 입력해야 함 
    * validate-number : 숫자만 입력가능 (., +, - 포함) 
    * validate-digits : 자릿수만 입력가능 (숫자만) 
    * validate-alpha : 알파뱃만 입력가능 
    * validate-alphanum : 알파뱃과 숫자만 가능 
    * validate-date : 날짜만 가능 
    * validate-email : 이메일 주소 
    * validate-url : URL
    * validate-ip : ip
	* minlen : function(v,len)
	* maxlen : function(v,len)
	* minalphanumlen : function(v,len)
	* maxalphanumlen : function(v,len)
	* required-checked : 체크박스나 라디오에 ckecked 가 되어 있나 확인
	* validate-datetime : 날짜 형식만 가능 Y-m-d H:i:s
	* validate-image : 확장자 체크 - 이미지 bmp|gif|jpg|jpeg|png 
	* validatelinkage : 지정필드에 값이 있으면 .필드명 의 값이 있는지 확인
	 */
	var ValidatorMsg = {
		and : "(은)는 "
	,	required : "입력해 주시기 바랍니다"
	,	requiredChecked : "선택해 주시기 바랍니다."
	};
	
	var Validator = {
		validate : function(form) {
			// 파일마다 넣는게 귀찮아서 그냥 여기에....
			try{ this.elements['b[board_text]'].value = tinymce.get("editor_contents").getContent() ; }catch(e){}
			
    		var elements = form.elements;
    		for(var i = 0; i <elements.length;i++) {
				var el = elements[i];
				var classes = el.className.split(" ");
				for(var j = 0; j < classes.length; j++) {
					// 각 클래스 명
					var className = classes[j].replace(" ").replace("-","");
					// 클래스명과 일치하는 메서드가 있으면...
    				if(Validator[className]) {
						var message = Validator[className](el.value);
						// 오류가 있으면 메시지를 반환
						if(message) {
							Validator._handleError(message, el);
							return false;
						}
					}else if(className === 'requiredchecked' ){
						var message = Validator['requiredchecked_func'](form[el.name]);
						if(message) {
							Validator._handleError(message, el);
							return false;
						}
					}else{
						var lens = className.split('.');
						if(Validator[lens[0]] ) {
							if( !isNaN(lens[1]) ){
								var message = Validator[lens[0]](el.value, lens[1]);
								if(message===false) {
									Validator._handleError(message, el);
									return false;
								}
							}else{
								var message = Validator[lens[0]](el.value, lens[1], form);
								if(message === "break") {
									return false;
								}
							}
						}
					}
				}
    		}
			
			return true;
		},
		/**
		 * 오류 제어
		 * @param {String} message
		 * @param {HTMLFormElement} el
		 */
		_handleError : function(message, el) {
			var title = Validator._getTitle(el);
			alert(title + ValidatorMsg.and + message);
			try{ // 히든이나 에디터 오류 방지
				el.focus();
			}catch(e){}
		}, 
		
		required : function(v) {
			return !v ? ValidatorMsg.required : false;// 반드시 입력하셔야 합니다.
		},
		validatenumber : function(v) {
			return isNaN(v) || /^\s+$/.test(v) ? "숫자로 입력하셔야 합니다." : false;
		},
		validatedigits : function(v) {
			return isNaN(v) || /[^\d]/.test(v)? "숫자만 입력하셔야 합니다." : false;			
		},
		validatealpha : function(v) {
			return /^[a-zA-Z]+$/.test(v) ? "알파뱃만 입력하셔야 합니다." : false;
		},
		validatealphanum : function(v) {
			return /\W/.test(v) ? "알파뱃과 숫자만 입력하셔야 합니다." : false;
		},
		validatedate : function(v) {
			//var date = new Date(v);
			//return isNaN(v) ? "바른 날짜를 입력하셔야 합니다." : false;
			return false;
		},
		validateemail : function(v) {
			return !/\w{1,}[@][\w\-]{1,}([.]([\w\-]{1,})){1,3}$/.test(v) ? "바른 이메일 주소를 입력하셔야 합니다." : false;
		},
		validateurl : function(v) {
			return !/^(http|https|ftp):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(:(\d+))?\/?/i.test(v) ? "바른 URL을 입력하셔야 합니다." : false;
		},
		validatedatetime : function(v) {
			return !/^(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2})$/.test(v) ? "날짜형식( xxxx-xx-xx xx:xx:xx ) 으로 입력하셔야 합니다." : false;
		},
				
		// 
		validateip : function(v) {
			return !/^(1|2)?\d?\d([.](1|2)?\d?\d){2}(\.)(\*|(1|2)?\d?\d)$/.test(v) ? "ip 형식으로 입력하셔야 합니다." : false;
		}
		,requiredbox : function(v) {
			return !v ? "선택해 주시기 바랍니다" : false;// 반드시 입력하셔야 합니다.
		}
		,minlen : function(v,len){ 
			return v.length < len ? len+"자 이상 입력해 주시기 바랍니다. " : false;
		}
		,maxlen : function(v,len){ 
			return v.length > len ? len+"자 이하 입력해 주시기 바랍니다. " : false;
		}
		,minalphanumlen : function(v,len){ 
			return v.length < len ? "영문+숫자 "+len+"자 이상 입력해 주시기 바랍니다. " : false;
		}
		,maxalphanumlen : function(v,len){ 
			return v.length > len ? "영문+숫자 "+len+"자 이하 입력해 주시기 바랍니다. " : false;
		}
		,validatelinkage : function(v,elementName,form){
			if( v.replace(/\s/g,'') === "" ) return false ;
			if( form.elements[elementName].value.replace(/\s/g,'') === "" ){
				Validator._handleError("입력해 주시기 바랍니다", form.elements[elementName]);
				return "break" ;				 
			}
			return false;
		}
		,requiredchecked_func : function(o){
			var ret = ValidatorMsg.requiredChecked ;
			for(i = 0 , m = o.length ; i < m ; i++ )
			{
				if( o[i].checked === true )
				{
					ret = false ;
					break ;
				}
			}
			
			return ret ;
		}
		
		,validateimage : function(v) {
			return v !== "" && !/\.(bmp|gif|jpg|jpeg|png)$/.test(v.toLowerCase()) ? "이미지 형식으로만 선택하셔야 합니다." : false;
		},
		_getTitle : function (el) {
			return el.title ? el.title : el.name;
		}
	};
	
	