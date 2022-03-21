<?php


if(session_id() == '' || !isset($_SESSION)){session_start();}
include 'config.php';

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Products || Book Retail Store</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
    <style>
      .columns{
        box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2);
        max-width: 300px;
        min-width: 300px;
        margin: 3px;

        min-height: 550px;
        max-height: 550px;
      }
      .columns img{
  object-fit: cover;
  width:300px;
  height:250px;


}
.bottomleft {
  position: absolute;
  bottom: 10px;
  left: 30px;
  
}
.bottomright {
  position: absolute;
  bottom: 10px;
  right: 30px;
}

    </style>

  </head>
  <body>

    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="index.php">Book Retail Store</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>

      <section class="top-bar-section">
      
        <ul class="right">
          <li><a href="about.php">About</a></li>
          <li class='active'><a href="products.php">Products</a></li>
          <li><a href="cart.php">View Cart</a></li>
          <li><a href="orders.php">My Orders</a></li>
          <?php

          if(isset($_SESSION['username'])){
            echo '<li><a href="account.php">My Account</a></li>';
            echo '<li><a href="admin.php">ADD Products</a></li>';
            echo '<li><a href="logout.php">Log Out</a></li>';
          }
          else{
            echo '<li><a href="login.php">Log In</a></li>';
            echo '<li><a href="register.php">Register</a></li>';
          }

          ?>
        </ul>
      </section>
    </nav>
    <div class="row" style="margin-top:10px;">
      <div class="small-12">
        <?php
          $i=0;
          $product_id = array();
          $product_quantity = array();

          $result = $mysqli->query('SELECT * FROM products');
          if($result === FALSE){
            die(mysql_error());
          }

          if($result){
            ?>
<?php
            while($obj = $result->fetch_object()) {
              ?>
              
              
              
              <div class="large-4 columns">
              <img style="" src="images/products/<?php echo $obj->product_img_name ?>"/>
              <h3><strong><?php echo substr_replace($obj->product_name, "...", 10) ?></strong></h3>
              

              <p><strong>Book stream</strong>: <?php echo $obj->category  ?></p>
              <p><strong>Book Branch</strong>: <?php echo $obj->department ?></p>
              <p><strong>Description</strong>: <?php echo substr_replace($obj->product_desc, "...", 50) ?></p>
              <p><strong>Price (Per Unit)</strong>: <?php echo $currency.$obj->price ?></p>
              

              <?php
              if($obj->qty > 0){
                ?><div class='bottomleft' style="float:left; margin:3px;"><a href="update-cart.php?action=add&id=<?php echo $obj->id ?>"><input type="submit" value="Add To Cart" style="clear:both; background: #0078A0; border: none; color: #fff; font-size: 1em; padding: 10px;" /></a></div>
                <div class='bottomright' style="float:right; margin:3px;"><a href="feedback.php?name=<?php echo $obj->product_name ?>&id=<?php echo $obj->id ?>"><input type="submit" value="Rate Product" style="clear:both; background: #fb641b; border: none; color: #fff; font-size: 1em; padding: 10px;" /></a></div>
                <?php
              }
              else {
                echo 'Out Of Stock!';
              }?>
              
                   
                   
                   <?php
              echo '</div>';

              $i++;
            }

          }

          $_SESSION['product_id'] = $product_id;

          echo '</div>';
          echo '</div>';
          ?>

        <div class="row" style="margin-top:10px;">
          <div class="small-12">

        <footer style="margin-top:10px;">
        <p style="text-align:center; font-size:0.8em;">&copy; 2022 copyright: Book Retail Store. </p>
        </footer>

      </div>
    </div>

    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
</html>
