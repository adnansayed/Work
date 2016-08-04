
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/Style2.css">
<title>

</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
    <ul class="tab">
   <li><a href="user.php">Home</a></li>
    
</ul>

    
<footer>
  <a id="ft" href="index.php">Login as Admin</a>
</footer> 
        
</body>
</html>

<?php 

include("connectdb.php");


if (isset($_GET['id']))
{

if (is_numeric($_GET['id']) && $_GET['id'] > 0)
{
// get 'id' from URL
$id = $_GET['id'];

// get the recod from the database
if ($result = $mysqli->query("SELECT * FROM pages WHERE id= '$id' "))
{
// display records if there are records to display
if ($result->num_rows > 0)
{
// display records in a table
echo "<table border='1' cellpadding='10' width='100%'>";

// set table headers
echo "<tr><th>ID</th><th>Title</th><th>Author</th><th>Content</th></tr>";

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td>" . $row->id . "</td>";
echo "<td>" . $row->title . "</td>";
echo "<td>" . $row->authname . "</td>";
echo "<td>" . $row->content . "</td>";
echo "</tr>";
}

echo "</table>";
}
// if there are no records in the database, display an alert message
else
{
echo "No results to display!";
}
}
// show an error if there is an issue with the database query
else
{
echo "Error: " . $mysqli->error;
}
}
}


// close the mysqli connection
$mysqli->close();
?>