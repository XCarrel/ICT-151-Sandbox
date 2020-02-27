<?php

require "crud.php";
$dbh = getPDO();
$query = "SELECT count(*) as nb FROM filmmakers";
$statment = $dbh->prepare($query);//prepare query
$statment->execute();//execute query
$queryResult = $statment->fetch(PDO::FETCH_ASSOC);//prepare result for client
extract($queryResult);

echo "nb = $nb\n";
?>