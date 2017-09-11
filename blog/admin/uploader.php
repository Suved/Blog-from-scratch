<?php
require_once('startsession.php');
require_once('navmenu.php');
?>
<!Doctype html PUBLIC "-//W3C/DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/dtd/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml1" xml:lang="en" lang="en">
<head>
<title>Media Upload</title>
<meta http-equiv="Content-Type" Content="text/html; Charset=ISO-8859-1">
<link rel="stylesheet" type="text/css" href="../style.css" />
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div id="entry_part">
<h2>Media Upload</h2>
<a href="uploader.php">Browse Media</a>  <a href="uploader.php?action=upload">Upload New Media</a>
<?php
//incluiding file
require_once('../config.php');
$dbc=mysqli_connect(DB_HOST,USER,PASSWD,DB_NAME);

//--------------------------------------START-OF-UPLOAD-CODE----------------------------
if(isset($_GET['action']) && strtolower($_GET['action'])=='upload'){
echo'<form method="post" action="" enctype="multipart/form-data">';
echo '<input type="file" name="file" placeholder="Upload Files!!" />';
echo '<input type="submit" name="submit" value="upload" />';
echo '</form>';
if(isset($_POST['submit'])){
if($_FILES['file']['type']=="image/jpeg" || $_FILES['file']['type']=="image/gif" || $_FILES['file']['type']=="image/png"){
$imginfo=getimagesize($_FILES['file']['tmp_name']);
if($imginfo['mime'] != 'image/gif' && $imginfo['mime'] != 'image/jpeg' && $imginfo['mime'] != 'image/png'){
echo 'File extension *.jpeg, *.gif, *.png are only allowed to be uploaded.';
exit;
}
$destn='../uploads/';
$file_name=htmlentities(mysqli_real_escape_string($dbc,trim($_FILES['file']['name'])));
$file_type=htmlentities(mysqli_real_escape_string($dbc,trim($_FILES['file']['type'])));
$file_size=intval(htmlentities(mysqli_real_escape_string($dbc,trim($_FILES['file']['size']))));
echo 'Name: '.$file_name.'<br />';
if(move_uploaded_file($_FILES['file']['tmp_name'], $destn.$file_name)){
echo 'http://'.$_SERVER['HTTP_HOST'].'/blog/uploads/'.$file_name;
    $query="INSERT INTO uploads(name, size, type)".
	       "VALUES('$file_name','$file_size','$file_type')";
    if(mysqli_query($dbc,$query)){
	 echo '<br />Uploaded successfully.';
	}
	else{
	@unlink("$destn.$file_name");
	 echo 'Failed to upload media.';
	}
   }
 }

else{
   echo 'File extension *.jpeg, *.gif, *.png are only allowed to be uploaded.';
   exit;
      }
   }
   
}
 //--------------------------------------END-OF-UPLOAD-CODE----------------------------
 
 //--------------------------------------START-OF-DELETE-CODE--------------------------
 elseif((isset($_GET['action'])) && (isset($_GET['id'])) && (strtolower($_GET['action'])=='delete')){
    $id=intval(htmlentities(mysqli_real_escape_string($dbc,trim($_GET['id']))));
	echo '<form method="post" action="">';
	echo 'Do you want to proceed?<br />';
	echo '<input type="radio" name="delete" value="1" />Delete<input type="radio" name="delete" value="0" />Return<br />';
	echo '<input type="hidden" name="id" value="'.$id.'"><input type="submit" name="submit" value="Submit"><br />';
	if(isset($_POST['submit'])){
    if($_POST['delete']==1)	{
	    $id=intval(htmlentities(mysqli_real_escape_string($dbc,trim($_POST['id']))));
	    $query="DELETE FROM uploads WHERE id='$id'";
		mysqli_query($dbc,$query);
		echo 'Media has been deleted.';
		}
		else{
		
		header('Location:uploader.php');
		
		}
	
    }
 }
 //--------------------------------------END-OF-DELETE-CODE--------------------------
else{
 $query="SELECT * FROM uploads";
 $result=mysqli_query($dbc,$query);
 if(mysqli_num_rows($result) > 0){
 $i=1;
 
 echo '<table><th>Sr.No</th><th>Name</th><th>Size</th><th>Type</th><th>Delete</th></tr>';
 while($row=mysqli_fetch_array($result)){
     
	 echo '<tr><td>'.$i.'</td><td><a href="/blog/uploads/'.$row['name'].'">'.$row['name'].'</a></td><td>'.$row['size'].'</td><td>'.$row['type'].'</td><td><a href="uploader.php?action=delete&#038;id='.$row['id'].'">Delete</a></td></tr>';
     $i++;
    }
	echo '</table>';
	}
	else{
	echo 'Currently there are no media uploaded.';
	
	}
}
?>