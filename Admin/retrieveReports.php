<?php
//  to retrieve all the reports.
//MySQL database information
$servername = "127.0.0.1"; $username = "root"; $password = ""; $dbname = "test";
$conn = mysqli_connect($servername, $username, $password, $dbname);
//Check connection
if(mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
    die();}

    $sql="SELECT * FROM Incident ORDER BY Incident_ID";
    $result=mysqli_query($conn,$sql);
    echo mysqli_num_rows($result)." reports found in the system.<br>";

    if (mysqli_num_rows($result)>0)
    {
        echo "<table>";
        echo "<tr><th>Incident ID</th><th>Vehicle licence</th>
                    <th>Driver licence</th><th>Date</th><th>Report</th><th>Offence</th></tr>";
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
        echo "No report found in the system.";
    }

?>