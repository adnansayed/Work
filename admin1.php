<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
     <nav id="nav1">
  <a class="link1" href="admin1.php">Home</a>
  <a class="link1" href="Add.php">Add</a>
  <a class="link1" href="Register.php">Register</a>
  <a class="link1" href="Contact.php">Contact</a>
<a class="link1" href="index.php">Logout</a>
  
</nav> 
    </body>
</html>



<?php
// connect to the database
include('connectdb.php');

if ($result = $mysqli->query("SELECT * FROM pages ORDER BY id"))
{
if ($result->num_rows != 0)
{
$total_results = $result->num_rows;
$start=0;
echo "</p>";
echo "<br/><br/><br/>";
// display data in table
echo "<table border='1' cellpadding='10' width='100%'>";
echo "<tr> <th>ID</th> <th>Title</th> <th>Author</th> <th></th> <th></th></tr>";

// loop through results of database query, displaying them in the table
for ($i = $start; $i <= $total_results; $i++)
{
// make sure that PHP doesn't try to show results that don't exist
if ($i == $total_results) { break; }

// find specific row
$result->data_seek($i);
$row = $result->fetch_row();

// echo out the contents of each row into a table
echo "<tr>";
echo '<td>' . $row[0] . '</td>';
echo '<td>' . $row[1] . '</td>';
echo '<td>' . $row[2] . '</td>';
echo '<td><a href="Edit.php?id=' . $row[0] . '">Edit</a></td>';
echo '<td><a href="Delete.php?id=' . $row[0] . '">Delete</a></td>';
echo "</tr>";
}

// close table>
echo "</table>";
}
else
{
echo "No results to display!";
}
}
// error with the query
else
{
echo "Error: " . $mysqli->error;
}

// close database connection
$mysqli->close();

?>