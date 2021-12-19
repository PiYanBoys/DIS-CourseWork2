<?php
//MySQL database information
$servername = "127.0.0.1"; $username = "root"; $password = ""; $dbname = "test";
$conn = mysqli_connect($servername, $username, $password, $dbname);
//Check connection
if(mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
    die();}
?>