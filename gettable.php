<?php

include('dbconfig.php');

$sql = 'SELECT p.name AS name, u.name AS uom, c.name AS category, p.price FROM products p INNER JOIN categories c ON c.id=p.category_id INNER JOIN uom u ON u.id=p.uom_id';

                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $name = $row["name"]; // "Alugbati"
                                $uom = $row["uom"]; // "pack"
                                $category = $row["category"]; // "Leafy Greens"
                                $price = $row["price"]; // 50
                                
                                if(!isset($id)){
                                    $id = 1;
                                }

                                echo '<tr><td><input type="button" value="Remove" onclick="removeRow(this)" style="font-size: 0.7em;"> <input type="button" value="Save" style="background-color: rgb(184, 200, 0); font-size: 0.7em; display: none;" onclick="submitRow(this)" id="' . $id . '"></td>
                                <td><input type="text" value="'  . $name . '" onchange="saveDeets(this)" onkeyup="this.onchange()" onpaste="this.onchange()" oninput="this.onchange()"></td>
                                <td><input type="text" value="'. $price . '" onchange="saveDeets(this)" onkeyup="this.onchange()" onpaste="this.onchange()" oninput="this.onchange()"></td>
                                <td><input type="text" value="' . $uom . '" id="puom" list="uom" onchange="saveDeets(this)" onkeyup="this.onchange()" onpaste="this.onchange()" oninput="this.onchange()"></td>
                                <td><input type="text" value="' . $category . '" id="category" list="catlist" onchange="saveDeets(this)" onkeyup="this.onchange()" onpaste="this.onchange()" oninput="this.onchange()"></td>
                            </tr>';
                                $id = $id+1;
                            }
                        } else {
                            echo "0 results";
                        }

?>