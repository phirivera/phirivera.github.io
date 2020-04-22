<?php

include('dbconfig.php');

$acct_username = "luigi";
$acct_password = "1234"; //1234

$hashedPW = password_hash($acct_password, PASSWORD_DEFAULT);

//$sql = 'INSERT INTO accounts(username,password) VALUES("' . $acct_username . '","' . $hashedPW . '");';
$sql = 'INSERT INTO accounts(name,username,email,password) VALUES("Luigi Tutaan","luigi","karlluigi.tutaan@gmail.com","'. $hashedPW . '"),
("Sophia Rivera","sophia","sophiatherese.rivera@gmail.com","' . $hashedPW . '");';

$result = $conn->query($sql);
header('Location: index.php');

?>