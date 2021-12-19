<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search Vehicles</title>
    <script src="ajax.js" type="text/javascript"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<button onclick=openfile('HomePage.html')>Home</button><br>


<form method="POST">
    <h1>Search a Vehicle
    <span>Fill in the licence plate of a vehicle to retrieve.</span></h1>
    <label><span>Vehicle licence plate: &nbsp;</span><input type="text" name="plate"><br></label>
    <label><span>&nbsp;</span><input type="submit" value="Search"></label>
</form>
<?php
require('connection.php');

if ($_POST['plate']!=""){
    $sql = "SELECT * FROM Vehicle WHERE Vehicle_licence='" . $_POST['plate'] . "'";
    $result = mysqli_query($conn, $sql);
}


if (mysqli_num_rows($result)>0)
{
    echo "<table>";
    echo "<caption>".mysqli_num_rows($result)." result found in the system.<br></caption>";
    echo "<thead><th>ID</th><th>Type</th><th>Colour</th>
            <th>Licence Plate</th><th>Owner's Name</th><th>Owner's Licence</th></thead>";
    while ($row = mysqli_fetch_assoc($result))
    {
        echo "<tr>";
        echo "<td>".$row["Vehicle_ID"]."</td>";
        echo "<td>".$row["Vehicle_type"]."</td>";
        echo "<td>".$row["Vehicle_colour"]."</td>";
        echo "<td>".$row["Vehicle_licence"]."</td>";

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
                    echo "<td>".$row2["People_name"]."</td>";
                    echo "<td>".$row2["People_licence"]."</td>";
                }}
        }
        else {
            echo "<td> </td>";
            echo "<td> </td>";}


        echo "</tr>";
    }
    echo "</table>";
}
else
    echo "<p>The vehicle is not in the system.</p>"
?>
</body>
</html>
