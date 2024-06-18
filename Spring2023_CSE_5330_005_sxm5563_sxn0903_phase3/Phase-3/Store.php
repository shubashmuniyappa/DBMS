<?php
/* 
Authors :Shubash Muniyappa 1001915563
         Sai Krishna Prateek Nama 1001880903 */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With");

$servername = "localhost:8889";
$username = "root";
$password = "root";
$dbname = "DB1";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
$sql = "SELECT * FROM `STORE`"; 
$result = $conn->query($sql);
echo json_encode($result->fetch_all(MYSQLI_ASSOC));
mysqli_close($conn);

?>
