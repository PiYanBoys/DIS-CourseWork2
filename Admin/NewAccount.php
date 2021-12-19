<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Accouunt</title>
    <script src="../ajax.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<button onclick=openfile('HomePage.html')>Home</button><br>

<form method="POST">
    <h1>New Officer Account</h1>
    <label><span>Username: </span><input type="text" name="username"><br></label>
    <label><span>Password: </span><input type="password" name="password"><br></label>
    <label><span>&nbsp;</span><input type="submit" value="Confirm"></label>
</form>
<?php
require('../connection.php');


if ($_POST['username']!="" && $_POST['password']!="")
{
    $sql = "INSERT INTO OfficerAccount (Username, Password) 
                VALUES ('".$_POST['username']."', '".$_POST['password']."')";
    $result = mysqli_query($conn,$sql);
    echo "<script>alert('New account added!')</script>";
}
else
{
    echo "<script>alert('Username and password CANNOT be empty!')</script>";
    die();
}

?>
</body>
</html>
