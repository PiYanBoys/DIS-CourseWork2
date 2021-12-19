<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>People</title>
    <script src="../ajax.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<button onclick=openfile('HomePage.html')>Home</button><br>

    <form method="POST" class="yellow">
        <h1>Search People</h1>
        <label><span>License Number: &nbsp;</span><input type="text" name="licence"><br></label>
        <label><span>Name: </span><input type="text" name="name"><br></label>
        <label><span>&nbsp;</span><input type="submit" value="Search"></label>
    </form>
<hr>
    <?php
        require('../connection.php');

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
            echo "<table>";
            echo "<caption>".mysqli_num_rows($result)." results matched.<br></caption>";
            echo "<thead><th>ID</th><th>Name</th><th>Address</th><th>Driver licence</th></thead>";
            while ($row = mysqli_fetch_assoc($result))
            {
                echo "<tr>";
                echo "<td>".$row["People_ID"]."</td>";
                echo "<td>".$row["People_name"]."</td>";
                echo "<td>".$row["People_address"]."</td>";
                echo "<td>".$row["People_licence"]."</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        else
            echo "<p>No result matched.</p>"
    ?>
</body>
</html>
