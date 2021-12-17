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
<form method="POST" id="changPassword" class = "changePassword">
    Username: &nbsp;<input type="text" name="username"><br>
    New password: <input type="text" name="newpassword"><br>
    Confirm password: <input type="text" name="confirmpassword"><br>
    <input type="submit" value="Confirm">
</form>
<?php
if ($_POST['newpassword']!="")
{
    if ($_POST['newpassword']==$_POST['confirmpassword'])
    {
        $sql = "UPDATE OfficerAccount SET Password='" . $_POST['newpassword'] . "' WHERE Username='" . $_POST['username'] . "'";
        $result = mysqli_query($conn,$sql);
    }
    else
        echo "please confirm your password correctly.";

}
?>
</body>
</html>
