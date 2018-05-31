function closeSidebar(e) {
	if (e.target == document.documentElement){
		document.querySelector('html').classList.remove('open-sidebar');
	}	
}

function openSidebar(e) {
	document.querySelector('html').classList.add('open-sidebar');
	console.log('worked');
}


document.querySelector('html').addEventListener('click', closeSidebar);
document.querySelector('body').addEventListener('click', closeSidebar);
document.querySelector('.js-open-sidebar').addEventListener('click', openSidebar);
