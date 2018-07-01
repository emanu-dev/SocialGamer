function closeSidebar(e) {
	if (e.target == document.documentElement){
		document.querySelector('html').classList.remove('open-sidebar');
	}	
}

function openSidebar(e) {
	document.querySelector('html').classList.add('open-sidebar');
	console.log('worked');
}


function friendAction(id, action) {
    var serverResponse;
    if (id == "") {
        alert('ID de usuário inválida');
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // IE7+, Firefox, Chrome, Opera, Safari
            request = new XMLHttpRequest();
        } else {
            // IE6, IE5
            request = new ActiveXObject("Microsoft.XMLHTTP");
        }
        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var toRemove = document.querySelector('.remove');
                toRemove.innerHTML = '<p style="text-align: left;">' + this.responseText + '</p>';
                toRemove.classList.remove('remove');
            }
        };
        request.open("GET","friend_status.php?action=" + action + "&id=" + id, true);
        request.send();
        return serverResponse;
    }
}

document.querySelector('html').addEventListener('click', closeSidebar);
document.querySelector('body').addEventListener('click', closeSidebar);
document.querySelector('.js-open-sidebar').addEventListener('click', openSidebar);

if (document.querySelector('.add-friend') != null) {
    var requestButtons = [].slice.call(document.querySelectorAll('.add-friend'));
    
    requestButtons.forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            var parent = e.target.parentElement;
            parent.classList.add('remove');
            parent.innerHTML = '';
            friendAction(e.target.getAttribute('data-user'), e.target.getAttribute('data-action'));
        });	
    });
}


