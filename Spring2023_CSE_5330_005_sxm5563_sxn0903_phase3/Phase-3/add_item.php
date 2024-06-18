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
$currentDate = date("ymd");
$newItemName = $_GET["ItemName"];
$newItemPrice = $_GET["ItemPrice"];
$newItemVprice = $_GET["ItemVendorPrice"];
$newItemSQTY = $_GET["ItemStoreQTY"];
$newItemVID = $_GET["ItemVendorID"];
$newItemSID = $_GET["ItemStoreID"];
$sql = "INSERT INTO `ITEM` ( `Iname`, `Sprice`) VALUES  ( $newItemName, $newItemPrice)";
$result = $conn->query($sql);
$new_key = $conn->insert_id;
$sql2 = "INSERT INTO `OLDPRICE` ( `iId`, `Sprice`,`Sdate`,`Edate`) VALUES  ($new_key,$newItemPrice,$currentDate,null)";
$result2 = $conn->query($sql2);

if(!empty($newItemVID) && !empty($newItemVprice)){
$sql3 = "INSERT INTO `VENDOR_ITEM` ( `vId`, `iId`,`Vprice`) VALUES  ($newItemVID,$new_key,$newItemVprice)";
$result3 = $conn->query($sql3);
}

if(!empty($newItemSID) && !empty($newItemSQTY)){
$sql4 = "INSERT INTO `STORE_ITEM` ( `sId`, `iId`,`Scount`) VALUES  ($newItemSID,$new_key,$newItemSQTY)";
$result4 = $conn->query($sql4);
}

header("Content-Type: application/json");

if($result === true and $result2 === true ){
echo "Successfully inserted";
}else{
  echo "Failed to insert";   
}
mysqli_close($conn);

?>
