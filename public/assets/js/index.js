/* When the user scrolls down, hide the navbar. When the user scrolls up, show the navbar */
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        document.getElementById("social_nav").style.top = "75vh";
    } else {
        document.getElementById("social_nav").style.top = "46vh";
    }
    prevScrollpos = currentScrollPos;
}