<?php
require "conn.php";
$mysql_qry = 'SELECT fbid FROM user_data1 WHERE id = 3';
$result = mysqli_query($conn,$mysql_qry);
while($row = mysqli_fetch_assoc($result)) {
   $fbid = $row['fbid'];
}
$fbid_mod = 'w'.strval($fbid);
echo $fbid_mod;
$mysql_qry = 'CREATE TABLE '.$fbid_mod.' (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
word_id INT
) DEFAULT CHARACTER SET utf8;';
$result = mysqli_query($conn,$mysql_qry);
if(!$result){
echo $conn->error;
var_dump($result);
}
?>