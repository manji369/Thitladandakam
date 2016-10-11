<?php   
session_start();
$host = '';
$u_id = '';
$pwd = '';
$table = 'words';
$db = '';
$_SESSION['loggedin'] = False;
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

if($_SESSION["loggedin"]){
echo "logged in";
$mysql_qry = 'SELECT wordtext,id FROM words WHERE id NOT IN (SELECT word_id FROM '.$_SESSION["fbid"].') ORDER BY rand() LIMIT 1';
$result = mysqli_query($link, $mysql_qry); 
}
else{
$result = mysqli_query($link, 'SELECT wordtext FROM words ORDER BY rand() LIMIT 1');   
}  
if (!$result)   

{   

  $error = 'Error fetching words: ' . mysqli_error($link);   

  include 'error.html.php';   

  exit();   

}   
else if(mysqli_num_rows($result)==0){
$row[0] = 'SORRY OUT OF WORDS';
}
else{
$row = mysqli_fetch_array($result);
}
include 'randomword.html.php';
$mysql_qry = 'SELECT id FROM words WHERE wordtext = "'.$row[0].'"';
$result = mysqli_query($link, $mysql_qry);
//echo $mysql_qry;

if($result){
while($row = mysqli_fetch_assoc($result)) {
   $wordid = $row['id'];
   //echo $wordid;
   var_dump($_SESSION);
}
if($_SESSION["loggedin"]){
$mysql_qry = 'INSERT INTO '.$_SESSION["fbid"].' VALUES (DEFAULT,"' . $wordid . '")';
echo $mysql_qry;
$result = mysqli_query($link, $mysql_qry);
if(!$result){
	echo "Error in insertion";
	echo $_SESSION["fbid"];
	echo $link->error;
}
}
}
?>
<body>
	<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '301011483584123',
      xfbml      : true,
      version    : 'v2.7'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
</body>



<!DOCTYPE html>
<html>
<body>
<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.

      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  function loggedout() {
  	xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST","fb_loggedout.php",true);
    xmlhttp.send();
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '301011483584123',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me?fields=name,email,id', function(response) {
      console.log('Successful login for: ' + response.name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
        xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST","script.php?name="+response.name+"&fbid="+response.id+"&email="+response.email,true);
    xmlhttp.send();
    });
  }
</script>

<!--
  Below we include the Login Button social plugin. This button uses
  the JavaScript SDK to present a graphical Login button that triggers
  the FB.login() function when clicked.
-->

<fb:login-button scope="public_profile,email" auto_logout_link="true" onlogin="checkLoginState();">
</fb:login-button>
<fb:logout-button onlogout="loggedout();"
<div id="status">
</div>

</body>
</html>
