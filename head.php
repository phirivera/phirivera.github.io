<?php

    // Checks if user is already logged in. If not, go to homepage/index
    session_start();
    if(isset($_SESSION['username']) && $_SESSION['loggedin']){
        
    } else {
        header('Location: index.php');
    }

    include('dbconfig.php')
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> 寺岡 | Teraoka Farms </title>
        <meta name="description" content="Teraoka farms - soft ui v1">
        <meta name="author" content="Sophia Therese Rivera">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=Muli|Rubik&display=swap" rel="stylesheet"> 
    </head>

    <body>

    <div id="add-product-modal" class="element" style="display: block;">
            <div id="drawer-button" class="element modal-close" onclick="hideModal(this)">
                <p id="close-copy">x</p>
            </div>
            
            <br>
            <br>   
            
            <p class="modal-title">Add Product</p>    
            
            <br>
            
            <form action="insertrow.php" method="POST">
                
                <label for="name"><b class="fas fa-user">Name</b></label>
                <input class="depress" type="text" name="name" placeholder="Name" id="name" required>
                
                <br>
                <br>
               
                <label for="password"><b class="fas fa-lock">Price</b></label>
                
                <input class="depress" type="text" name="price" placeholder="Price" id="price" required>
                
                <br>
                <br>

                <label for="uom"><b class="fas fa-user">UOM</b></label>
                <input class="depress" type="text" name="uom" placeholder="UOM" id="uom" required list="uomdl">
                <datalist id="uomdl">

                <?php 

                    $uom_array = array();

                    $sql_for_uom_list = 'SELECT name FROM uom';

                    $result_uom_list = $conn->query($sql_for_uom_list);
                    
                    while($row = $result_uom_list->fetch_assoc()){
                        array_push($uom_array,$row["name"]);
                    }

                    foreach($uom_array as $value){
                        echo '<option>' . $value . '</option>';
                    }

                ?>

                </datalist>
                <br>
                <br>

                <label for="category"><b class="fas fa-user">Category</b></label>
                <input class="depress" type="text" name="category" placeholder="Category" id="category" required list="dlcategory">
                <datalist id="dlcategory">
                <?php 

                    $category_array = array();

                    $sql_for_category_list = 'SELECT name FROM categories';

                    $result_category_list = $conn->query($sql_for_category_list);

                    while($row = $result_category_list->fetch_assoc()){
                        array_push($category_array,$row["name"]);
                    }

                    foreach($category_array as $value){
                        echo '<option>' . $value . '</option>';
                    }

                ?>
                </datalist>

                <br>
                <br>
                <br>
                
                <input class="element bulge" type="submit" value="Create">
              </form> 

        </div>

        <div id="overlay"></div>
        <div>
            <button class="element" id="logout-button" onClick="window.location.href='logout.php'">Logout</button>
        </div>
        <br>
        <br>
        <br>

        <div id="prodman">
            <h2 class="admin-h2">Products</h2>
            <button class="element simple-button" id="addprod-button" onclick="addRow()">Add Product</button>
            <input type="button" id="saveall" value="Save All Changes" onclick="submit()"/>
            <br>
            <br>
            <div id="cont"></div>

            <table id="empTable">
                <thead>
                    <tr>
                        <th>Actions</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>UOM</th>
                        <th>Category</th>
                    </tr>
                </thead>
                <tbody id="tablebody">
                    <?php

                        

                        $sql = 'SELECT p.id AS id, p.name AS name, u.name AS uom, c.name AS category, p.price FROM products p INNER JOIN categories c ON c.id=p.category_id INNER JOIN uom u ON u.id=p.uom_id ORDER BY p.name ASC';

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $trid = $row["id"];
                                $name = $row["name"]; // "Alugbati"
                                $uom = $row["uom"]; // "pack"
                                $category = $row["category"]; // "Leafy Greens"
                                $price = $row["price"]; // 50

                                // removed the ff methods of NAME only: onchange, onkeyup, onpaste, oninput

                                echo
                                '<tr id=prod_db_id_' . $trid . '>
                                    <td>
                                        <input type="button" id="delete_button_id_' . $trid . '" value="Remove" onclick="removeRow(this)" style="font-size: 0.7em;">
                                        <input type="button" id="save_button_id_' . $trid . '" value="Save" style="background-color: rgb(184, 200, 0); font-size: 0.7em; display: none;" onclick="rowSaveButtonClicked(this)">
                                    </td>
                                    <td>
                                        <input type="text" value="' . $name . '" oninput="toggleDisplay(\'save_button_id_' . $trid . '\')">
                                    </td>
                                    <td>
                                        <input type="text" value="'. $price . '" onchange="toggleDisplay(\'save_button_id_' . $trid . '\')" onkeyup="toggleDisplay(\'save_button_id_' . $trid . '\')" onpaste="toggleDisplay(\'save_button_id_' . $trid . '\')" oninput="toggleDisplay(\'save_button_id_' . $trid . '\')">
                                    </td>
                                    <td>
                                        <input type="text" list="uom" id="puom" name="puom" value="' . $uom . '" onchange="toggleDisplay(\'save_button_id_' . $trid . '\')" onkeyup="toggleDisplay(\'save_button_id_' . $trid . '\')" onpaste="toggleDisplay(\'save_button_id_' . $trid . '\')" oninput="toggleDisplay(\'save_button_id_' . $trid . '\')">
                                            <datalist id="uom">';

                                                foreach($uom_array as $value){
                                                    echo '<option>' . $value . '</option>';
                                                }
                                                
                                            echo '</datalist>
                                    </td>
                                    <td>
                                        <input type="text" value="' . $category . '" id="category" list="catlist" onchange="toggleDisplay(\'save_button_id_' . $trid . '\')" onkeyup="toggleDisplay(\'save_button_id_' . $trid . '\')" onpaste="toggleDisplay(\'save_button_id_' . $trid . '\')" oninput="toggleDisplay(\'save_button_id_' . $trid . '\')">
                                    </td>
                                </tr>';
                            }
                        } else {
                            echo "0 results";
                        }

                    ?>
                    
                    <!--<tr>
                        <td><input type="button" value="Remove" onclick="removeRow(this)" style="font-size: 0.7em;"> <input type="button" value="Save" style="background-color: rgb(184, 200, 0); font-size: 0.7em; display: none;" onclick="submitRow(this)" id="1"></td>
                        <td><input type="text" value="" onchange="saveDeets(this)" onkeyup="this.onchange()" onpaste="this.onchange()" oninput="this.onchange()"></td>
                        <td><input type="text" value="" onchange="saveDeets(this)" onkeyup="this.onchange()" onpaste="this.onchange()" oninput="this.onchange()"></td>
                        <td><input type="text" value="" id="puom" list="uom" onchange="saveDeets(this)" onkeyup="this.onchange()" onpaste="this.onchange()" oninput="this.onchange()"></td>
                        <td><input type="text" value="" id="category" list="catlist" onchange="saveDeets(this)" onkeyup="this.onchange()" onpaste="this.onchange()" oninput="this.onchange()"></td>
                    </tr>-->

                    </div>   
                </tbody>
            </table>

             <!--<table id="prod-table" style="width:80%"> 
                <tr class="element depress">
                <th>Product Name</th>
                <th>Price</th>
                <th>Unit of Measurement</th>
                <th>Actions</th>
                </tr>
                <tr>
                <td align="center" class="prodname">Lemon</td> 
                <td  align="center" class="prodprice">280</td>
                <td align="center" class="produom">per kg</td>
                <td align="center">
                
                    <button class="element simple-button prod-edit" onclick="addRow()">Edit</button>
                    <button class="element simple-button prod-delete">Delete</button>
                </td>
                </tr>
            </table> -->    
            <br>
            <br>
            
        </div>
        
        <script src="scripthead.js"></script>
    </body>
</html>


