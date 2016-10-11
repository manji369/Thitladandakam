<?php
session_start();
require "conn.php";
$name = $_GET["name"];
$email = $_GET["email"];
$fbid = $_GET["fbid"]; 
$mysql_qry = 'SELECT MAX(id) FROM user_data';
$result = mysqli_query($conn,$mysql_qry);
while($row = mysqli_fetch_assoc($result)) {
   $id = $row['MAX(id)'];
}
$id = (int)$id + 1;
echo $fbid;
$mysql_qry = 'SELECT id FROM user_data1 WHERE fbid = "' . $fbid . '"';
$result = mysqli_query($conn,$mysql_qry);
if(mysqli_num_rows($result)==0 && $fbid){
$mysql_qry = 'INSERT INTO user_data1 
VALUES ("' . $id . '","' . $name . '","","","' . $email . '","' . $fbid . '")';
$result = mysqli_query($conn,$mysql_qry);
echo $result;
$mysql_qry = 'SELECT fbid FROM user_data1 WHERE email = '.$email;
$result = mysqli_query($conn,$mysql_qry);
while($row = mysqli_fetch_assoc($result)) {
   $fbid1 = $row['fbid'];
}
$fbid_mod = 'w'.strval($fbid1);
$_SESSION["fbid"] = $fbid_mod;
$_SESSION["integ"] = 25;
$_SESSION["loggedin"] = True;
$mysql_qry = 'CREATE TABLE '.$fbid_mod.' (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
word_id INT
) DEFAULT CHARACTER SET utf8;';
$result1 = mysqli_query($conn,$mysql_qry);
$_SESSION["fbid"] = $fbid_mod;
$_SESSION["loggedin"] = True;
}else{
	$mysql_qry = 'SELECT fbid FROM user_data1 WHERE id = 3';
	$result = mysqli_query($conn,$mysql_qry);
	while($row = mysqli_fetch_assoc($result)) {
   $fbid1 = $row['fbid'];
}
$fbid_mod = 'w'.strval($fbid1);
echo $fbid_mod;
$_SESSION["fbid"] = $fbid_mod;
$_SESSION["integ"] = 25;
$_SESSION["loggedin"] = True;
}
?>