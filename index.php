<?php
include('connectdb.php');

if(isset($_POST['sigin']))
{
  
     $username = mysqli_real_escape_string($mysqli, $_POST['uname']);
     $password = mysqli_real_escape_string($mysqli, $_POST['psw']);
    
     $sql = "SELECT username FROM users WHERE username = '$username' and password = '$password'";
     $status=$mysqli->query($sql);
     $count = mysqli_num_rows($status);
    if($count==1)
    {
        header('Location: admin1.php');
        
    }
    else
    {
        die("Check username and password: " . $mysqli->connect_error());
    }

}
?>

<html>
     <head>
         <link rel="stylesheet" type="text/css" href="css/style.css">
        </head>
          <body>
                   <nav id="nav1">
                       <a class="link1" href="index.php">Admin</a>
                        <a class="link1" href="user.php">User</a>
                </nav> 
              
              
             <form id="ddd" method="post" action="<?php $_PHP_SELF ?>">
                 <div class="container">
                     <label><b>Username</b></label>
                     <input type="text" placeholder="Enter Username" name="uname" required>
                     <label><b>Password</b></label>
                     <input type="password" placeholder="Enter Password" name="psw" required>
                     <button  name="sigin" type="submit" id="sigin">Login</button>
                     </div>
</form>
        </body>
    </html>