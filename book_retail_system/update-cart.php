<?php
if(session_id() == '' || !isset($_SESSION)){session_start();}
include 'config.php';
$product_id = $_GET['id'];
$action = $_GET['action'];
if($action === 'empty'){
  $result = $mysqli->query("DELETE  FROM cart WHERE customer_id=".$_SESSION["id"]);
  if($result){
    echo "done";
  }

}
$result = $mysqli->query("SELECT qty FROM products WHERE id = ".$product_id);
if($result){
  if($obj = $result->fetch_object()) {
    switch($action) {
      case "add":
        $result = $mysqli->query("INSERT INTO cart (customer_id,product_id,quantity)
                  SELECT * FROM (SELECT ".$_SESSION["id"]." AS customer_id, ".$product_id." AS product_id, 1 AS quantity) AS tmp
                  WHERE NOT EXISTS (
                    SELECT product_id FROM cart WHERE product_id = ".$product_id."
                      ) LIMIT 1");

        if($result){
          echo "done";
        }
      break;
      case "update":       
          $result = $mysqli->query("UPDATE cart SET quantity = quantity+1 WHERE customer_id=".$_SESSION["id"]." AND product_id=".$product_id);
          if($result){
            echo "done update";
          }  
        break;
      case "remove":
        $result = $mysqli->query("UPDATE cart SET quantity = quantity-1 WHERE customer_id=".$_SESSION["id"]." AND product_id=".$product_id);       
        $result = $mysqli->query("DELETE  FROM cart WHERE customer_id=".$_SESSION["id"]." AND quantity=0" );
        if($result){
          echo "done update";
        }
        break;
    }
  }
}
header("location:cart.php");
?>
