<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Person</title>
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
    <label><span>&nbsp;</span><input type="submit" value="Confirm"></label>
</form>
<?php
require('connection.php');


if ($_POST['name']!="")
{
    $sql = "UPDATE People SET People_name = '".$_POST['name']."' WHERE People_ID = (SELECT max(People_ID) FROM People)";
    $result = mysqli_query($conn,$sql);
    $sql = "UPDATE People SET People_address = '".$_POST['address']."' WHERE People_ID = (SELECT max(People_ID) FROM People)";
    $result = mysqli_query($conn,$sql);
    echo "<script>alertHome()</script>";
}
else {
    echo "<script>alert('Name CANNOT be empty!')</script>";
    die();}
?>
</body>
</html>
