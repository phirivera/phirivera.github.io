<?php

    include('dbconfig.php');

    $product_name = $_GET["productname"];
    $product_price = $_GET["productprice"];
    $product_uom = $_GET["productuom"];
    $product_category = $_GET["productcategory"];

    $product_uom_id = 0;
    $product_category_id = 0;

    switch($product_uom){
        case "pack":
            $product_uom_id = 1;
            break;
        case "pc":
            $product_uom_id = 2;
            break;
        case "kg":
            $product_uom_id = 3;
            break;
    }

    switch($product_category){
        case "Leafy Greens":
            $product_category_id = 1;
            break;
        case "Fruiting Crops":
            $product_category_id = 2;
            break;
        case "Fruits":
            $product_category_id = 3;
            break;
        case "Root Crops":
            $product_category_id = 4;
            break;
    }



    $sql = 'INSERT INTO products(name,uom_id,category_id,price) VALUES("' . $product_name . '",' . $product_uom_id . ',' . $product_category_id . ',' . $product_price . ");";

    $result = $conn->query($sql);
?>