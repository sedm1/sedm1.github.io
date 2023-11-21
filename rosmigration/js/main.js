function OpenModalWindow(){
    var bg = document.getElementById("bg")
    bg.classList.add('bg-active');
    setTimeout(() => {
        var modalWindow = document.getElementById("modal__window-1")
        modalWindow.classList.add('modal__window-active');
    }, 100)
    var form = document.querySelector('#modal__form')
    form.onsubmit = function(evt) {
        evt.preventDefault();
        var modalWindow1 = document.getElementById("modal__window-1")
        modalWindow1.classList.remove('modal__window-active');
        var modalWindow2 = document.getElementById("modal__window-2")
        modalWindow2.classList.add('modal__window-active');
        var LastButton = document.getElementById("OkButton")
        LastButton.addEventListener('click', function(){
            form.submit()
        });
    };

}
function CloseModalWindow(){
    var modalWindow = document.getElementById("modal__window-1")
    modalWindow.classList.remove('modal__window-active');
    setTimeout(() => {
        var bg = document.getElementById("bg")
        bg.classList.remove('bg-active');
    }, 100)
}