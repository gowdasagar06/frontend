<?php

if(session_id() == '' || !isset($_SESSION)){session_start();}

if(!isset($_SESSION["username"])) {
  header("location:index.php");
}

$custid=$_SESSION["id"];
include 'config.php';
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Books || Book retail system</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
    <style>
      .card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 350px;
  min-height: 500px;
  max-height: 500px;


  margin: auto;
  text-align: center;
  font-family: arial;
}

.card img{
  object-fit: cover;
  width:3000px;
  height:300px;


}
.card img{
  object-fit: cover;
  width:3000px;
  height:300px;


}
.column {
  float: left;
  width: 33.3%;
  padding: 0 10px;
  margin-bottom:10px
}
.small-4 label{
  font-size: 15px;
  font-weight:bold;
}
    </style>
    
  </head>
  <body>

    <nav class="top-bar" data-topbar role="navigation">
      <ul class="title-area">
        <li class="name">
          <h1><a href="index.php">Book retail system</a></h1>
        </li>
        <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
      </ul>

      <section class="top-bar-section">
      <!-- Right Nav Section -->
        <ul class="right">
          <li><a href="about.php">About</a></li>
          <li><a href="products.php">Products</a></li>
          <li><a href="cart.php">View Cart</a></li>
          <li><a href="orders.php">My Orders</a></li>
          <li><a href="contact.php">Contact</a></li>
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

        <form method="POST" action="admin_add.php" style="margin-top:30px;" enctype="multipart/form-data">
      <div class="row">
        <hr>
      <h4 style='text-align:center;'><strong> Add New Books</strong></h4>
          <hr>
        <div class="small-10">

          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Product Name</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="right-label" placeholder="Enter the product name" name="pname">
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label type='' for="right-label" class="right inline">Product Description</label>
            </div>
            <div class="small-8 columns">
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Description" name="desc"></textarea>

            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Quantity</label>
            </div>
            <div class="small-8 columns">
              <input type="number" id="right-label" placeholder="enter the quantity" name="qty">
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Price</label>
            </div>
            <div class="small-8 columns">
              <input type="number" id="right-label" placeholder="Enter your Cost" name="price">
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Category</label>
            </div>
            <div class="small-8 columns">
                <select name="category" class="form-select" aria-label="Default select example">
                  <option selected>Open this select menu</option>
                  <option value="engineering">Engineering</option>
                  <option value="medical">Medical</option>
                  </select>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Department</label>
            </div>
            <div class="small-8 columns">
              <input type="text" id="right-label" placeholder="Enter the Department " name="dept">
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">
              <label for="right-label" class="right inline">Book Image</label>
            </div>
            <div class="small-8 columns">
            <input class='abc'  type="file" name="bookphoto"/>
            </div>
          </div>
          <div class="row">
            <div class="small-4 columns">

            </div>
            <div class="small-8 columns">
              <input type="submit" id="right-label" value="Add Book" style="background: #0078A0; border: none; color: #fff; font-family: 'Helvetica Neue', sans-serif; font-size: 1em; padding: 10px;">
              <input type="reset" id="right-label" value="Reset" style="background: #0078A0; border: none; color: #fff; font-family: 'Helvetica Neue', sans-serif; font-size: 1em; padding: 10px;">
            </div>
          </div>
        </div>
      </div>
    </form>
    <hr>

    <div class='container'>
              <div class='row'>
      <h3 style='text-align:center;'><strong> Your Books</strong></h3>
      <hr>

        <?php
          $result = $mysqli->query("SELECT * from products where customer_id='$custid' order by id asc");
          if($result) {
            while($obj = $result->fetch_object()) {
              
              ?>
              
              <div class="column">
              
              <div class="card">
              <img style="" src="images/products/<?php echo $obj->product_img_name ?>"/>
              <h3><strong><?php echo $obj->product_name ?></strong></h3>
              

              <h4>Product Id:<?php echo  $obj->id ?></h4>
              <h4>Category: <?php echo  $obj->category ?></h4>
              <h4>Units Available: <?php echo  $obj->qty ?></h4>
              </div>
                   
              </div>
              
              
              <?php
            }
          }
        ?>



      </div>
    </div>


    <div class="row" style="margin-top:10px;">
      <div class="small-12">
        
        <footer style="margin-top:10px;">
           <p style="text-align:center; font-size:0.8em;">&copy; 2022 copyright: Book Retail Store.</p>
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
