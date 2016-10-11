<?php
$host = '';
$u_id = '';
$pwd = '';
$table = '';
$db = '';
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
if (!mysqli_select_db($link, $db))   
{   
  $error = 'Unable to locate the word database.';   
  include 'error.html.php';   
  exit();   
}
echo "Grabbing website...";
 $data = file_get_contents('http://www.astrologycom.com/virgodaily.php');
 //$regex = '/Fri Jun 1:\s[^z]*/';
 $regex = '/(^|\s+)[a-z]([a-z]+)/';
 preg_match_all($regex,$data,$match);
 var_dump($match);
 foreach ($match[0] as $word_scraped):
 $result = mysqli_query($link, "SELECT wordtext FROM words WHERE wordtext = '". $word_scraped. "'"); 
 if($result->num_rows == 0){
 $result1 = mysqli_query($link, 'INSERT INTO words SET wordtext="' . $word_scraped . '"');
 echo $word_scraped;
 //echo $result->num_rows;
 //echo $result->num_columns;
 }
 else{
 //echo "not inserted";
 }
echo $result->num_rows;

 endforeach;
 //echo $data;
 ?>
