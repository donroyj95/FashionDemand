<?php
include("connectdb.php");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($link,"SELECT * FROM shops");

echo "<table border='1'>
<tr>
<th>shopName</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<a href='login.php'>".$row['shopName'] ."</a><br>";
echo "</tr>";
}
echo "</table>";

mysqli_close($link);
?>