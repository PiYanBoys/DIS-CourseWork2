<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="POST">
    <h1>Information of New Vehicle</h1>
    Make: <input type="text" name="make"><br>
    Model: <input type="text" name="model"><br>
    Colour:  <input type="text" name="colour"><br>
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


if ($_POST['make']!="" && $_POST['model']!="" && $_POST['colour']!="")
{
    $type = $_POST['make']." ".$_POST['model'];
    $sql = "UPDATE Vehicle SET Vehicle_type = '".$type."' WHERE Vehicle_ID = (SELECT max(Vehicle_ID) FROM Vehicle)";
    $result = mysqli_query($conn,$sql);
    $sql = "UPDATE Vehicle SET Vehicle_colour = '".$_POST['colour']."' WHERE Vehicle_ID = (SELECT max(Vehicle_ID) FROM Vehicle)";
    $result = mysqli_query($conn,$sql);
}
else
    echo "Please fill all the blanks!";
?>
</body>
</html>
