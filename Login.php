<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <script src="ajax.js" type="text/javascript"></script>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
<br><br><br><br><br>
        <form method="POST">
            <h1>Login</h1>
            <label><span>Username: </span><input type="text" name="username"><br></label>
            <label><span>Password: </span><input type="password" name="password"><br></label>
            <label><span>&nbsp;</span><input type="submit" value="Log in"></label>
        </form>

        <hr>

            <?php

                require('connection.php');

                if ($_POST['username']=="Daniels")
                {
                    $sql = "SELECT * FROM OfficerAccount 
                        WHERE Username='" . $_POST['username'] . "' and Password='" . $_POST['password'] . "'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<script>alertAdmin()</script>";
                    }
                    else
                        echo "invalid username or password";
                }


                if ($_POST['username']!="")
                {
                    $sql = "SELECT * FROM OfficerAccount 
                        WHERE Username='" . $_POST['username'] . "' and Password='" . $_POST['password'] . "'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo "<script>alertLogin()</script>";
                    }
                    else
                        echo "invalid username or password";
                }

            ?>
    </body>
</html>