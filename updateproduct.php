<?php

    include('dbconfig.php');

    $product_id = $_GET["productid"];
    $product_name = $_GET["productname"];
    $product_price = $_GET["productprice"];
    $product_uom = $_GET["productuom"];
    $product_category = $_GET["productcategory"];

    // Check if product ID exists in database

    $sql_for_check_prod_id_in_db = 'SELECT * FROM products WHERE id=' . $product_id;
    $result = $conn->query($sql_for_check_prod_id_in_db);

    if($result->num_rows==1){

        // Check if UOM exists in DB

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

        // Check if Category exists in DB

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

        // Update DB

        $sql_for_update_product = 'UPDATE products SET name="' . $product_name . '", price=' . $product_price . ', uom_id=' . $uom_id . ', category_id=' . $category_id . ' WHERE id=' . $product_id;
        $result = $conn->query($sql_for_update_product);

        echo 'window.location.replace("http://www.w3schools.com");';

    } else {
        // Product ID not found in DB or more than 1 Product ID in DB
    }
    



?>