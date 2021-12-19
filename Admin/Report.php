<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
    <script src="../ajax.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../style.css">
</head>
<body>

<button onclick=openfile('HomePage.html') class="home">Home</button><br>


<form method="POST">
    <h1>Report an incident
    <span>Please fill in all the details of the report!</span>
    </h1>
    <label><span>Driver's License: </span><input type="text" name="licence"></label>
    <label><span>Vehicle's Licence: </span><input type="text" name="plate"><br></label>
    <label><span>Report: </span><input type="text" name="report" id="report"><br></label>
    <label><span>Date: </span><input id="date" type="date" name="date"><br></label>
    <label><span>Type of Offence: </span><select name="offence">
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
        </select></label>

    <label><span>&nbsp;</span><input type="submit" value="Submit"></label>
</form>
<hr>

<div id="myDiv"></div>


<form method="POST">
    <h1>Retrieve a report
    <span>Please provide at least one of the followings</span>
    </h1>
    <label><span>Driver's License: </span><input type="text" name="licence1"><br></label>
    <label><span>Vehicle's Licence: </span><input type="text" name="plate1"><br></label>
    <label><span>Date: </span><input id="date" type="date" name="date1"><br></label>
    <label><span>&nbsp;</span><input type="submit" value="Retrieve">
        <button type="button" onclick="openfile('editReport.php')">Edit Reports</button>
        <button type="button" onclick="loadDoc('../retrieveReports.php')">See all reports</button></label>
</form>



<hr>

<?php
require('../connection.php');



$condition1 = "1=1"; $condition2 = "1=1"; $condition3 = "1=1";

