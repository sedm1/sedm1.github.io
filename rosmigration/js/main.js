function OpenModalWindow(){
    var bg = document.getElementById("bg")
    bg.classList.add('bg-active');
    setTimeout(() => {
        var modalWindow = document.getElementById("modal__window")
        modalWindow.classList.add('modal__window-active');
    }, 100)
}
function CloseModalWindow(){
    var modalWindow = document.getElementById("modal__window")
    modalWindow.classList.remove('modal__window-active');
    setTimeout(() => {
        var bg = document.getElementById("bg")
        bg.classList.remove('bg-active');
    }, 100)
}