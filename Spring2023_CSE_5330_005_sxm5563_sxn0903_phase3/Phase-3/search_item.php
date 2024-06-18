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
$item = $_GET["searchInput"];
$sql = "SELECT * FROM ITEM WHERE iId = $item"; 
$result = $conn->query($sql);
if(mysqli_num_rows($result)<1){
$sql = "SELECT * FROM ITEM WHERE Iname = $item"; 
$result = $conn->query($sql);
}else{
$sql2 = "SELECT * FROM VENDOR_ITEM WHERE iId = $item"; 
$result2 = $conn->query($sql2);
}
echo json_encode($result->fetch_assoc());
mysqli_close($conn);

?>
