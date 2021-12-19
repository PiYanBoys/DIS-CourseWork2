<?php
//  to retrieve all the fines.
//MySQL database information
$servername = "127.0.0.1"; $username = "root"; $password = ""; $dbname = "test";
$conn = mysqli_connect($servername, $username, $password, $dbname);
//Check connection
if(mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
    die();}

$sql="SELECT * FROM Fines ORDER BY Fine_ID";
$result=mysqli_query($conn,$sql);
echo mysqli_num_rows($result)." records found in the system.<br>";

if (mysqli_num_rows($result)>0)
{
    echo "<table>";
    echo "<tr><th>Fine ID</th><th>Fine Amount</th>
                    <th>Fine Points</th><th>Incident ID</th></tr>";
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