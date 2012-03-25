<?php
  session_start(); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Sport Up! - Your favorite shoe store</title>

<link href="stylesheets/style.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 7]>
   <link href="style_ie.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body>
<div id="main">
  <!-- header -->
<div id="nav">
  <div id="nav_content">
    <a href="index.php" class="nav_button">Home</a>
    <a href="cart.php" class="nav_button">Cart</a>
<?php
  if($_SESSION['logged_in']) {
    echo '<a href="customers.php" class="nav_button">Customers</a>';
    echo '<a href="items.php" class="nav_button">Items</a>';
    echo '<a href="transaction.php" class="nav_button">Transactions</a>';
    echo '<a href="logout.php" class="nav_button">Logout</a>';
  } else {
    echo '<a href="login.php?last_page=customers" class="nav_button">Customers</a>';
    echo '<a href="login.php?last_page=items" class="nav_button">Items</a>';
    echo '<a href="login.php?last_page=transaction" class="nav_button">Transactions</a>';
  }
?>
  </div>
</div>

