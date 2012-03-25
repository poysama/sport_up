<?php 
  include('header.php');

  if(!isset($_SESSION['logged_in'])) {
    header("Location: login.php?last_page=items");
  }
?>

<div id="container">
  <div id="content">
  <h2>Items</h2>

<?php

  $_SESSION['last_page'] = $_GET['last_page'];

  if(isset($_POST['username']) and isset($_POST['password'])) {
    $username = 'admin';
    $password = 'admin';

    if($username == $_POST['username'] and $password == $_POST['password']) {
      $last_page = $_SESSION['last_page'];

      header("Location: $last_page.php");
      $_SESSION['logged_in'] = true;
    } else {
      $_SESSION['flash'] = "Wrong username or password! Please try again.";
    }
  }

  if(isset($_SESSION['logged_in'])) {
    if(isset($_SESSION['flash'])) {
      echo "<center>";
      echo $_SESSION['flash'];
      unset($_SESSION['flash']);
      echo "</center>";
    }
  }
?>
  </div>
</div>
