<?php

// connect to the database
include("connectdb.php");

function renderForm($first = '', $last ='', $content=' ', $error = '', $id = '')
{ ?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="ckeditor/ckeditor.js"></script>
<title>
<?php if ($id != '') { echo "Edit Record"; } else { echo "New Record"; } ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
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

<form action="" method="post" id="pos">
<div>
 <label><b>Title</b></label>
 <input type="text" name="title" id="title" value="<?php echo $first; ?>" required>
<br/>
<label><b>Author</b></label>
 <input type="text" name="author" id="author" value="<?php echo $last; ?>" required>
<br/>
    <label><b>Content</b></label>
     <textarea name="editor1" id="editor1" rows="10" cols="80">
             <?php echo $content; ?>
            </textarea>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
<button name="edit" type="submit" id="edit">Update</button>
</div>
</form>
</body>
</html>

<?php }



/*

EDIT RECORD

*/
// if the 'id' variable is set in the URL, we know that we need to edit a record
if (isset($_GET['id']))
{

// make sure the 'id' value is valid
if (is_numeric($_GET['id']) && $_GET['id'] > 0)
{
// get 'id' from URL
$id = $_GET['id'];

// get the recod from the database
if($stmt = $mysqli->prepare("SELECT * FROM pages WHERE id=?"))
{
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->bind_result($id, $firstname, $lastname,$content);
$stmt->fetch();

// show the form
renderForm($firstname, $lastname, $content, $id);

$stmt->close();
}
// show an error if the query has an error
else
{
echo "Error: could not prepare SQL statement";
}
}

}

if(isset($_POST['edit']))
{
    $title = mysqli_real_escape_string($mysqli, $_POST['title']);
    $name = mysqli_real_escape_string($mysqli, $_POST['author']);
    $content = mysqli_real_escape_string($mysqli, $_POST['editor1']); 
    
    if ($stmt = $mysqli->prepare("UPDATE pages SET title ='$title', authname ='$name', content='$content' WHERE id='$id' "))
    {
        $stmt->execute();
        $stmt->close();
        header("Location: admin1.php");
    }
    else
    {
        echo "ERROR: could not prepare SQL statement.";
    }
}


// close the mysqli connection
$mysqli->close();
?>