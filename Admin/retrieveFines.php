<link rel="stylesheet" href="../style.css">
<?php
//  to retrieve all the fines.
require('../connection.php');

$sql="SELECT * FROM Fines ORDER BY Fine_ID";
$result=mysqli_query($conn,$sql);


if (mysqli_num_rows($result)>0)
{
    echo "<table>";
    echo "<caption>".mysqli_num_rows($result)." records found in the system.<br></caption>";
    echo "<thead><th>Fine ID</th><th>Fine Amount</th>
                    <th>Fine Points</th><th>Incident ID</th></thead>";
    while ($row=mysqli_fetch_assoc($result))
    {
        echo "<tr>";
        echo "<td>".$row['Fine_ID']."</td>";
        echo "<td>".$row['Fine_Amount']."</td>";
        echo "<td>".$row['Fine_Points']."</td>";
        echo "<td>".$row['Incident_ID']."</td>";
        echo "</tr>";

    }
    echo "</table>";
}
else
{
    echo "No report found in the system.";
}

?>