
var table = document.createElement("TABLE");
table.id = "tblCopy";
document.body.appendChild(table);
document.getElementById("tblCopy");

document.getElementById('addprod-button').onclick = show_addModal;
document.getElementsByClassName('modal-close').onclick = hide_modal;
document.getElementById('overlay').onclick = hide_modal;


function show_addModal(event){
    document.getElementById("overlay").style.display="block";
    var mod = document.getElementById("addprod-modal");
    mod.style.display = "block";
    mod.classList.add("modal");
    mod.classList.add("element");
}

function edit_product(event){

    var targ = event.target || event.srcElement;
    document.getElementById("").value += targ.textContent || targ.innerText;

    document.getElementById("overlay").style.display="block";
    var mod = document.getElementById("editprod-modal");
    mod.style.display = "block";
    mod.classList.add("modal");
    mod.classList.add("element");


}

//gets the parent (modal) of the close button
function hide_modal(event){
    document.getElementById("overlay").style.display="none";
    event.parentNode.style.display = 'none';
}

//EDIT FROM TABLE -- TO BE CODED PA

// ARRAY FOR HEADER.
var arrHead = new Array();
arrHead = ['Product Name', 'Price', 'Unit of Measurement', 'Actions'];      // SIMPLY ADD OR REMOVE VALUES IN THE ARRAY FOR TABLE HEADERS.




    // ADD A NEW ROW TO THE TABLE.s
    function addRow() {
        var empTab = document.getElementById('prod-table');

        var rowCnt = empTab.rows.length;        // GET TABLE ROW COUNT.
        var tr = empTab.insertRow(rowCnt);      // TABLE ROW.
        tr = empTab.insertRow(rowCnt);

        for (var c = 0; c < arrHead.length; c++) {
            var td = document.createElement('td');          // TABLE DEFINITION.
            td = tr.insertCell(c);

            if (c == 0) {           // FIRST COLUMN.
                // ADD A BUTTON.
                var button = document.createElement('input');

                // SET INPUT ATTRIBUTE.
                button.setAttribute('type', 'button');
                button.setAttribute('value', 'Remove');

                // ADD THE BUTTON's 'onclick' EVENT.
                button.setAttribute('onclick', 'removeRow(this)');

                td.appendChild(button);
            }
            else {
                // CREATE AND ADD TEXTBOX IN EACH CELL.
                var ele = document.createElement('input');
                ele.setAttribute('type', 'text');
                ele.setAttribute('value', '');

                td.appendChild(ele);
            }
        }
    }

    