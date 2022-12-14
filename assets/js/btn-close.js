const btnsClose = Array.from(document.getElementsByClassName("btn-close"));

btnsClose.forEach(btnClose =>{
    btnClose.addEventListener("click", ev => {
        ev.target.parentNode.remove();
    })
})