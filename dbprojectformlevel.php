<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
</head>
<body>

<?php
$q = $_GET['q'];

$con = mysqli_connect('us-cdbr-azure-west-c.cloudapp.net','b2a3214e88e413','325ebc40','mysqldbproject');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

mysqli_select_db($con,"mysqldbproject");
$sql="SELECT * FROM '".$q."' ";
$result = mysqli_query($con,$sql);

if ($q = expression){
echo "<table>
<tr>
<th>language_id</th>
<th>expression_name</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['language_id'] . "</td>";
    echo "<td>" . $row['expression'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($con);
}
?>
</body>
</html>
