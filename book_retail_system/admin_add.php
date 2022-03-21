<?php
if(session_id() == '' || !isset($_SESSION)){session_start();}

include 'config.php';


$name = $_POST["pname"];
$desc = $_POST["desc"];
$qty = $_POST["qty"];
$price = $_POST["price"];
$category = $_POST["category"];
$department = $_POST["dept"];
$photo = $_FILES["bookphoto"]["name"];
$custid=$_SESSION["id"];

if($mysqli->query("INSERT INTO products (product_name, product_desc, product_img_name, qty, price, department, category,customer_id)
 VALUES('$name', '$desc', '$photo', $qty, $price, '$department', '$category', $custid)")){
 	echo 'Data inserted';
 	echo '<br/>';
}
$filename = $_FILES["bookphoto"]["name"];

echo $filename;
    $tempname = $_FILES["bookphoto"]["tmp_name"];    
        $folder = "images/products/".$filename;

        if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
      }


header ("location:admin.php");

?>