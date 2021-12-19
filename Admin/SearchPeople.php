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
    <h1>Search People</h1>
    <form method="POST" class="yellow">
        License Number: &nbsp;<input type="text" name="licence"><br>
        Name: <input type="text" name="name"><br>
        <input type="submit" value="Search">
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
        if(mysqli_connect_errno())
        {
            echo "Failed to connect to MySQL: ".mysqli_connect_error();
            die();
        }

        if ($_POST['licence']!="" or $_POST['name']!="")
        {
            if ($_POST['licence']=="" && $_POST['name']!="")
            {
                $sql = "SELECT * FROM People WHERE People_name like '%" . $_POST['name'] . "%'";
                $result = mysqli_query($conn, $sql);
            }
            else if ($_POST['licence']!="" && $_POST['name']=="") {
                $sql = "SELECT * FROM People WHERE People_licence='" . $_POST['licence'] . "'";
                $result = mysqli_query($conn, $sql);
            }
            else
            {
                $sql = "SELECT * FROM People WHERE People_name like '%" . $_POST['name'] . "%' and People_licence='%" . $_POST['licence'] . "%'";
                $result = mysqli_query($conn, $sql);
            }
        }

        if (mysqli_num_rows($result)>0)
        {
            while ($row = mysqli_fetch_assoc($result))
            {
                echo "<li>";
                echo $row["People_name"];
                echo $row["People_address"];
                echo $row["People_licence"];
                echo "</li>";
            }}
        else
            echo "No result matched."
    ?>
</body>
</html>
