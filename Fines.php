<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fines</title>
    <script src="ajax.js" type="text/javascript"></script>
</head>
<body>
<button onclick=openfile('HomePage.html') id="home">Home</button><br>

<h1>Add Fines</h1>
<form method="POST">
    Incident ID: &nbsp;<input type="text" name="ID"><br>
    Fine Points: <input type="text" name="point"><br>
    Fine Amount: <input type="text" name="amount"><br>
    <input type="submit" value="Submit">
</form>
<hr>
<button type="button" onclick="loadDoc('retrieveReports.php')">See all reports</button>
<div id="myDiv"></div>
<hr>
<button type="button" onclick="loadDoc1('retrieveFines.php')">See all Fines</button>
<div id="myDiv1"></div>

<?php
require('connection.php');


if ($_POST['ID']!="" && $_POST['point']!="" && $_POST['amount']!="")
{
    $sql = "SELECT * FROM Fines WHERE Fine_ID = (SELECT max(Fine_ID) FROM Fines)";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $fineID = $row['Fine_ID'] + 1;
    $sql = "INSERT INTO Fines (Fine_ID, Fine_Amount, Fine_Points, Incident_ID) 
                VALUES (".$fineID.", ".$_POST['amount'].", ".$_POST['point'].",".$_POST['ID'].")";
    $result = mysqli_query($conn,$sql);
    echo "Fine added.";
}
else
{
    echo "Do NOT leave blanks!";
    die();
}


?>
</body>
</html>