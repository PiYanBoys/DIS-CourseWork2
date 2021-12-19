<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="ajax.js" type="text/javascript"></script>
</head>
<body>
<button onclick=openfile('HomePage.html')>Home</button><br>
<form method="POST">
    <h1>Information of New Person</h1>
    Name: <input type="text" name="name"><br>
    Address: <input type="text" name="address"><br>
    <input type="submit" value="Confirm">
</form>
<?php

//MySQL database information
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "test";
//Open the database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
//Check connection
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
    die();
}


if ($_POST['name']!="")
{
    $sql = "UPDATE People SET People_name = '".$_POST['name']."' WHERE People_ID = (SELECT max(People_ID) FROM People)";
    $result = mysqli_query($conn,$sql);
    $sql = "UPDATE People SET People_address = '".$_POST['address']."' WHERE People_ID = (SELECT max(People_ID) FROM People)";
    $result = mysqli_query($conn,$sql);
    echo "<script>alertHome()</script>";
}
else {
    echo "Name cannot be empty!";
    die();}
?>
</body>
</html>
