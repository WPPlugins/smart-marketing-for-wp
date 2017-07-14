
	function tabs(id, idlink1, idlink2, element, rme, rme2){

		document.getElementById(element).style.display = 'block';
		document.getElementById(element).className += ' tab-active';
		document.getElementById(id).className += ' nav-tab-active';


		document.getElementById('egoi-bar-preview').style.display = 'none';

		document.getElementById(rme).style.display = 'none';
		document.getElementById(rme).className = 'tab';
		document.getElementById(idlink1).className = 'nav-tab '+idlink1;

		document.getElementById(rme2).style.display = 'none';
		document.getElementById(rme2).className = 'tab';
		document.getElementById(idlink2).className = 'nav-tab '+idlink2;
		document.getElementById('nav-tab-preview').className = 'nav-tab nav-tab-preview';

	}

	function preview_bar(){

		document.getElementById('egoi-bar-preview').style.display = 'block';

		document.getElementById('tab-settings').style.display = 'none';
		document.getElementById('tab-appearance').style.display = 'none';
		document.getElementById('tab-messages').style.display = 'none';

		document.getElementById('nav-tab-settings').className = 'nav-tab nav-tab-settings';
		document.getElementById('nav-tab-appearance').className = 'nav-tab nav-tab-appearance';
		document.getElementById('nav-tab-messages').className = 'nav-tab nav-tab-messages';
		
		document.getElementById('nav-tab-preview').className += ' nav-tab-active';

	}
