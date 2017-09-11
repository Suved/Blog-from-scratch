<?php
session_start();
if((isset($_SESSION['user'])) && (isset($_SESSION['id']))){

   header('Location:admin.php?page=home.php');

}
   
?>
<!Doctype html PUBLIC "//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/dtd/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml1" lang="en" xml:lang="en">
<head>
    <title>Login</title>
	<meta http-equiv="Content-Type" Content="text/html; Charset=ISO-8859-1" />
	<style type="text/css">
	#login{
	 text-align:center;
	 background-color:grey;
	 margin-left:40%;
	 margin-right:40%;
	 padding:30px;
	 margin-top:15%;
	 margin-bottom:10%;
	}
	</style>
</head>
<body>
<div id="login">
<form method="post" action="login.php">
Username<input type="text" name="user" placeholder="Username" char="20" /><br />
<br />
password<input type="password" name="passwd" placeholder="password" char="32" /><br />
<br />
<input type="submit" name="submit" value="Login" /><br />
</form>
</form>
<?php
require_once('../config.php');
$dbc=mysqli_connect(DB_HOST,USER,PASSWD,DB_NAME) or die('Error connecting');
if(isset($_POST['submit'])){
    if((!empty($_POST['user'])) && (!empty($_POST['passwd']))){
$user=htmlentities(mysqli_real_escape_string($dbc,trim($_POST['user'])));
$pass=htmlentities(mysqli_real_escape_string($dbc,trim($_POST['passwd'])));
$query="SELECT * FROM admin WHERE user='$user' and passwd='$pass'";
$data=mysqli_query($dbc,$query);
if(mysqli_num_rows($data)==1){
      $row=mysqli_fetch_array($data);
	  session_start();
      $_SESSION['user']	= $row['user'];
	  $_SESSION['id'] = $row['id'];
	  $home_url='http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/home.php';
	  header('Location:'.$home_url);
        
      }
	  else{
	  echo '<p class="error">Wrong username or password.</p>';
	  }
  }
  else  {
    echo '<p class="error">Please don\'t leave any field blank.</p>';
     }
}



?>