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
<h1>cars</h1>
<form method="POST" class="yellow">
    Vehicle licence plate: &nbsp;<input type="text" name="plate"><br>
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

if ($_POST['plate']!=""){
    $sql = "SELECT * FROM Vehicle WHERE Vehicle_licence='" . $_POST['plate'] . "'";
    $result = mysqli_query($conn, $sql);
}


if (mysqli_num_rows($result)>0)
{
    while ($row = mysqli_fetch_assoc($result))
    {
        echo "<li>";
        echo $row["Vehicle_ID"]." ";
        echo $row["Vehicle_type"]." ";
        echo $row["Vehicle_colour"]." ";
        echo $row["Vehicle_licence"]." ";

        $sql1="SELECT * FROM Ownership WHERE Vehicle_ID='" . $row['Vehicle_ID'] . "'";
        $result1=mysqli_query($conn,$sql1);

        if(mysqli_num_rows($result1)>0)
        {
            $row1=mysqli_fetch_assoc($result1);
            $sql2="SELECT * FROM People WHERE People_ID='" . $row1['People_ID'] . "'";
            $result2=mysqli_query($conn,$sql2);
            if (mysqli_num_rows($result2)>0)
            {
                while ($row2 = mysqli_fetch_assoc($result2))
                {
                    echo "Owner's name: ".$row2["People_name"];
                    echo "Owner's licence: ".$row2["People_licence"];
                }}
        }
        else
            echo "Owner unknown";


        echo "</li>";
    }}
else
    echo "The vehicle is not in the system."
?>
</body>
</html>
