<!Doctype html PULIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/dtd/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml1" xml:lang="en" lang="en">
<head>
  <title>Suved Weblog</title>
  <meta http-equiv="Content-Type" Content="text/html; Charset=SIO-8859-1" />
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<br />
<br />
<h2> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Suved's Weblog</h2>
<div id="entry_part">
<?php
//Include required files
require_once('config.php');
//Connect to MySQL
$dbc=mysqli_connect(DB_HOST,USER,PASSWD,DB_NAME);

$return=pagination ();
$max=$return['max'];
//Querying to DB
$query="SELECT entry_id,date_posted,title,entry FROM entries ORDER BY timestamp DESC $max";
$result=mysqli_query($dbc,$query);
if(mysqli_num_rows($result) !=0){
while($entry=mysqli_fetch_array($result)){
  echo '<h4><a href="view.php?post='.$entry['entry_id'].'">'.$entry['title'].'</a></h4>';
  echo $entry['date_posted'].'<br />';
  echo substr($entry['entry'],0,20).'...';

}
}
else{
    echo 'There are No post Available at this time.Please check after sometime.<br />Thank you!!<br />Have a nice day :)';
   }
 //Pagination function

function  pagination(){
global $dbc;
$return_val=array();
$rpp=5;
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
 $return_val['pageline'] = "<a href=\"index.php?page=$previous\" class=\"pageline\"> $previous </a> $page_no";
 $page=$page_no - 1;
$return_val['max']='LIMIT '. $page * $rpp.','. $rpp;
}
elseif($page_no == 1){
$next=$page_no + 1;
$return_val['pageline'] = "$page_no <a href=\"index.php?page=$next\" class=\"pageline\">$next</a>";
$page=$page_no - 1;
$return_val['max']='LIMIT '. $page * $rpp.','. $rpp;
}
else{
$next=$page_no + 1;
$previous=$page_no - 1;
$return_val['pageline'] = "<a href=\"index.php?page=$previous\" class=\"pageline\"> $previous </a> $page_no <a href=\"index.php?page=$next\" class=\"pageline\">$next</a>";
$page=$page_no - 1;
$return_val['max']='LIMIT '. $page * $rpp.','. $rpp;
}
return $return_val;

}
echo '<br />'.$return['pageline'];

mysqli_close($dbc);
?>
</div>
</body>
</html>