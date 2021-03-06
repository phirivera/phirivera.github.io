<?php

    include('dbconfig.php');

    $product_name = $_POST["name"];
    $product_price = $_POST["price"];
    $product_uom = strtolower($_POST["uom"]); // KG --> kg 
    $product_category = ucwords($_POST["category"]);

    $uom_id = null;
    $category_id = null;

    $sql_for_product_names = 'SELECT name FROM products WHERE name="' . $product_name . '"';
    $result = $conn->query($sql_for_product_names);

    if($result->num_rows==0){ // Product Name does not exist in DB
        
        $sql_for_uom = 'SELECT id FROM uom WHERE name="' . $product_uom . '"';
        $result = $conn->query($sql_for_uom);

        if($result->num_rows==1){ // UOM exists in DB
            
            while($row = $result->fetch_assoc()) {
                $uom_id = $row["id"];
            }

        } else { // UOM does not exist in DB
            
            // Insert new UOM in DB
            $sql_for_insert_new_uom = 'INSERT INTO uom(name) VALUES("' . $product_uom . '")';
            $result = $conn->query($sql_for_insert_new_uom);

            // Get ID of newly inserted UOM
            $sql_for_get_UOM_id_newly_inserted = 'SELECT id FROM uom ORDER BY id DESC LIMIT 1';
            $result = $conn->query($sql_for_get_UOM_id_newly_inserted);

            while($row = $result->fetch_assoc()) {
                $uom_id = $row["id"];
            }

        }

        $sql_for_category = 'SELECT id FROM categories WHERE name="' . $product_category . '"';
        $result = $conn->query($sql_for_category);
        
        if($result->num_rows==1){ // Category exists in DB
            while($row = $result->fetch_assoc()){
                $category_id = $row["id"];
            }
        } else { // Category does not exist in DB
            // Insert new Category in DB
            $sql_for_insert_new_category = 'INSERT INTO categories(name) VALUES("' . $product_category . '")';
            $result = $conn->query($sql_for_insert_new_category);

            // Get ID of newly inserted UOM
            $sql_for_get_category_id_newly_inserted = 'SELECT id FROM categories ORDER BY id DESC LIMIT 1';
            $result = $conn->query($sql_for_get_category_id_newly_inserted);

            while($row = $result->fetch_assoc()){
                $category_id = $row["id"];
            }

        }

        // Insert into DB(name,price,uom_id,category_id)

        $sql_for_insert_new_product = 'INSERT INTO products(name,price,uom_id,category_id) VALUES("' . $product_name . '",' . $product_price . ',' . $uom_id . ',' . $category_id . ')';
        $result = $conn->query($sql_for_insert_new_product);

        header("Location: head.php");
    } else {
        // ERROR: Product Name already exists in DB
    }


?>