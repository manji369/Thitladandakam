<?php   

$host = '';
$u_id = '';
$pwd = '';
$db = '';
$link = mysqli_connect($host, $u_id, $pwd,$db);   
if (!$link)   
{   
  $error = 'Unable to connect to the database server.';   
  include 'error.html.php';   
  exit();   
}   
if (!mysqli_set_charset($link, 'utf8'))   
{   
  $output = 'Unable to set database connection encoding.';   
  include 'output.html.php';   
  exit();   
}   
if (!mysqli_select_db($link, $db))   
{   
  $error = 'Unable to locate the word database.';   
  include 'error.html.php';   
  exit();   
}   
echo "Succes!!"
?>
