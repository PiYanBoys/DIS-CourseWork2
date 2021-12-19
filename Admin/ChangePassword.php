<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Change Password</title>
    <script src="../ajax.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<button onclick=openfile('HomePage.html')>Home</button><br>

<form method="POST" id="changPassword" class = "changePassword">
    <h1>Reset Password</h1>
    <label><span>Username: </span><input type="text" name="username"><br></label>
    <label><span>Current Password: </span><input type="password" name="password"><br></label>
    <label><span>New password: </span><input type="password" name="newpassword"><br></label>
    <label><span>Confirm password: </span><input type="password" name="confirmpassword"><br></label>
    <label><span>&nbsp;</span><input type="submit" value="Confirm"></label>
</form>
<?php
require('../connection.php');

if ($_POST['username']!="")
{
    $sql = "SELECT * FROM OfficerAccount 
        WHERE Username='" . $_POST['username'] . "' and Password='" . $_POST['password'] . "'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0)
    {
        echo "<p>invalid username or password.</p>>";
        die();
    }
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
        echo "<p>please confirm your password correctly.</p>>";

}
?>
</body>
</html>
