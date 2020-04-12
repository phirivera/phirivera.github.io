document.getElementById("all").className += " active"; 

document.getElementById("logo").onmouseover = showChicken;
document.getElementById("logo").onmouseleave = hideChicken;

document.getElementById("close").onclick = closePop; 
document.getElementById("popper").onclick = closePop;

document.getElementById("all").onclick = tab_click; 
document.getElementById("leafy-greens").onclick = tab_click; 
document.getElementById('fruits').onclick = tab_click; 
document.getElementById('fruiting-crops').onclick = tab_click; 
document.getElementById('root-crops').onclick = tab_click; 

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

function showChicken(event){
    document.getElementById("chicken").style.display = "inline-block";
}

function hideChicken(event){
    document.getElementById("chicken").style.display = "none";
}

function closePop(clicked){
    document.getElementById("popper").style.display = 'none';
}

function tab_click(clicked) { 

    const produce = ['leafy-greens', 'fruits', 'fruiting-crops', 'root-crops'];
    
    if (this.id != 'all'){

        const index = produce.indexOf(this.id);
        if (index > -1) 
            produce.splice(index, 1);

        //clicked button's id should be removed from "produce" already

        // other buttons are hidden
        for(i=0; i<produce.length; i++){
            var cards = document.getElementsByClassName(produce[i]);
            var cnt;
            for (cnt = 0; cnt < cards.length; cnt++) {
                cards[cnt].style.display = "none";
            }

        }

        //clicked button's id is reset
        var x = document.getElementsByClassName(this.id);
        var i;
        for (i = 0; i < x.length; i++) {
                x[i].style.display = "inline-block";
        }
    
    }else{
        console.log('it is all')
        var x = document.getElementsByClassName('card');
        var i;
        for (i = 0; i < x.length; i++) {
                x[i].style.display = "inline-block";
        }
    }

    // Get all elements with class="tab" and remove the class "active"
    tablinks = document.getElementsByClassName("tab");
    for (i = 0; i < tablinks.length; i++) {
        console.log(tablinks[i].id + " " + tablinks[i].classname);
        tablinks[i].className = tablinks[i].className.replace(" active", "");
        console.log(tablinks[i].id + " " + tablinks[i].classname);
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    
    event.currentTarget.className += " active";
    
}  
