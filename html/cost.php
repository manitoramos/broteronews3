<?php
$item = $_GET['item'];
$item = str_replace("\"", "", $item);
$item = str_replace("\'", "", $item);
$item = str_replace(" ", "%20", $item);
$item = str_replace("\\", "", $item);
@include_once ("pdocon.php");
$stmt = $dbh->prepare("SELECT * FROM items WHERE name=?");
$stmt->execute(array($item));
$rs = $stmt->fetch(PDO::FETCH_ASSOC);
if(!empty($rs)) {
        if(time()-$rs["lastupdate"] < 604800) die($rs["cost"]);
}
$link = "http://steamcommunity.com/market/priceoverview/?currency=1&appid=730&market_hash_name=".$item;
$string = file_get_contents($link);
$json = $string;
 
$obj = json_decode($json);
//print $obj->{"median_price"}; // 12345
//$obj = json_decode($string);
if($obj->{'success'} == "0") die("notfound");
$lowest_price = $obj->{'median_price'};
$lowest_price=str_replace("$", "", $lowest_price);
$lowest_price = (float)($lowest_price);

//$stmt = $dbh->prepare("DELETE FROM items WHERE name=?");
//$stmt->execute(array($item));
$stmt = $dbh->prepare("UPDATE items SET `cost` = ?,`lastupdate` = ? WHERE `name` = ?");
$stmt->execute(array($lowest_price, time(), $item));
$stmt = $dbh->prepare("INSERT INTO items (`name`,`cost`,`lastupdate`) VALUES (?, ?, ?)");
$stmt->execute(array($item, $lowest_price, time()));
echo $lowest_price;
?>