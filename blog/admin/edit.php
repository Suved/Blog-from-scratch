<?php
require_once('startsession.php');
require_once('navmenu.php');
?>
<!Doctype html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/dtd/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml1" xml:lang="en" lang="en">
<head>
  <title>Edit Post</title>
  <meta http-equiv="Content-Type" Content="text/html; Charset=ISO-8859-1" />
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="../style.css" />
  
</head>
<body>
<div id="entry_part">
<h2>Edit</h2>
<?php
require_once('../config.php');
//Connect to MySQL
$dbc=mysqli_connect(DB_HOST,USER,PASSWD,DB_NAME);
if(isset($_GET['id'])){
$id=intval(htmlentities(mysqli_real_escape_string($dbc,trim($_GET['id']))));


$query="SELECT entry_id,title,date_posted,entry FROM entries WHERE entry_id='$id'";
$result=mysqli_query($dbc,$query);
if(mysqli_num_rows($result)){
$row=mysqli_fetch_array($result);
echo '<form action="edit.php" method="post">';
echo '<table><tr><td><label for="title">Title</label></td><td><input type="text" name="title" value="'.$row['title'].'" /></td></tr><tr><td>Thread:</td><td>'.
'<textarea name="entry" rows="18" cols="40" >'.$row['entry'].'</textarea></td></tr><tr><td>'.
'<input type="submit" name="submit" value="Update" /></td></tr>'.
'<input type="hidden" name="id" value="'.$row['entry_id'].'">'.
'</form>';
}
else{
echo 'This Post don\'t exist.';
}
}
else{
 header('Refresh:/blog/admin/posts.php');
}

if(isset($_POST['submit'])){
 if((!empty($_POST['title'])) && (!empty($_POST['entry']))){
    $id=intval(htmlentities(mysqli_real_escape_string($dbc,trim($_POST['id']))));
	$title=htmlentities(mysqli_real_escape_string($dbc,trim($_POST['title'])));
	$entry=htmlentities(mysqli_real_escape_string($dbc,trim($_POST['entry'])));
	$query="UPDATE entries SET title='$title', entry='$entry' WHERE entry_id='$id'";
	$result=mysqli_query($dbc,$query);
	echo 'Post has been Updated successfully.';
  }
  else{
  echo '<p class="error">Please don\'t leave any field blank.</p>';
  }
}
?>
</div>
</body>
</html> 