<?php include('header.php') ?>
<div id="container">
  <div id="content">
  <h2>Login</h2>

<?php

  $last_page = $_GET['last_page'];

  if(isset($_POST['username']) and isset($_POST['password'])) {
    $username = 'admin';
    $password = 'admin';

    if($username == $_POST['username'] and $password == $_POST['password']) {
      header("Location: $last_page.php");
      $_SESSION['logged_in'] = true;
    } else {
      $_SESSION['flash'] = "Wrong username or password! Please try again.";
    }

  }

    if(isset($_SESSION['flash'])) {
      echo "<center>";
      echo $_SESSION['flash'];
      unset($_SESSION['flash']);
      echo "</center>";
    }

  echo "<form action=login.php?last_page=$last_page method=post>
          <table align=center>
            <tr>
              <td>Username:</td>
              <td><input type=text name=username></td>
            </tr>
            <tr>
              <td>Password:</td>
              <td><input type=password name=password></td>
            </tr>
            <tr>
              <td colspan=2><input type=submit value=Login></td>
            </tr>
        </form>";
?>
  </div>
</div>
