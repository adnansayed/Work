<?php
include('connectdb.php');

if(isset($_POST['reg']))
{

     $sql = "CREATE TABLE IF NOT EXISTS Users (
     username VARCHAR(150) PRIMARY KEY,
     name VARCHAR(150) NOT NULL,
     email VARCHAR(100) NOT NULL,
     password VARCHAR(150) NOT NULL
     )";
    $status= $mysqli->query($sql);
    if(! $status)
    {
        die("Could not create table: " . mysqli_connect_error());
    }
    else
    {
        $username = mysqli_real_escape_string($mysqli, $_POST['uname']);
        $name = mysqli_real_escape_string($mysqli, $_POST['nm']);
        $email = mysqli_real_escape_string($mysqli, $_POST['em']);
        $password = mysqli_real_escape_string($mysqli, $_POST['psw']);
        
        $check="SELECT * FROM users WHERE username='$username'";
        $c= $mysqli->query($check);
        $c1 = mysqli_num_rows($c);
        if($c1==1)
        {
            echo '<script language="javascript">';
            echo 'alert("user already exist")';
            echo '</script>';
        }
        else
        {
            if((!filter_var($email, FILTER_VALIDATE_EMAIL))||(!preg_match("/^[a-zA-Z ]*$/",$username)))
            {
                echo '<script language="javascript">';
                echo 'alert("enter valid name or email address")';
                echo '</script>';
            }
            else
            {
               $sql1="INSERT INTO Users (username, name, email, password) VALUES ('$username', '$name', '$email', '$password')";
                $f= $mysqli->query($sql1);
                if(! $f)
                {
                    die("Data was not entered: " . mysqli_connect_error());
                        }
                        else
                        {
                            header('Location:LogIN.php');
                        }
                    }   
            }
      
    }


}

?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/vali.js"></script>
    </head>
    <body>
        
        <nav id="nav1">
  <a class="link1" href="admin1.php">Home</a>
  <a class="link1" href="Add.php">Add</a>
  <a class="link1" href="Register.php">Register</a>
  <a class="link1" href="Contact.php">Contact</a>
<a class="link1" href="index.php">Logout</a>
  
</nav> 
        
        
        <form id="pos" method="post" action="<?php $_PHP_SELF ?>">
            <div class="container">
                <label><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="uname" maxlength="25" id="uname" onKeyUp="updatelength('uname', 'login_length')" required>
                <div id="login_length"></div>
                
                <label><b>Name</b></label>
                <input type="text" placeholder="Enter Name" name="nm" id="nm" maxlength="25" onKeyUp="updatelength('nm', 'name_length')"  required>
                <div id="name_length"></div>
                
                <label><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="em" id="em" maxlength="50" onKeyUp="updatelength('em', 'email_length'); checkmail('em')" required>
                <div id="email_length"></div>
                
                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="psw" maxlength="25" id="psw" onKeyUp="updatelength('psw', 'password_length'); checkpass('psw','password_strength')" required>
                <div id="password_length"></div>
                <div id="password_strength"></div>
                
                <button name="reg" type="submit" id="reg" onclick="validateall('results')">Register</button>
                     </div>
            <div id="results">
        </div>
</form>
        
    </body>
</html>