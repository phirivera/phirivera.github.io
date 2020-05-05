<?php

include('dbconfig.php');

    $product_id = $_GET["productid"];

    $sql_for_delete_product = "DELETE FROM products WHERE id=" . $product_id;
    $result = $conn->query($sql_for_delete_product);
?>