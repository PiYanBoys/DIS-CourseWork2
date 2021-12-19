<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Vehicle & Person</title>
    <script src="ajax.js" type="text/javascript"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<button onclick=openfile('HomePage.html')>Home</button><br>

<form method="POST">
    <h1>Information of New Person
    <span>Name is necessary.</span></h1>
    <label><span>Name: </span><input type="text" name="name"><br></label>
    <label><span>Address: </span><input type="text" name="address"><br></label>
    <h1>&nbsp;</h1>
    <h1>Information of New Vehicle
    <span>Please fill in all the details.</span></h1>
    <label><span>Make: </span><input type="text" name="make"><br></label>
    <label><span>Model: </span><input type="text" name="model"><br></label>
    <label><span>Colour: </span><input type="text" name="colour"><br></label>
    <label><span>&nbsp;</span><input type="submit" value="Confirm"></label>
</form>

<?php
require('connection.php');


if ($_POST['name']!="" && $_POST['make']!="" && $_POST['model']!="" && $_POST['colour']!="")
{
    $type = $_POST['make']." ".$_POST['model'];
    $sql = "UPDATE Vehicle SET Vehicle_type = '".$type."' WHERE Vehicle_ID = (SELECT max(Vehicle_ID) FROM Vehicle)";
    $result = mysqli_query($conn,$sql);
    $sql = "UPDATE Vehicle SET Vehicle_colour = '".$_POST['colour']."' WHERE Vehicle_ID = (SELECT max(Vehicle_ID) FROM Vehicle)";
    $result = mysqli_query($conn,$sql);
    $sql = "UPDATE People SET People_name = '".$_POST['name']."' WHERE People_ID = (SELECT max(People_ID) FROM People)";
    $result = mysqli_query($conn,$sql);
    if ($_POST['address']!="")
    {
        $sql = "UPDATE People SET People_address = '".$_POST['address']."' WHERE People_ID = (SELECT max(People_ID) FROM People)";
        $result = mysqli_query($conn,$sql);
    }
    echo "<script>alertHome()</script>";
}
else {
    echo "<script>alert('Name, Make, Model, Colour CANNOT be empty!')</script>";
    die();}
?>
</body>
</html>
