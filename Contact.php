
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

// get the records from the database
if ($result = $mysqli->query("SELECT * FROM contact ORDER BY id"))
{
// display records if there are records to display
if ($result->num_rows > 0)
{
// display records in a table
echo "<table border='1' cellpadding='10' width='100%'>";

// set table headers
echo "<tr><th>ID</th><th>Name</th><th>Subject</th><th>Email</th><th>Message</th></tr>";

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td>" . $row->id . "</td>";
echo "<td>" . $row->name . "</td>";
echo "<td>"  . $row->subject ."</td>";
echo "<td>"  . $row->email ."</td>";
echo "<td>"  . $row->message ."</td>";
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

// close database connection
$mysqli->close();

?>