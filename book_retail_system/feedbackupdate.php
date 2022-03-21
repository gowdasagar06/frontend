<?php

include 'config.php';
if(session_id() == '' || !isset($_SESSION)){session_start();}


$rating = $_POST["rating"];
$desc = $_POST["desc"];
$productid= $_POST["product"];

$userid= $_SESSION["id"];
echo $productid;


 if($mysqli->query("INSERT INTO feedback ( rating, feed_desc, product_id, customer_id ) VALUES('$rating', '$desc',$productid,$userid)")){
 	echo 'Data inserted';
 	echo '<br/>';
 }
header ("location:index.php");

?>
