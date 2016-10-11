<?php   

$host = '';
$u_id = '';
$pwd = '';
$link = mysqli_connect($host, $u_id, $pwd);   
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
if (!mysqli_select_db($link, 'a8289963_manj'))   
{   
  $error = 'Unable to locate the word database.';   
  include 'error.html.php';   
  exit();   
}   
echo "Succes!!"
?>
