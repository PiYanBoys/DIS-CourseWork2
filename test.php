<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script src="ajax.js" type="text/javascript"></script>
        <style>
            form.changePassword{
                display:none;
            }
            form.show{
                display: block;
            }
            form.yellow{
                color: blue;
            }
        </style>
    </head>
    <body>
        <h1>Login</h1>
        <form method="POST" class="yellow">
            Username: &nbsp;<input type="text" name="username"><br>
            Password: <input type="password" name="password"><br>
            <input type="submit" value="Log in">
        </form>

        <hr>

            <?php

                //MySQL database information
                $servername = "127.0.0.1";
                $username = "root";
                $password = "";
                $dbname = "test";

                //Open the database connection
                $conn = mysqli_connect($servername, $username, $password, $dbname);

                //Check connection
                if(mysqli_connect_errno())
                {
                    echo "Failed to connect to MySQL: ".mysqli_connect_error();
                    die();
                }


                if ($_POST['username']!="")
                {
                    $sql = "SELECT * FROM OfficerAccount WHERE Username='" . $_POST['username'] . "' and Password='" . $_POST['password'] . "'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        echo "login succeeded";
                        $login=1;
                    }
                    else
                        echo "invalid username or password";
                }
                if ($login==1)
                {
                    echo "<a  href='?change=$username' class='change11'>Change password</a>";
                }

                if ($_GET['change']!="")
                    header("Location: changepassword.php");


            ?>
        <script>
            var button = document.querySelector(".change11")
            var form = document.querySelector(".changePassword")
            button.addEventListener("click", function (e) {
                e.preventDefault();
                window.location.href='changepassword.php'
                console.log(e);
                console.log(e);
                form.classList.remove("changePassword");
                form.classList.add("show")
                form.classList.add("yellow")
            })
        </script>
    </body>
</html>