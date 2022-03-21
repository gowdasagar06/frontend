<?php
if(session_id() == '' || !isset($_SESSION)){session_start();}

include 'config.php';

$result1 = $mysqli->query("SELECT * FROM cart WHERE customer_id=".$_SESSION["id"]);

if($result1) {

  $total = 0;

  while($cart=$result1->fetch_object()) {


    $result = $mysqli->query("SELECT * FROM products WHERE id = ".$cart->product_id);

    if($result){

      if($obj = $result->fetch_object()) {


        $cost = $obj->price * $cart->quantity;

        $user = $_SESSION["username"];
        $id=$_SESSION["id"];

        $query = $mysqli->query("INSERT INTO orders (product_id, product_name, product_desc, price, units, total, customer_id) VALUES(2, '$obj->product_name', '$obj->product_desc', $obj->price, $cart->quantity, $cost, $id)");

        if($query){
          $newqty = $obj->qty - $cart->quantity;
          if($mysqli->query("UPDATE products SET qty = ".$newqty." WHERE id = ".$cart->product_id)){
          echo "done1";

          }
          echo "done2";
        }
        

       

      }
    }
  }
}

$result = $mysqli->query("DELETE  FROM cart WHERE customer_id=".$_SESSION["id"]);
  if($result){
    echo "done";
  }
header("location:success.php");

?>
