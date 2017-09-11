<?php
require_once('startsession.php');
require_once('navmenu.php');
?>
<!Doctype html PULIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/dtd/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml1" xml:lang="en" lang="en">
<head>
  <title>Suved Weblog</title>
  <meta http-equiv="Content-Type" Content="text/html; Charset=SIO-8859-1" />
  <link rel="stylesheet" type="text/css" href="../style.css" />
  <link rel="stylesheet" type="text/css" href="style.css" />
 
 
  </head>
<body>
<div id="entry_part">
<h2>Add New Post</h2>
<br />
<form method="post" action="add_entry.php">
<table>
<tr>
<td><label for="title">Title</label></td><td><input type="text" name="title" /></td>
</tr><tr>
<td>Thread:</td><td>
<textarea name="entry" rows="18" cols="40" ></textarea></td></tr><tr><td>
<input type="submit" name="post" value="Post" /></td></tr>
</form>
<?php
//include required files
require_once('../config.php');
//Connect to MySQL
$dbc=mysqli_connect(DB_HOST,USER,PASSWD,DB_NAME);
if(isset($_POST['post'])){
if((!empty($_POST['title'])) && (!empty($_POST['entry']))){
  $title=htmlentities(mysqli_real_escape_string($dbc,trim($_POST['title'])));
  $entry=htmlentities(mysqli_real_escape_string($dbc,trim($_POST['entry'])));
  $date=DATE("Y-m-d");
  $time=time();
  echo $date;
  //querying DB
  $query="INSERT INTO entries(title,entry,date_posted,timestamp)".
         "VALUES('$title','$entry','$date','$time')";
  $result=mysqli_query($dbc,$query);
  echo 'Entry added successfully';
  }
  else{
    echo '<p class="error">Please do not leave any field blank.</p>';
  }
}

?>
</div>
</body>
</html>