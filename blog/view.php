<?php
require_once('config.php');
$dbc=mysqli_connect(DB_HOST,USER,PASSWD,DB_NAME);
if(isset($_GET['post'])){
$id=intval(htmlentities(mysqli_real_escape_string($dbc,trim($_GET['post']))));
$query="SELECT entry_id,date_posted,title,entry FROM entries WHERE entry_id='$id'";
$result=mysqli_query($dbc,$query) or die('Error Querying DB');
if(mysqli_num_rows($result)>0){;
$row=mysqli_fetch_array($result);


?>
<!Doctype html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/dtd/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml1" xml:lang="en" lang="en">
<head>
  <title><?php echo $row['title']; ?></title>
  <meta http-equiv="Content-Type" Content="text/html; Charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<h1>Suved's Weblog</h1>
<div id="entry_part">
<?php 
echo '<h2>'.$row['title'].'</h2>';
echo '<p class="date">Posted On: '.$row['date_posted'].'</p>';
echo '<p>'.$row['entry'].'</p>';
  }
  else{
  echo '<p class="error">The post you are trying to view don\'t exist</p>';
  exit;
  }
}
?>
<hr />
<form action="" method="post">
<table>
<tr>
<td>Name:</td><td><input type="text" name="name" /></td>
</tr>
<tr>
<td>Email:</td><td><input type="email" name="email" /></td>
</tr>
<tr>
<td>Message:</td><td><textarea name="msg"></textarea></td>
</tr>
</table>
<input type="submit" name="submit" value="submit" />
</form>
<?php
if(isset($_POST['submit'])){
$name=htmlentities(mysqli_real_escape_string($dbc, trim($_POST['name'])));
$email=htmlentities(mysqli_real_escape_string($dbc, trim($_POST['email'])));
$msg=htmlentities(mysqli_real_escape_string($dbc, trim($_POST['msg'])));

$comment="INSERT INTO comments(name,email,msg,cmnt_date,entry_id,timestamp)".
         "VALUE('$name','$email','$msg',CURDATE(),'$id',NOW())";
$insert_cmnt=mysqli_query($dbc,$comment);
echo 'Comment Added.';
}
//------------------------------------COMMENT-PART------------------------------------
$comment2="SELECT * FROM comments WHERE entry_id='$id' ORDER BY timestamp DESC";
$select_cmnt=mysqli_query($dbc, $comment2);
while($row=mysqli_fetch_array($select_cmnt)){
echo '<p class="comment_name">'.$row['name'].'('.$row['email'].') said on '.$row['cmnt_date'].':</p>';
echo '<p class="comment_msg">'.$row['msg'].'</p>';
}
?>
</div>
</body>
</html>