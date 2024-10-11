/*login*/ 
var login = document.getElementById("login");
var open = document.getElementById("open");
var span = document.getElementsByClassName("close")[0];
open.onclick = function(event) {
    event.preventDefault();
    login.style.display = "block";
}
span.onclick = function() {
    login.style.display = "none";
}

/*forgot password*/ 

var fp= document.getElementById("fp");
var fp_open= document.getElementById("open_fp");
var fp_close= document.getElementsByClassName("iclose")[0];
fp_open.onclick = function(event) {
    event.preventDefault();
    fp.style.display = "block";
}
fp_close.onclick = function() {
    fp.style.display = "none";
}


/*sign up*/

var sp= document.getElementById("sp");
var sp_open= document.getElementById("open_sp");
var sp_close= document.getElementsByClassName("spclose")[0];
sp_open.onclick = function(event) {
    event.preventDefault();
    sp.style.display = "block";
}
sp_close.onclick = function() {
    sp.style.display = "none";
}


