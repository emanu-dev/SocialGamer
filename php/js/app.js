function closeSidebar(e) {
	if (e.target == document.documentElement){
		document.querySelector('html').classList.remove('open-sidebar');
	}	
}

function openSidebar(e) {
	document.querySelector('html').classList.add('open-sidebar');
	console.log('worked');
}


function addUser(id) {
    if (id == "") {
        alert('ID de usuário inválida');
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = " - " + this.responseText;
            }
        };
        xmlhttp.open("GET","add_friend.php?id=" + id, true);
        xmlhttp.send();
    }
}

document.querySelector('html').addEventListener('click', closeSidebar);
document.querySelector('body').addEventListener('click', closeSidebar);
document.querySelector('.js-open-sidebar').addEventListener('click', openSidebar);

if (document.querySelector('.add-friend') != null) {
	document.querySelector('.add-friend').addEventListener('click', function(e) {
		console.log('errou!');
		addUser(e.target.getAttribute('data-user'));
	});	
}


