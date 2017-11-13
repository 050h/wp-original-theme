window.addEventListener("load", function(){
  document.getElementById("nav").classList.remove("scrolled");
}, false);

window.onscroll = function(){
	var scroll = window.scrollY;
	if (scroll > 100) {
		document.getElementById("nav-bar").classList.add("scrolled");
	}else{
		document.getElementById("nav-bar").classList.remove("scrolled");
	}
}