<?php
require_once('startsession.php');
require_once('navmenu.php');
?>
<!Doctype html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/dtd/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml1" xml:lang="en" lang="en">
<head>
  <title>Posts Edit/Delete</title>
  <meta http-equiv="Content-Type" Content="text/html; Charset=ISO-8859-1" />
  <link rel="stylesheet" type="text/css" href="../style.css" />
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>

<div id="entry_part">
<h2>Posts</h2>
<?php
require_once('../config.php');
//Connect to MySQL
$dbc=mysqli_connect(DB_HOST,USER,PASSWD,DB_NAME);
//run pagination()
$return=pagination();
$max=$return['max'];
$query="SELECT entry_id,title,date_posted,entry FROM entries ORDER BY timestamp DESC $max";
$result=mysqli_query($dbc,$query);
$i=1;
echo '<table><tr><th>Sr.No</th><th>Title</th><th>Date Posted</th><th>Description</th><th>Action</th></tr>';
while($row=mysqli_fetch_array($result)){
echo '<tr>';
echo '<td>'.$i.'</td><td>'.$row['title'].'</td><td>'.$row['date_posted'].'</td><td>'.substr($row['entry'], 0,30).'</td><td><a href="edit.php?id='.$row['entry_id'].'">Edit</a> | <a href="delete.php?id='.$row['entry_id'].'">Delete</a></td>';
echo '</tr>';
$i++;
}

//Pagination function

function  pagination(){
global $dbc;
$return_val=array();
$rpp=10;
//Querying DB to return no of rows
$query_page="SELECT * FROM entries";
$result_page=mysqli_query($dbc,$query_page);
$rows=mysqli_num_rows($result_page);
$total=$rows/$rpp;
$total=ceil($total);
(!isset($_GET['page'])) || ($_GET['page'] < 1) ? $page_no=1 : $page_no=intval($_GET['page']);
if(isset($_POST['page']) && $_POST['page'] > $total){
$page_num=$total;
}
if($page_no > $total){
$page_no=$total;
}
if($page_no == $total){
 $previous=$page_no - 1;
 $return_val['pageline'] = "<a href=\"posts.php?page=$previous\"> $previous </a> $page_no";
 $page=$page_no - 1;
$return_val['max']='LIMIT '. $page * $rpp.','. $rpp;
}
elseif($page_no == 1){
$next=$page_no + 1;
$return_val['pageline'] = "$page_no <a href=\"posts.php?page=$next\">$next</a>";
$page=$page_no - 1;
$return_val['max']='LIMIT '. $page * $rpp.','. $rpp;
}
else{
$next=$page_no + 1;
$previous=$page_no - 1;
$return_val['pageline'] = "<a href=\"posts.php?page=$previous\"> $previous </a> $page_no <a href=\"index.php?page=$next\">$next</a>";
$page=$page_no - 1;
$return_val['max']='LIMIT '. $page * $rpp.','. $rpp;
}
return $return_val;

}
echo $return['pageline'];
?>
</div>
</body>
</html> 