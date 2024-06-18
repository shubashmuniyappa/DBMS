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
$sql = "DELETE FROM `STORE_ITEM` WHERE iId = $itemId";
$result = $conn->query($sql);
$sql = "DELETE FROM `VENDOR_ITEM` WHERE iId = $itemId";
$result = $conn->query($sql);
$sql = "DELETE FROM `OLDPRICE` WHERE iId = $itemId";
$result = $conn->query($sql);
$sql = "DELETE FROM `ITEM` WHERE iId = $itemId";
$result = $conn->query($sql);

header("Content-Type: application/json");
if($result){
  echo json_encode("Successfully deleted");
  }else{
    echo json_encode("failed to delete");
  }
?>
