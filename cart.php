<?php
  include('header.php');
  include('db.php');

 if(isset($_GET['empty_cart']) and $_GET['empty_cart']) {

  if(isset($_SESSION['cart'])) {
   unset($_SESSION['cart']);
  }
 }

  if(isset($_GET['cancel_item'])) {
    unset($_SESSION['cart'][$_GET['cancel_item']]);
  }
?>

<!-- content -->
<div id="container">
  <div id="content">
  <h2>Cart</h2>
  <?php
   if(!isset($_SESSION['cart'])) {
     $_SESSION['cart'] = array();
   }

   $total = count($_SESSION['cart']);

   if(isset($_POST['id']) and isset($_POST['quantity']) and isset($_POST['price'])) {
    if(!array_key_exists($_POST['id'], $_SESSION['cart'])) {
     $_SESSION['cart'][$_POST['id']] = array('quantity' => $_POST['quantity'], 'price' => $_POST['price']);
		 
		 $_SESSION['cart'][$_POST['id']]['item_name'] = $_POST['item_name'];
     echo "Added item with id " . $_POST['id'] . "<br>";
    }
    else {

     echo "Item already exist in cart!" . "<br>";

     echo "<br>";
      // update quantity
     if($_SESSION['cart'][$_POST['id']]['quantity'] != $_POST['quantity']) {
       echo "Updated quantity of item id " . $_POST['id'] . " from " . $_SESSION['cart'][$_POST['id']]['quantity'] . " to " . $_POST['quantity'];
      $_SESSION['cart'][$_POST['id']]['quantity'] = $_POST['quantity'];
     }

      $_SESSION['cart'][$_POST['id']]['price'] = $_POST['price'];
	
			$_SESSION['cart'][$_POST['id']]['item_name'] = $_POST['item_name'];
    }
   }

   if(!empty($_SESSION['cart'])) {
    $db = new DB();
    $cart_total = 0;

    foreach($_SESSION['cart'] as $id => $value) {
     $db->getItem($id);

     echo "<table>";
     while($row = mysql_fetch_array($db->item)) {
      $image = "images/" . $row['image_url'];
      $id = $row['id'];
      $name = $row['name'];
      $price = $row['price'] * $value['quantity'];
      $cart_total = $cart_total + $price;

      echo "<tr>";
      echo "<td colspan=2><span class=item_title>" . $row['name'] . "</span></td>";
      echo "</tr>";
      echo "<tr>";
      echo "<td colspan=2><img src='$image' class='thumbnail'></td>";
      echo "<input type='hidden' name='id' value=$id>";
      echo "</tr>";

      echo "<tr>";
      echo "<td><b>Quantity:" . $value['quantity'] . "</b></td>";
      echo "<td><b><a href='?cancel_item=$id'>Delete from cart</b></td>";
      echo "</tr>";
      echo "<td colspan=2><hr></td>";
     }
     echo "</table>";

    }
		echo "<p>Cart Total: Php $cart_total </p>";
   }

  ?>
	<p>
		<a href="?empty_cart=true">Empty Your Cart</a>
	</p>
  <p>
   <a href="checkout.php">Checkout!</a>
  </p>
  <p>
   <a href="index.php">Continue shopping</a>
  </p>
 </div>
</div>

<?php include('footer.php') ?>
