/* When the user scrolls down, hide the navbar. When the user scrolls up, show the navbar */
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        document.getElementById("navbar").style.top = "0vh";
    } else {
        document.getElementById("navbar").style.top = "-30vh";
    }
    if (prevScrollpos > currentScrollPos) {
        document.getElementById("top").style.top = "0vh";
    } else {
        document.getElementById("top").style.top = "-40vh";
    }
    if (prevScrollpos > currentScrollPos) {
        document.getElementById("icon-bar").style.top = "50vh";
    } else {
        document.getElementById("icon-bar").style.top = "15vh";
    }
    prevScrollpos = currentScrollPos;
}