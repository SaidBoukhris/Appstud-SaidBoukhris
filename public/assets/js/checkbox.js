window.onload = () => {
    let active = document.querySelectorAll("[type=checkbox]")
    for (let input of active)
        input.addEventListener("click", function() {
            let xmlhttp = new XMLHttpRequest;
            xmlhttp.open("get", `/admin/advert/actived/${this.dataset.id}`)
            xmlhttp.send()
        })
}

function modalAdvertDelete() {
    el = document.getElementById("advert_delete");
    el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
}