
document.getElementById('login-button').onclick = showDrawer;

document.getElementsByClassName('modal-close').onclick = hideModal;
// document.getElementById('overlay').onclick = hideModal;

function showDrawer(event){
    var mod = document.getElementById("login-modal");
    mod.style.display = "block";
    mod.classList.add("element");

}

//gets the parent (modal) of the close button
function hideModal(event){
    // document.getElementById("overlay").style.display="none";
    event.parentNode.style.display = 'none';
    document.getElementById("login-modal").style.display = "none";
}