<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
    <script src="ajax.js" type="text/javascript"></script>
</head>
<body>
<button onclick=openfile('HomePage.html')>Home</button><br>
<h1>Edit a report</h1>
<p>Input the ID of the incident of which the report you want to edit.</p>
<p>Input the information you want to edit.</p>
<p>Leave blank where you don't need to edit.</p>
<form method="POST">
    Incident ID: &nbsp;<input type="text" name="ID"><br>
    Driver's licence: <input type="text" name="licence"><br>
    Vehicle's Licence: <input type="text" name="plate"><br>
    Report: <input type="text" name="report"><br>
    Date: <input id="date" type="date" name="date"><br>
    Type of Offence: <select name="offence">
        <option>Select an offence...</option>
        <option value="1">Speeding</option>
        <option value="2">Speeding on a motorway</option>
        <option value="3">Seat belt offence</option>
        <option value="4">Illegal parking</option>
        <option value="5">Drink driving</option>
        <option value="6">Driving without a licence</option>
        <option value="8">Traffic light offences</option>
        <option value="9">Cycling on pavement</option>
        <option value="10">Failure to have control of vehicle</option>
        <option value="11">Dangerous driving</option>
        <option value="12">Careless driving</option>
        <option value="13">Dangerous cycling</option>
    </select><br>
    <input type="submit" value="Submit">
</form>

<button type="button" onclick="loadDoc('retrieveReports.php')">See All Reports</button>
<div id="myDiv"></div>
<hr>

<?php
    //MySQL database information
    $servername = "127.0.0.1"; $username = "root"; $password = ""; $dbname = "test";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    //Check connection
    if(mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
    die();}

    $personNotfound = 0;
    $vehNotfound = 0;

    $sql = "SELECT * FROM Incident WHERE Incident_ID=".$_POST['ID'];
    $result = mysqli_query($conn,$sql);


    if (mysqli_num_rows($result) == 0)
    {
        echo "The Incident ID: ".$_POST['ID']."is not found in the database.";
        die();
    }


    if ($_POST['licence'] != "")
    {
        $sql = "SELECT * FROM People WHERE People_licence='" . $_POST['licence'] . "'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
            $personNotfound = 1;
            $sql="SELECT * FROM People WHERE People_ID = (SELECT max(People_ID) FROM People)";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            $personID = $row['People_ID'] + 1;
            $sql = "INSERT INTO People (People_ID, People_name, People_address, People_licence)
                    VALUES (".$personID.", '', '', '".$_POST['licence']."')";
            $result = mysqli_query($conn,$sql);
        }
        else {
            $row = mysqli_fetch_assoc($result);
            $personID = $row['People_ID'];
        }
        $sql = "UPDATE Incident SET People_ID = '" . $personID . "' WHERE Incident_ID =".$_POST['ID'];
        $result = mysqli_query($conn, $sql);
    }

    if ($_POST['plate'] != "") {
        $sql = "SELECT * FROM Vehicle WHERE Vehicle_licence='" . $_POST['plate'] . "'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
            $vehNotfound = 1;
            $sql = "SELECT * FROM Vehicle WHERE Vehicle_ID = (SELECT max(Vehicle_ID) FROM Vehicle)";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $vehID = $row['Vehicle_ID'] + 1;
            $sql= "INSERT INTO Vehicle (Vehicle_ID, Vehicle_type, Vehicle_colour, Vehicle_licence) 
                    VALUES (".$vehID.", '', '', '".$_POST['plate']."')";
            $result = mysqli_query($conn,$sql);
        } else {
            $row = mysqli_fetch_assoc($result);
            $vehID = $row['Vehicle_ID'];
        }
        $sql = "UPDATE Incident SET Vehicle_ID = '" . $vehID . "' WHERE Incident_ID =" . $_POST['ID'];
        $result = mysqli_query($conn, $sql);
    }

    if ($_POST['report']!="")
    {
        $sql = "UPDATE Incident SET Incident_Report = '" . $_POST['report'] . "' WHERE Incident_ID =" . $_POST['ID'];
        $result = mysqli_query($conn, $sql);
    }

    if ($_POST['date']!="")
    {
        $sql = "UPDATE Incident SET Incident_Date = '" . $_POST['date'] . "' WHERE Incident_ID =" . $_POST['ID'];
        $result = mysqli_query($conn, $sql);
    }

    if ($_POST['offence']!="")
    {
        $sql = "UPDATE Incident SET Offence_ID = '" . $_POST['offence'] . "' WHERE Incident_ID =" . $_POST['ID'];
        $result = mysqli_query($conn, $sql);
    }



    if ($vehNotfound==1 && $personNotfound==0)
    {
        echo "<script> if(confirm( 'The Vehicle is not recorded in the system. ' +
        'Do you want to fill the details now? '))  location.href='newInciVeh.php'; </script>";
        die();
    }
    elseif ($vehNotfound==0 && $personNotfound==1)
    {
        echo "<script> if(confirm( 'The driver is not recorded in the system. ' +
        'Do you want to fill the details now? '))  location.href='newperson.php'; </script>";
        die();
    }
    elseif ($vehNotfound==1 && $personNotfound==1)
    {
        echo "<script> if(confirm( 'The driver and the vehicle is not recorded in the system. ' +
        'Do you want to fill the details now? '))  location.href='newVeh&Per.php'; </script>";
        die();
    }
echo "<script>alertHome()</script>"

?>

</body>
</html>