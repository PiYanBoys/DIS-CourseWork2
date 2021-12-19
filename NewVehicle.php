<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Vehicle</title>
    <script src="ajax.js" type="text/javascript"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<button onclick=openfile('HomePage.html')>Home</button><br>


<form method = "POST" id = "vehicle">
    <h1>Add a New Vehicle
        <span>Please fill in all the details.</span></h1>
    <label><span>Licence: &nbsp;</span><input type="text" name="plate"><br></label>
    <label><span>Make: </span><input type="text" name="make"><br></label>
    <label><span>Model: </span><input type="text" name="model"><br></label>
    <label><span>Colour:  </span><input type="text" name="colour"><br></label>
    <h1> </h1>
    <h1>Owner's Details
        <span>Fill in the licence if you want to assign the owner of the vehicle.</span></h1>
    <label><span>Licence:  </span><input type="text" name="licence"><br></label>
    <label><span>&nbsp;</span><input type="submit" value="Add"></label>
</form>


<?php
require('connection.php');

if ($_POST['plate']!="" && $_POST['make']!="" && $_POST['model']!="" && $_POST['colour']!="")
{
    $sql = "SELECT * FROM Vehicle WHERE Vehicle_licence='" . $_POST['plate'] . "'";
    $result = mysqli_query($conn, $sql);
    }
else {
    echo "<p>Please fill all the details of the vehicle!</p>";
    die();
}


if (mysqli_num_rows($result)>0)
{
    echo "<p>The vehicle's licence is already occupied!</p>";
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
        echo "<script> if(confirm( 'The owner is not recorded in the system.' +
            ' Do yuu want to fill in the details now?'))  location.href='newperson.php'; </script>";
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
