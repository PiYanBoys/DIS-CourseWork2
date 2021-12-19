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
<form method="POST" id="changPassword" class = "changePassword">
    Username: &nbsp;<input type="text" name="username"><br>
    New password: <input type="password" name="newpassword"><br>
    Confirm password: <input type="password" name="confirmpassword"><br>
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


if ($_POST['newpassword']!="")
{
    if ($_POST['newpassword']==$_POST['confirmpassword'])
    {
        $sql = "UPDATE OfficerAccount SET Password='" . $_POST['newpassword'] . "' WHERE Username='" . $_POST['username'] . "'";
        $result = mysqli_query($conn,$sql);
        echo "<script>alertChange()</script>";
    }
    else
        echo "please confirm your password correctly.";

}
?>
</body>
</html>
