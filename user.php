<?php
$search_term='';
$search_results='';
//Check if search data was submitted
if ( isset( $_GET['s'] ) ) {

  // Include the search class
  require_once( dirname( __FILE__ ) . '/class-search.php' );
  
  // Instantiate a new instance of the search class
  $search = new search();
  
  // Store search term into a variable
  $search_term = htmlspecialchars($_GET['s'], ENT_QUOTES);
  
  // Send the search term to our search class and store the result
  $search_results = $search->search($search_term);

}
?>

<html>
<head>
   <link rel="stylesheet" type="text/css" href="css/Style2.css">
         <script src="js/my.js"></script>
     <script src="js/vali.js"></script>
    </head>
    <body>
        <ul class="tab">
                <li><a href="#" class="tablinks" onclick="openCity(event, 'Home')">Home</a></li>
                <li><a href="#" class="tablinks" onclick="openCity(event, 'Contact')">Contact</a></li>
         
           <div class="search-form">
               <form  action="" method="get">
                   <div class="form-field">
                       <input type="search" name="s" id="abc" placeholder="Enter your search term..." results="5" value="<?php echo $search_term; ?>">
                       <button type="submit" value="Search" name="search" id="search">Search</button>
        </div>
      </form>
    </div>
            </ul>
        
        
<?php if ( $search_results ) : ?>
        <div class="results-table">
            <?php foreach ( $search_results['results'] as $search_result ) : ?>
            <div class="result">
                <a id="re" href="View.php?id=<?php echo $search_result->id?>"><?php echo $search_result->title?></a>
          <br/>
      </div>
      <?php endforeach; ?>
    </div>
<?php endif; ?>
        
        
        
<div id="Home" class="tabcontent">

    <?php
// connect to the database
include('connectdb.php');

// get the records from the database
if ($result = $mysqli->query("SELECT * FROM pages ORDER BY id"))
{
// display records if there are records to display
if ($result->num_rows > 0)
{
// display records in a table
echo "<table border='1' cellpadding='10' width='100%'>";

// set table headers
echo "<tr><th>ID</th><th>Title</th><th>Author</th><th></th></tr>";

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td>" . $row->id . "</td>";
echo "<td>" . $row->title . "</td>";
echo "<td>"  . $row->authname ."</td>";
echo "<td><a href='View.php?id=" . $row->id . "'>View</a></td>";
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
            
</div>
        
        <div id="Contact" class="tabcontent">
            <form id="pos" method="post" action="<?php $_PHP_SELF ?>">
                <div class="container">
                
                <label><b>Name</b></label>
                <input type="text" placeholder="Enter Name" name="uname" id="uname" maxlength="50" onKeyUp="updatelength('uname', 'login_length')" required>
                <div id="login_length"></div>
                
                <label><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="em" id="em" maxlength="50" onKeyUp="updatelength('em', 'email_length'); checkmail('em')" required>
                <div id="email_length"></div>
                
                 <label><b>Subject</b></label>
                <input type="text" placeholder="Enter Subject" name="sub" maxlength="25" id="sub" required>
                
                <label><b>Comment</b></label>
               <textarea name="comment" rows="5" cols="40" maxlength="500" placeholder="Enter Comments"></textarea>
                </div>
                        <button name="conc" type="submit" id="conc" onclick="validateall('results')">Submit</button>
                        <div id="results"></div>
            </form>
        
        </div>
        

         <footer>
  <a id="ft" href="index.php">Admin</a>
</footer> 
        
    </body>
</html>

<?php
    include('connectdb.php');
if(isset($_POST['conc']))
{

     $sql = "CREATE TABLE IF NOT EXISTS Contact (
     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     name VARCHAR(150) NOT NULL,
     subject VARCHAR(100) NOT NULL,
     email VARCHAR(100) NOT NULL,
     message VARCHAR(500) NOT NULL
     )";
    $status=$mysqli->query($sql);
    if(! $status)
    {
        die("Could not create table: " . $mysqli->connect_error());
    }
    else
    {
        $username = mysqli_real_escape_string($mysqli, $_POST['uname']);
        $subject = mysqli_real_escape_string($mysqli, $_POST['sub']);
        $email = mysqli_real_escape_string($mysqli, $_POST['em']);
        $message = mysqli_real_escape_string($mysqli, $_POST['comment']);
        
        $sql1="INSERT INTO Contact (name, subject, email, message) VALUES ('$username', '$subject', '$email', '$message')";
        
        $f=$mysqli->query($sql1);
        if(! $f)
        {
            die("Data was not entered: " . $mysqli->connect_error());
        }
        else
        {
            header('Location:user.php');
        }
    }


}

?>
    
    
    
  