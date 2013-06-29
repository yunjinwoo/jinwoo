	var Validator = {
		validate : function(form) {
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
			alert(title +"(은)는 " + message);
			el.focus();
		}, 
		
		required : function(v) {
			return !v ? "반드시 입력하셔야 합니다." : false;
		},
		validatenumber : function(v) {
			return isNaN(v) || /^\s+$/.test(v) ? "숫자로 입력하셔야 합니다." : false;
		},
		validatephone : function(v) {
			v = v.replace(/-/g ,'' );
			return isNaN(v) || /[^\d]/.test(v)? "숫자와 `-`만 입력하셔야 합니다." : false;			
		},
		validatealpha : function(v) {
			return /^[a-zA-Z]+$/.test(v) ? "알파뱃만 입력하셔야 합니다." : false;
		},
		validatealphanum : function(v) {
			return /\W/.test(v) ? "알파뱃과 숫자만 입력하셔야 합니다." : false;
		},
		validatedate : function(v) {
			var date = new Date(v);
			return isNaN(v) ? "바른 날짜를 입력하셔야 합니다." : false;
		},
		validateemail : function(v) {
			return !/\w{1,}[@][\w\-]{1,}([.]([\w\-]{1,})){1,3}$/.test(v) ? "바른 이메일 주소를 입력하셔야 합니다." : false;
		},
		validateurl : function(v) {
			return !/^(http|https|ftp):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+)(:(\d+))?\/?/i.test(v) ? "바른 URL을 입력하셔야 합니다." : false;
		},
		_getTitle : function (el) {
			return el.title ? el.title : el.name;
		}
	}