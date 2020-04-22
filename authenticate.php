<?php

session_start();

$form_username = $_POST['username'];
$form_password = $_POST['password'];

include('dbconfig.php');

$sql = 'SELECT * FROM accounts WHERE username="' . $form_username . '";';

$result = $conn->query($sql);

if ($result->num_rows == 1) {
    echo $result->num_rows;
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $form_password;
        if(password_verify($form_password,$row['password'])){
            echo 'found2';
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['username'];
            header('Location: head.php');
        }

        //header('Location: wrongpw.php');
    }
} else {
    header('Location: index.php');
}
?>