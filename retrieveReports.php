<?php
//  to retrieve all the reports.
require('connection.php');

    $sql="SELECT * FROM Incident ORDER BY Incident_ID";
    $result=mysqli_query($conn,$sql);

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

?>