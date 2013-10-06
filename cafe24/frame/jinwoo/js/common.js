(function () {
	if(window.addEventListener) {
		window.addEventListener('load',tabAction,false);
		window.addEventListener('load',tesTypeSelect,false);
		window.addEventListener('load',loginLabel,false);
	} else if (window.attachEvent) {
		window.attachEvent('onload',tabAction);
		window.attachEvent('onload',tesTypeSelect);
		window.attachEvent('onload',loginLabel);
	} else {
		return false;
	}
	// class manipulation from http://www.openjs.com/scripts/dom/class_manipulation.php
	function hasClass(ele,cls) {
		return ele.className.match(new RegExp('(\\s|^)'+cls+'(\\s|$)'));
	}
	 
	function addClass(ele,cls) {
		if (!hasClass(ele,cls)) ele.className += " "+cls;
	}
	 
	function removeClass(ele,cls) {
		if (hasClass(ele,cls)) {
			var reg = new RegExp('(\\s|^)'+cls+'(\\s|$)');
			ele.className=ele.className.replace(reg,'');
		}
	}
	
	// 제품관리 > 제품등록 
	function tabAction () {
		var act = document.getElementById('tabActivator');
		var pannels = document.getElementById('tabPannels');
		if (!act || !pannels) return false;
		
		var act = act.getElementsByTagName('input'),
			divs = pannels.getElementsByTagName('div'),
			tabs = pannels.getElementsByTagName('a');
			
		var tabCheck = function () {
			var checkedNum = 0;
			for (var i = 0, len = act.length; i < len; i++) {
				if (act[i].checked === true) {
					checkedNum += 1;
				}
			}
			checkedNum !== 0 ? addClass(pannels,'show') : removeClass(pannels,'show');
			return checkedNum === 1 ? true : false;
		}
				
		var resetTabs = function () {
			for (var i = 0, len = divs.length; i < len; i++) {
				removeClass(divs[i],'active');
			}
		}
		
		var activeCheck = function () {
			var hasOn = [],
				hasActive = 0;
			for (var i = 0, len = divs.length; i < len; i++) {
				if (hasClass(divs[i],'on')) hasOn.push(divs[i]);
				if (hasClass(divs[i],'active')) hasActive += 1;
			}
			if (hasActive === 0) hasOn[0].className = 'on active';
		}

		var checkAction = function () {
			for (var i = 0, len = act.length; i < len; i++) {
				act[i].onclick = function () {
					var id = this.id.replace('reg','reg_detail'),
						crrTab = document.getElementById(id);
					if (!crrTab) return;
					
					if (this.checked === true) {
						crrTab.className = tabCheck() ? 'on active' : 'on';
					} else {
						crrTab.className = '';
						tabCheck();
					}
					activeCheck();
				}
			}
		}
		
		var tabAction = function () {
			for (var i = 0, len = tabs.length; i < len; i++) {
				tabs[i].onclick = function () {
					var id = this.getAttribute('href',2).replace('#',''),
						crrTab = document.getElementById(id);
					if (!crrTab) return;
					resetTabs();
					addClass(crrTab,'active');
					return false;
				}
			}
		}
		checkAction();
		tabAction();
	}
	
	// 미디어센터관리 > testomonial
	function tesTypeSelect () {
		var form = document.getElementById('writeTes');
		if (!form) return false;
		
		var selector = form.getElementsByTagName('td');
		for (var i = 0, len = selector.length; i < len; i++) {
			if (selector[i].className === 'box_setting') {
				selector =  selector[i];
				break;
			}
		}
		
		selector.onclick = function (e) {
			e = e || window.event;
			tg = e.target || e.srcElement;
			
			switch (tg.id) {
				case 'typeY' :
					removeClass(form,'type_pdf');
					addClass(form,'type_youtube');
					break;
				case 'typeP' :
					removeClass(form,'type_youtube');
					addClass(form,'type_pdf');
					break;
			}
		}
		
	}
	
	function loginLabel () {
		var loginForm = document.getElementById('loginForm');
		if (!loginForm) return false;
		
		var inputs = loginForm.getElementsByTagName('input'),
			labels = loginForm.getElementsByTagName('label');
			
		inputs[0].onfocus = function () {
			labels[0].style.display = 'none';
		}
		inputs[0].onblur = function () {
			focusBlur(inputs[0],labels[0]);
		}
		
		inputs[1].onfocus = function () {
			labels[1].style.display = 'none';
		}
		inputs[1].onblur = function () {
			focusBlur(inputs[1],labels[1]);
		}
		
		function focusBlur (el,label) {
			if (el.value === '') {
				label.style.display = 'block';
			}
		}
	}
	
})();