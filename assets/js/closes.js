const closeMessages = document.querySelectorAll(".close-message");

if(closeMessages){
    closeMessages.forEach(closeMessage =>{
        closeMessage.addEventListener("click", (e)=>{
        let messageToClose = e.target.parentNode;
        messageToClose.remove();
    })
    })
}