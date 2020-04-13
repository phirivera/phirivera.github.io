
var table = document.createElement("TABLE");
table.id = "tblCopy";
document.body.appendChild(table);
document.getElementById("tblCopy");

var arrHead = new Array();
arrHead = ['Actions', 'Name', 'Price', 'UOM', 'Category'];


function saveDeets(event){
    var appearEdit = event.parentNode.parentNode.rowIndex;       // TEXTFIELD -> TD -> TR.
    document.getElementById(appearEdit).style.display = "block";

}

function createTable() {
    var empTable = document.createElement('table');
    empTable.setAttribute('id', 'empTable');            // set table id

    var tr = empTable.insertRow(-1);

    for (var h = 0; h < arrHead.length; h++) {
        var th = document.createElement('th');          // table header
        th.innerHTML = arrHead[h];
        tr.appendChild(th);
    }

    var div = document.getElementById('cont');
    div.appendChild(empTable);    
}





// Add a new row to the table
function addRow() {
    var empTab = document.getElementById('empTable');

    var rowCnt = empTab.rows.length;        // table row count
    var tr = empTab.insertRow(rowCnt);      // tr

    for (var c = 0; c < arrHead.length; c++) {
        var td = document.createElement('td');          // td
        td = tr.insertCell(c);

        //c means column
        if (c == 0) {          
            // remove button
            var button = document.createElement('input');
            button.setAttribute('type', 'button');
            button.setAttribute('value', 'Remove');
            button.setAttribute('onclick', 'removeRow(this)');

            td.appendChild(button);

            // edit button
            var editbutton = document.createElement('input');
            editbutton.setAttribute('type', 'button');
            editbutton.setAttribute('value', 'Save');

            editbutton.setAttribute('onclick', 'saveRow(this)');
            editbutton.id = rowCnt;
            editbutton.style.display = "none";

            td.appendChild(editbutton);
        }
        else if (c <3){
            // create textboxes. changing the content will go to saveDeets() --> adds the Save button
            var ele = document.createElement('input');
            ele.setAttribute('type', 'text');
            ele.setAttribute('value', '');
            ele.setAttribute('onchange', 'saveDeets(this)');
            ele.setAttribute('onkeyup', 'this.onchange()');
            ele.setAttribute('onpaste', 'this.onchange()');
            ele.setAttribute('oninput', 'this.onchange()');

            td.appendChild(ele);
        }else if (c == 3){
            // <input class="depress" type="text" list="uom" id="puom" name="puom"/>
            //     <datalist id="uom">
            //     <option>kg</option>
            //     <option>pack</option>
            //     <option>piece</option>
            //     </datalist>

            var ele = document.createElement('input');
            ele.setAttribute('type', 'text');
            ele.setAttribute('value', '');
            ele.setAttribute('id', 'puom');
            ele.setAttribute('list', 'uom');

            td.appendChild(ele);

            //adding the data
            var dat = document.createElement('datalist');
            dat.setAttribute('id', 'uom');

        }else{
            var ele = document.createElement('input');
            ele.setAttribute('type', 'text');
            ele.setAttribute('value', '');
            ele.setAttribute('id', 'category');
            ele.setAttribute('list', 'catlist');

            td.appendChild(ele);

            //adding the data
            var dat = document.createElement('datalist');
            dat.setAttribute('id', 'catlist');
        }
    }
}

//Function: to delete a row
function removeRow(oButton) {
    var empTab = document.getElementById('empTable');
    empTab.deleteRow(oButton.parentNode.parentNode.rowIndex);       // BUTTON -> TD -> TR.
}

// Submit table data to console
function submit() {
    //TODO: remove the save buttons if the main save button is pressed
    var myTab = document.getElementById('empTable');
    var values = new Array();

    // LOOP THROUGH EACH ROW OF THE TABLE.
    for (row = 1; row < myTab.rows.length; row++) {
        for (c = 0; c < myTab.rows[row].cells.length; c++) {   // EACH CELL IN A ROW.

            var element = myTab.rows.item(row).cells[c];
            if (element.childNodes[0].getAttribute('type') == 'text') {
                values.push("'" + element.childNodes[0].value + "'");
            }
        }
    }
    
    console.log(values);
}

function saveRow(event){
    event.style.display = "none";
    // TODO: maybe pass the change of that row only?
    // currently the Edit button calls the "submit()" function
    // which is submitting everything

    var myTab = document.getElementById('empTable');
    var values = new Array();

    for (c = 0; c < myTab.rows[event.id].cells.length; c++) {   // EACH CELL IN A ROW.

        var element = myTab.rows.item(event.id).cells[c];
        if (element.childNodes[0].getAttribute('type') == 'text') {
            values.push("'" + element.childNodes[0].value + "'");
        }
    }

    console.log(values);

}