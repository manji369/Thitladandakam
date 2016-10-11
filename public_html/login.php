<?php
require "conn.php";
$user_name = $_POST["user_name"];
$user_pass = $_POST["password"];
$mysql_qry = "select * from user_data where username like '$user_name' and password like '$user_pass'";
$result = mysqli_query($conn,$mysql_qry);
if(mysqli_num_rows($result)>0){
$vals = array(res=>Success);
$arr = array(“name” => $vals);
echo json_encode($vals);
//echo json_encode(“Success”);
}
else{
$vals1 = array(res=>Failure);
$arr1 = array(“name” => $vals1);
echo json_encode($vals1);
//echo json_encode(“Failure”);
}
?>
