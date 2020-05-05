document.getElementById('add-product-modal').style.display = "none";

document.getElementById('addprod-button').onclick = showDrawer;

document.getElementsByClassName('modal-close').onclick = hideModal;
// document.getElementById('overlay').onclick = hideModal;

function showDrawer(event){
    var mod = document.getElementById("add-product-modal");
    mod.style.display = "block";
    mod.classList.add("element");

}

//gets the parent (modal) of the close button
function hideModal(event){
    // document.getElementById("overlay").style.display="none";
    event.parentNode.style.display = 'none';
    document.getElementById("add-product-modal").style.display = "none";
}


var table = document.createElement("TABLE");
table.id = "tblCopy";
document.body.appendChild(table);
document.getElementById("tblCopy");

var arrHead = new Array();
arrHead = ['Actions', 'Name', 'Price', 'UOM', 'Category'];


function saveDeets(event){
    var appearEdit = event.parentNode.parentNode.rowIndex;       // TEXTFIELD -> TD -> TR.
    document.getElementById(appearEdit.id).style.display = "inline-block";
    document.getElementById("saveall").style.display = "inline-block";
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
            button.style.fontSize = '.7em';

            td.appendChild(button);

            // edit button
            var editbutton = document.createElement('input');
            editbutton.setAttribute('type', 'button');
            editbutton.setAttribute('value', 'Save');
            // background-color: #B8C800;
            editbutton.style.backgroundColor = '#B8C800';
            editbutton.style.fontSize = '.7em';

            editbutton.setAttribute('onclick', 'submitRow(this)');
            editbutton.id = rowCnt; // ROWCOUNT 
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
            ele.setAttribute('onchange', 'saveDeets(this)');
            ele.setAttribute('onkeyup', 'this.onchange()');
            ele.setAttribute('onpaste', 'this.onchange()');
            ele.setAttribute('oninput', 'this.onchange()');

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
            ele.setAttribute('onchange', 'saveDeets(this)');
            ele.setAttribute('onkeyup', 'this.onchange()');
            ele.setAttribute('onpaste', 'this.onchange()');
            ele.setAttribute('oninput', 'this.onchange()');

            td.appendChild(ele);

            //adding the data
            var dat = document.createElement('datalist');
            dat.setAttribute('id', 'catlist');
        }
    }
}

//function: confirmation to delete
function confirmRemove(event){
}



function showSaveButton(event){ // event is input text element
    //console.log("Inside showSaveButton");
    var table_row = event.parentNode.firstChild;
    // saveButton -> td -> tr -> td(1stchild)

}

function toggleDisplay(id) { 
    var el = document.getElementById(id);
    if (el && el.style) {
      el.style.display = '';
    } 
}

/*
// Submit table data to console
function submit() {
    //TODO: remove the save buttons if the main save button is pressed
    var myTab = document.getElementById('empTable');
    var values = new A
    
    
    
    
    rray();

    // LOOP THROUGH EACH ROW OF THE TABLE.
    for (row = 1; row < myTab.rows.length; row++) {
        for (c = 0; c < myTab.rows[row].cells.length; c++) {   // EACH CELL IN A ROW.

            var element = myTab.rows.item(row).cells[c];
            if (element.childNodes[0].getAttribute('type') == 'text') {
                values.push("'" + element.childNodes[0].value + "'");
            }
        }
    }
    
    document.getElementById("saveall").style.display = "none";
    console.log(values);
}
*/

//Function: to delete a row
function removeRow(event) {
    var id = event.id;
    id = id.split("_")[3];

    deleteProductFromDatabase(id);
}

function deleteProductFromDatabase(id){

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //document.getElementById("txtHint").innerHTML = this.responseText;
            location.reload();
        }
    };
    
    xmlhttp.open("GET","deleteproduct.php?productid=" + id, true);
    xmlhttp.send();

}

function rowSaveButtonClicked(event){ // event points to clicked Save button in row

    var table_row = event.parentNode.parentNode;

    var myTab = document.getElementById("empTable");
    var values = new Array();

    var save_button_id = event.id; //save_button_id_n

    //getting the product id 
    save_button_id= save_button_id.split("_")[3];
    values.push(save_button_id);

    var currTd = event.parentNode;

    //loop to get into td siblings

    console.log("currTd before the for loop :  " + currTd);

    for ( var i = 1; i< myTab.rows[1].cells.length; i++){

        currTd = currTd.nextElementSibling;
        //console.log("currTd.childNodes[1].value  :  " + currTd.childNodes[1].value);   
        values.push(currTd.childNodes[1].value);
        
    }

    updateDatabase(values);
    
}

