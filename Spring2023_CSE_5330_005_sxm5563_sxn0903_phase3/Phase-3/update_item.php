<?php
/* 
Authors :Shubash Muniyappa 1001915563
         Sai Krishna Prateek Nama 1001880903 */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");

header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With");

$method = $_SERVER['REQUEST_METHOD'];
$servername = "localhost:8889";
$username = "root";
$password = "root";
$dbname = "DB1";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
$itemId = $_GET["itemId"];
$newItemName = $_GET["ItemName"];
$newItemPrice = $_GET["ItemPrice"];
$currentDate = date("ymd");


if(empty($newItemPrice)){
$sql = "UPDATE ITEM set Iname = '".$newItemName."' WHERE iId = '".$itemId."' ";
}elseif(empty($newItemName)){
$sql = "UPDATE ITEM set Sprice = '".$newItemPrice."' WHERE iId = '".$itemId."' ";
$sql2 = "UPDATE OLDPRICE set Edate = $currentDate  WHERE iId = $itemId and Edate is null";
$sql3 = "INSERT INTO OLDPRICE (iId, Sprice, Sdate, Edate) Values ($itemId,$newItemPrice,$currentDate,null)";
$result2 = $conn->query($sql2);
$result3 = $conn->query($sql3);
}elseif(!empty($newItemPrice) and !empty($newItemName)){
$sql = "UPDATE ITEM set Iname = '".$newItemName."', Sprice = $newItemPrice WHERE iId = $itemId ";  
$sql2 = "UPDATE OLDPRICE set Edate = $currentDate  WHERE iId = $itemId and Edate is null";
$sql3 = "INSERT INTO OLDPRICE (iId, Sprice, Sdate, Edate) Values ($itemId,$newItemPrice,$currentDate,null)";
$result2 = $conn->query($sql2);
$result3 = $conn->query($sql3);
}
$result = $conn->query($sql);

header("Content-Type: application/json");
if($result){
echo json_encode("Successfully updated");
}else{
  echo json_encode("failed to update");
}
?>
