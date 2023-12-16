// external JavaScript document (sitejavascript.js)

function adjustTopnav() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    }
    else {
        x.className = "topnav";
    }
}

function redirect(target) {
	window.location.href = target;
}

function popup(message, target) {
	let text = message;
	alert(text);
	redirect(target);
}