function updateDatabase(values){

    var product_id = values[0];
    var product_name = values[1];
    var product_price = values[2];
    var product_uom = values[3];
    var product_category = values[4];

    var extensions = "?productid=" + product_id + "&productname=" + product_name + "&productprice=" + product_price + "&productuom=" + product_uom + "&productcategory=" + product_category;

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            //document.getElementById("txtHint").innerHTML = this.responseText;
            location.reload();
        }
    };
    
    xmlhttp.open("GET","updateproduct.php" + extensions, true);
    xmlhttp.send();

}


    /*

    ***
    if (currTd.childNodes[0].getAttribute["type"] == "text"){
        values.push("'" + currTd.childNodes[1].value + "'");
        }
    ***
    var values = new Array();

    var save_button_id = event.id;
    console.log("1: " + save_button_id);

    save_button_id = save_button_id.split("_"); // This one works!
    console.log("2: " + save_button_id);

    save_button_id = save_button_id[save_button_id.length-1];
    console.log("3: " + save_button_id);

    values.push(save_button_id);

    console.log("mytab.rows.length = " + myTab.rows.length);

    var involvedRow = myTab.rows.namedItem("prod_db_id_" + save_button_id);
    console.log("involvedRow.cells.length  :  " + involvedRow.cells.length);

    for(var i = 0 ; i < involvedRow.cells.length; i++){
        console.log("involvedRow.cells.item(i).value  :  " + involvedRow.cells.item(i));
    }

    */

    /*
    for (c = 0; c < myTab.rows.length; c++) {   // EACH CELL IN A ROW.

        var element = myTab.rows.item(save_button_id).cells[c];

        values.push(element.childNodes[1].value);

    }
    */
    

/*
function submitRow(event){

    event.style.display = "none";
    // TODO: maybe pass the change of that row only?
    // currently the Edit button calls the "submit()" function
    // which is submitting everything

    var myTab = document.getElementById('empTable');
    var values = new Array();

    for (c = 0; c < myTab.rows[event.id].cells.length; c++) {   // EACH CELL IN A ROW.

        var element = myTab.rows.item(event.id).cells[c];
        if (element.childNodes[0].getAttribute('type') == 'text') {
            //values.push("'" + element.childNodes[0].value + "'");
            values.push(element.childNodes[0].value);
        }
    }

    console.log(values, event.id); //  CHANGED

    var product_name = values[0];
    var product_price = values[1];
    var product_uom = values[2];
    var product_category = values[3];

    // all the shit needed are already in values(values of the row modified/clicked save button)... just need to find out how to use it to update db and refresh table
    insertRowIntoDB(product_name,product_price,product_uom,product_category);   
}
*/

function insertRowIntoDB(product_name,product_price,product_uom,product_category){
    
    /*
    if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            updateTable();
        }
    };

    var extensions = "?productname=" + product_name + "&productprice=" + product_price + "&productuom=" + product_uom + "&productcategory=" + product_category;

    xmlhttp.open("GET","insertrow.php" + extensions,false);
    xmlhttp.send();

    */

    var request = new XMLHttpRequest();

    var extensions = "?productname=" + product_name + "&productprice=" + product_price + "&productuom=" + product_uom + "&productcategory=" + product_category;
    
    request.open('GET','insertrow.php'+ extensions,false);
    request.send(null);

    if(request.status === 200){
        console.log('RS: ' + request.status);
        console.log(request.responseText);
    }

    //setTimeout(location.reload(),5000);

}

function updateTable(){

    /*
    if(window.XMLHttpRequest){
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("tablebody").innerHTML = this.responseText;
        }
    };

    xmlhttp.open("GET","gettable.php",false);
    xmlhttp.send(null);

    */

    var request = new XMLHttpRequest();

    xmlhttp.open("GET","gettable.php",false);
    xmlhttp.send(null);

    console.log('inside update table');
    

}

// DELETE FROM `products` WHERE id=0;