<?php
  include('header.php');
  include('db.php');
?>

<!-- content -->
<div id="container">
  <div id="content">
    <h2>Settings</h2>
<?php
  $db = new DB();
  $db->getDiscount();

  $row = mysql_fetch_array($db->discount);
  $discount = $row['discount'];

  if(isset($_POST['discount'])) {
    if(empty($discount)) {
      $db->insertDiscount($_POST['discount']);
  } else {
      $db->updateDiscount($_POST['discount']);
    }
  }

  $db->getDiscount();
  $row = mysql_fetch_array($db->discount);
  $discount = $row['discount'];
  
  echo "<form action=settings.php method=post>
      <table border=0>
        <tr>
        <td>
          Discount: 
        </td>
        <td>";
        if($discount > 0) {
          echo "<input type=text size=3 name=discount value=$discount>";
        } else {
          echo "<input type=text size=3 name=discount value=0>";
        }
  echo "</td>
        <td>
          <input type=submit value=Apply>
        </td>
        </tr>
      </table>
    </form>";
?>
  </div>
</div>
