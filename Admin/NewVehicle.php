<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Vehicle</title>
    <script src="ajax.js" type="text/javascript"></script>
</head>
<body>
<button onclick=openfile('HomePage.html')>Home</button><br>

<h1>Add a New Vehicle</h1>
<form method = "POST" id = "vehicle">
    <h2>Vehicle Details</h2>
    Licence: &nbsp;<input type="text" name="plate"><br>
    Make: <input type="text" name="make"><br>
    Model: <input type="text" name="model"><br>
    Colour:  <input type="text" name="colour"><br>
    <h2>Owner's Details</h2>
    Licence:  <input type="text" name="licence"><br>
    <input type="submit" value="Add">
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

if ($_POST['plate']!="" && $_POST['make']!="" && $_POST['model']!="" && $_POST['colour']!="")
{
    $sql = "SELECT * FROM Vehicle WHERE Vehicle_licence='" . $_POST['plate'] . "'";
    $result = mysqli_query($conn, $sql);
    }
else {
    echo "Please fill all the details of the vehicle!";
    die();
}


if (mysqli_num_rows($result)>0)
{
    echo "The vehicle's licence is already occupied!";
    die();
}


// Insert details of new vehicle into table Vehicle.
$sql = "SELECT * FROM Vehicle WHERE Vehicle_ID = (SELECT max(Vehicle_ID) FROM Vehicle)";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$vehID = $row['Vehicle_ID'] + 1; //get the max ID of the Vehicles and assign a new ID for the new vehicle.

$type = $_POST['make']." ".$_POST['model']; // Vehicle type contains the make and model of the vehicle.

$sql = "INSERT INTO Vehicle (Vehicle_ID, Vehicle_type, Vehicle_colour, Vehicle_licence) 
                VALUES (".$vehID.", '".$type."','".$_POST['colour']."', '".$_POST['plate']."')";
$result = mysqli_query($conn,$sql);


if ($_POST['licence']!="")
{
    $sql="SELECT * FROM People WHERE People_licence='".$_POST['licence']."'";
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result)==0)
    {
        echo "The owner is not recorded in the system. Press the button if you want to fill the details of the owner.";
        echo "<br>";
        echo "<button onclick=openfile('newperson.php')>Add details</button>";
        $sql="SELECT * FROM People WHERE People_ID = (SELECT max(People_ID) FROM People)";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $personID = $row['People_ID'] + 1;
        $sql = "INSERT INTO People (People_ID, People_name, People_address, People_licence)
                    VALUES (".$personID.", '', '', '".$_POST['licence']."')";
        $result = mysqli_query($conn,$sql);
        $sql= "INSERT INTO Ownership (People_ID, Vehicle_ID) VALUES (".$personID.",".$vehID.")";
        $result = mysqli_query($conn,$sql);
    }
    else
    {
        $row = mysqli_fetch_assoc($result);
        $sql= "INSERT INTO Ownership (People_ID, Vehicle_ID) VALUES (".$row['People_ID'].",".$vehID.")";
        $result = mysqli_query($conn,$sql);
    }
}

$sql="SELECT * FROM Vehicle ORDER BY Vehicle_ID";
$result = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_assoc($result))
{
    echo "<li>";
    echo $row['Vehicle_ID'];
    echo $row['Vehicle_type'];
    echo $row['Vehicle_colour'];
    echo $row['Vehicle_licence'];
    echo "</li>";
}

?>

</body>
</html>
