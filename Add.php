<?php

   $servername = "localhost";
   $username = "root";

// Create connection
   $conn = mysqli_connect($servername, $username);

if(isset($_POST['add']))
{   
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
else
{
    mysqli_select_db($conn,"task");
    
     $sql = "CREATE TABLE IF NOT EXISTS Pages (
     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
     title VARCHAR(150) NOT NULL,
     authname VARCHAR(100) NOT NULL,
     content VARCHAR(50000) NOT NULL
     )";
    $status=mysqli_query($conn,$sql);
    if(! $status)
    {
        die("Could not create table: " . mysqli_connect_error());
    }
    else
    {
        $title = mysqli_real_escape_string($conn, $_POST['pg']);
        $name = mysqli_real_escape_string($conn, $_POST['nm']);
        $content = mysqli_real_escape_string($conn, $_POST['editor1']);
        
        $sql1="INSERT INTO Pages (title, authname, content) VALUES ('$title', '$name', '$content')";
        $f=mysqli_query($conn,$sql1);
        if(! $f)
        {
            die("Data was not entered: " . mysqli_connect_error());
        }
        else
        {
            echo "entered successfully";
        }
        
    }
}
}
?>


<html>
     <head>
         <link rel="stylesheet" type="text/css" href="css/style.css">
         <script src="ckeditor/ckeditor.js"></script>
        </head>
          <body>
     <nav id="nav1">
  <a class="link1" href="admin1.php">Home</a>
  <a class="link1" href="Add.php">Add</a>
  <a class="link1" href="Register.php">Register</a>
  <a class="link1" href="Contact.php">Contact</a>
  <a class="link1" href="index.php">Logout</a>
  </nav> 
    <br/><br/>
    <form id="pos" method="post" action="<?php $_PHP_SELF ?>">
                <label><b>Page Title</b></label>
                <input type="text" placeholder="Enter Title" name="pg" id="pg" required>
                 <label><b>Author Name</b></label>
                <input type="text" placeholder="Enter Name" name="nm" id="nm" required>
            <textarea name="editor1" id="editor1" rows="10" cols="80">
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
                <button name="add" type="submit" id="add">ADD</button>
        </form>
        </body>
    </html>