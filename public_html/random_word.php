<?php
require "conn.php";
$refresh = $_POST["refresh"];
if($refresh=="refresh"){
$mysql_qry = "SELECT wordtext FROM words ORDER BY rand() LIMIT 1";
$result = mysqli_query($conn,$mysql_qry);
if (!$result)   
{   
  $error = 'Error fetching words: ' . mysqli_error($link);   
  include 'error.html.php';   
  exit();   
}   
while ($row = mysqli_fetch_array($result))    
{    
  $words[] = array('text' => $row['wordtext']);    
}
foreach ($words as $word):
echo htmlspecialchars($word['text'], ENT_QUOTES, 'UTF-8');
endforeach;
}
else{
echo "Wrong Command";
}
?>