if ($_POST['licence1']!="" or $_POST['plate1']!="" or $_POST['date1']!="")
{
    if ($_POST['licence1']!="") {
        $sql = "SELECT * FROM People WHERE People_licence='".$_POST['licence1']."'";
        $result = mysqli_query($conn,$sql);
        if (mysqli_num_rows($result)==0)
        {
            echo "<p>The driver has no record in the system.</p>";
            die();
        }
        $row = mysqli_fetch_assoc($result);
        $condition1 = "People_ID={$row['People_ID']}";
    }
    if ($_POST['plate1']!="") {
        $sql = "SELECT * FROM Vehicle WHERE Vehicle_licence='".$_POST['plate1']."'";
        $result = mysqli_query($conn,$sql);
        if (mysqli_num_rows($result)==0)
        {
            echo "<p>The vehicle has no record in the system.</p>";
            die();
        }
        $row = mysqli_fetch_assoc($result);
        $condition2 = "Vehicle_ID={$row['Vehicle_ID']}";
    }
    if ($_POST['date1']!="") {
        $condition3 = "Incident_Date='{$_POST['date1']}'";
    }

    $sql="SELECT * FROM Incident WHERE ".$condition1." AND ".$condition2." AND ".$condition3;
    $result = mysqli_query($conn,$sql);


    if (mysqli_num_rows($result)>0)
    {
        echo "<table>";
        echo "<caption>".mysqli_num_rows($result)." reports found in the system.<br></caption>";
        echo "<thead><th>Incident ID</th><th>Vehicle licence</th>
                    <th>Driver licence</th><th>Date</th><th>Report</th><th>Offence</th></thead>";
        while ($row=mysqli_fetch_assoc($result))
        {
            echo "<tr>";
            echo "<td>".$row['Incident_ID']."</td>";
            $sql="SELECT * FROM Vehicle WHERE Vehicle_ID=".$row['Vehicle_ID'];
            $result1=mysqli_query($conn,$sql);
            $row1=mysqli_fetch_assoc($result1);
            echo "<td>".$row1['Vehicle_licence']."</td>";
            $sql="SELECT * FROM People WHERE People_ID=".$row['People_ID'];
            $result1=mysqli_query($conn,$sql);
            $row1=mysqli_fetch_assoc($result1);
            echo "<td>".$row1['People_licence']."</td>";
            echo "<td>".$row['Incident_Date']."</td>";
            echo "<td>".$row['Incident_Report']."</td>";
            $sql="SELECT * FROM Offence WHERE Offence_ID=".$row['Offence_ID'];
            $result1=mysqli_query($conn,$sql);
            $row1=mysqli_fetch_assoc($result1);
            echo "<td>".$row1['Offence_description']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    else
    {
        echo "<p>No report found in the system.</p>";
    }
}






if ($_POST['licence']=="" or $_POST['plate']=="" or $_POST['report']=="" or $_POST['date']=="" or $_POST['offence']=="")
{
    die();
}

$sql = "SELECT * FROM Incident WHERE Incident_ID = (SELECT max(Incident_ID) FROM Incident)";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$incID = $row['Incident_ID'] + 1; //get the max ID of the Incidents and assign a new ID for the new report.



$sql="SELECT * FROM People WHERE People_licence='".$_POST['licence']."'";
$result1 = mysqli_query($conn,$sql);
$sql="SELECT * FROM Vehicle WHERE Vehicle_licence='".$_POST['plate']."'";
$result2 = mysqli_query($conn,$sql);

    if (mysqli_num_rows($result1)==0 && mysqli_num_rows($result2)==0)
    {
        $sql="SELECT * FROM People WHERE People_ID = (SELECT max(People_ID) FROM People)";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $personID = $row['People_ID'] + 1; //get the max ID of the People and assign a new ID for the new person.
        $sql = "INSERT INTO People (People_ID, People_name, People_address, People_licence)
                    VALUES (".$personID.", '', '', '".$_POST['licence']."')";
        $result = mysqli_query($conn,$sql);

        $sql="SELECT * FROM Vehicle WHERE Vehicle_ID = (SELECT max(Vehicle_ID) FROM Vehicle)";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $vehID = $row['Vehicle_ID'] + 1; //get the max ID of the vehicles and assign a new ID for the new vehicle.
        $sql= "INSERT INTO Vehicle (Vehicle_ID, Vehicle_type, Vehicle_colour, Vehicle_licence) 
                    VALUES (".$vehID.", '', '', '".$_POST['plate']."')";
        $result = mysqli_query($conn,$sql);

        $sql = "INSERT INTO Incident (Incident_ID, Vehicle_ID, People_ID, Incident_Date, Incident_Report, Offence_ID)
            VALUES (".$incID.", ".$vehID.", ".$personID.", '".$_POST['date']."', '".$_POST['report']."',".$_POST['offence'].")";
        $result = mysqli_query($conn,$sql);

        echo "<script> if(confirm( 'The driver and the vehicle is not recorded in the system. ' +
        'Do you want to fill the details now? '))  location.href='newVeh&Per.php'; </script>";
    }
    else if (mysqli_num_rows($result1)==0 && mysqli_num_rows($result2)!=0)
    {
        $sql="SELECT * FROM People WHERE People_ID = (SELECT max(People_ID) FROM People)";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $personID = $row['People_ID'] + 1; //get the max ID of the People and assign a new ID for the new person.
        $sql = "INSERT INTO People (People_ID, People_name, People_address, People_licence)
                    VALUES (".$personID.", '', '', '".$_POST['licence']."')";
        $result = mysqli_query($conn,$sql);

        $row = mysqli_fetch_assoc($result2);
        $vehID = $row['Vehicle_ID'];

        $sql = "INSERT INTO Incident (Incident_ID, Vehicle_ID, People_ID, Incident_Date, Incident_Report, Offence_ID)
            VALUES (".$incID.", ".$vehID.", ".$personID.", '".$_POST['date']."', '".$_POST['report']."',".$_POST['offence'].")";
        $result = mysqli_query($conn,$sql);

        echo "<script> if(confirm( 'The driver is not recorded in the system. ' +
        'Do you want to fill the details now? '))  location.href='newperson.php'; </script>";
    }
    else if (mysqli_num_rows($result1)!=0 && mysqli_num_rows($result2)==0)
    {
        $sql="SELECT * FROM Vehicle WHERE Vehicle_ID = (SELECT max(Vehicle_ID) FROM Vehicle)";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        $vehID = $row['Vehicle_ID'] + 1; //get the max ID of the vehicles and assign a new ID for the new vehicle.
        $sql= "INSERT INTO Vehicle (Vehicle_ID, Vehicle_type, Vehicle_colour, Vehicle_licence) 
                    VALUES (".$vehID.", '', '', '".$_POST['plate']."')";
        $result = mysqli_query($conn,$sql);

        $row = mysqli_fetch_assoc($result1);
        $personID = $row['People_ID'];

        $sql = "INSERT INTO Incident (Incident_ID, Vehicle_ID, People_ID, Incident_Date, Incident_Report, Offence_ID)
            VALUES (".$incID.", ".$vehID.", ".$personID.", '".$_POST['date']."', '".$_POST['report']."',".$_POST['offence'].")";
        $result = mysqli_query($conn,$sql);

        echo "<script> if(confirm( 'The Vehicle is not recorded in the system. ' +
        'Do you want to fill the details now? '))  location.href='newInciVeh.php'; </script>";
    }

    else
    {
        $row = mysqli_fetch_assoc($result1);
        $personID = $row['People_ID'];
        $row = mysqli_fetch_assoc($result2);
        $vehID = $row['Vehicle_ID'];

        $sql = "INSERT INTO Incident (Incident_ID, Vehicle_ID, People_ID, Incident_Date, Incident_Report, Offence_ID)
            VALUES (".$incID.", ".$vehID.", ".$personID.", '".$_POST['date']."', '".$_POST['report']."',".$_POST['offence'].")";
        $result = mysqli_query($conn,$sql);
    }

?>


</body>
</html>
