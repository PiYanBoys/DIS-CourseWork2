<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Accouunt</title>
    <script src="ajax.js" type="text/javascript"></script>
</head>
<body>
<button onclick=openfile('HomePage.html')>Home</button><br>
<form method="POST">
    <h1>New Officer Account</h1>
    Username: <input type="text" name="username"><br>
    Password: <input type="password" name="password"><br>
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


if ($_POST['username']!="" && $_POST['password']!="")
{
    $sql = "INSERT INTO OfficerAccount (Username, Password) 
                VALUES ('".$_POST['username']."', '".$_POST['password']."')";
    $result = mysqli_query($conn,$sql);
    echo "New account added.";
}
else
{
    echo "Do NOT leave blanks!";
    die();
}

?>
</body>
</html>
