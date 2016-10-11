<?php   
$host = '';
$u_id = '';
$pwd = '';
$table = 'words';
$db = '';
if (get_magic_quotes_gpc())   

{   

  function stripslashes_deep($value)   

  {   

    $value = is_array($value) ?   

        array_map('stripslashes_deep', $value) :   

        stripslashes($value);   

   

    return $value;   

  }   

   

  $_POST = array_map('stripslashes_deep', $_POST);   

  $_GET = array_map('stripslashes_deep', $_GET);   

  $_COOKIE = array_map('stripslashes_deep', $_COOKIE);   

  $_REQUEST = array_map('stripslashes_deep', $_REQUEST);   

}   

   

if (isset($_GET['addword']))   

{   

  include 'form.html.php';   

  exit();   

}   

   

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

   
if (isset($_GET['deleteword']))    

{    

  $id = mysqli_real_escape_string($link, $_POST['id']);    

  $sql = "DELETE FROM words WHERE id='$id'";    

  if (!mysqli_query($link, $sql))    

  {    

    $error = 'Error deleting word: ' . mysqli_error($link);    

    include 'error.html.php';    

    exit();    

  }    

      

  header('Location: .');    

  exit();    

}
if (isset($_POST['wordtext']))   

{   

  $wordtext = mysqli_real_escape_string($link, $_POST['wordtext']);   

  $sql = 'INSERT INTO words SET   

      wordtext="' . $wordtext . '"';   

  if (!mysqli_query($link, $sql))   

  {   

    $error = 'Error adding submitted word: ' . mysqli_error($link);   

    include 'error.html.php';   

    exit();   

  }   

   

  header('Location: .');   

  exit();   

}   

   

$result = mysqli_query($link, 'SELECT id, wordtext FROM words');   

if (!$result)   

{   

  $error = 'Error fetching words: ' . mysqli_error($link);   

  include 'error.html.php';   

  exit();   

}   

   $var = 0;
if($result->num_rows > 0){
while ($row = mysqli_fetch_array($result))    

{    

  $words[] = array('id' => $row['id'], 'text' => $row['wordtext']);    
	$var++;
} 

include 'words.html.php';
}
else{
include 'nowords.html.php';
}
?>
