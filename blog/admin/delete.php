<?php
require_once('startsession.php');
require_once('navmenu.php');
?>
<!Doctype html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/dtd/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml1" xml:lang="en" lang="en">
<head>
  <title>Delete</title>
  <meta http-equiv="Content-Type" Content="text/html; Chaset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="../style.css" />
</head>
<body>
<div id="entry_part">
<h2>Delete</h2>
<?php
//including file
require_once('../config.php');
$dbc=mysqli_connect(DB_HOST,USER,PASSWD,DB_NAME);
if(isset($_GET['id'])){
 $id=intval(htmlentities(mysqli_real_escape_string($dbc,trim($_GET['id']))));
 $query="Select title FROM entries WHERE entry_id='$id'";
 $result=mysqli_query($dbc,$query);
 if(mysqli_num_rows($result)>0){
 $row=mysqli_fetch_array($result);
 echo 'Do you want to delete post titled:<br /><b>'.$row['title'].'</b><br />';
 echo '<form method="post" action="">';
 echo '<input type="hidden" name="id" value="'.$id.'" />';
 echo '<input type="radio" name="delete" value="1" />Confirm <input type="radio" name="delete" value="0" />Cancel<br />';
 echo '<input type="submit" name="submit" value="submit" />';
 echo '</form>';
}
else{
die('Post you are trying to delete don\'t exist.');
}
if(isset($_POST['submit'])){
if($_POST['delete']==1){
$id=intval(htmlentities(mysqli_real_escape_string($dbc,trim($_POST['id']))));
$query="DELETE FROM entries WHERE entry_id='$id'";
mysqli_query($dbc,$query);
echo 'Post has been deleted successfully.';
}
else{
 header('Location:/blog/admin/posts.php');
}
}
}
?>
</div>
</body>
</html>