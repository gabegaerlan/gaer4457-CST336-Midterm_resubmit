<?php
// Creates Database Connection

function getDatabaseConnection()
{
    
    $host = "us-cdbr-iron-east-05.cleardb.net";
    $username = "bb1b68defac2a8";
    $password = "dd805de4";
    $dbname= "heroku_145ab6392c94383";

// Create connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    return $conn;
}
?>