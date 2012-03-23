<?php
class DB {
  public $items;
  public $link;
  public $item;
  public $customers;
  public $customer;
  public $transactions;
  public $discount;

  public function __construct() {
    $this->dbConnect();
    $this->useDB();
  }

  public function dbConnect() {
    $this->link = mysql_connect( "localhost", "root", "" );

    if ( ! $this->link ) {
      die( "Couldn't connect to MySQL" );
    }
  }

  public function useDB() {
    $this->db_name = "sport_up";

    $res = mysql_select_db($this->db_name, $this->link);
  }

  public function itemSold($item_id, $qty) {
    $update_str = "UPDATE items SET quantity = quantity - $qty WHERE id = $item_id"; 

    mysql_query($update_str);
  }

  public function getItems() {
    $this->items = mysql_query("SELECT * FROM items;", $this->link);
  }

  public function getItem($item_id) {
    $this->item = mysql_query("SELECT * FROM items WHERE id = $item_id");
  }

  public function updateItem($item_id, $values) {
    $item_name = $values['item_name'];
    $description = $values['description'];
    $quantity = $values['qty'];
    $price = $values['price'];
    $image_url = $values['image_url'];

    $update_str = "UPDATE items SET name = '$item_name',
                                    description = \"$description\",
                                    quantity = $quantity,
                                    price = $price,
                                    image_url = '$image_url' WHERE id = $item_id;";

    mysql_query($update_str);
  }

  public function insertItem($values) {
    $item_name = $values['item_name'];
    $description = $values['description'];
    $quantity = $values['qty'];
    $price = $values['price'];
    $image_url = $values['image_url'];

    $insert_str = " INSERT INTO `$this->db_name`.`items` (
                    `name`,
                    `description`,
                    `image_url`,
                    `price`,
                    `quantity`
                    )
                    VALUES (
                    '$item_name',
                    \"$description\",
                    '$image_url',
                    '$price',
                    '$quantity'
                    );";

    mysql_query($insert_str);
  }

  public function deleteItem($item_id) {
    $delete_str = "DELETE FROM items WHERE id = $item_id;";

    mysql_query($delete_str);
  }



  public function getCustomers() {
    $this->customers = mysql_query("SELECT * FROM customers;", $this->link);
  }

  public function getCustomer($cust_id) {
    $this->customer = mysql_query("SELECT * FROM customers WHERE id = $cust_id");
  }

  public function updateCustomer($cust_id, $ln, $fn) {
    $update_str = "UPDATE customers SET last_name = '$ln', first_name = '$fn' WHERE id = $cust_id;";

    mysql_query($update_str);
  }

  public function insertCustomer($ln, $fn) {
    $insert_str = " INSERT INTO `$this->db_name`.`customers` (
                    `last_name`,
                    `first_name`
                    )
                    VALUES (
                    '$ln',
                    '$fn'
                    );";


    mysql_query($insert_str);

  }

  public function deleteCustomer($cust_id) {
    $delete_str = "DELETE FROM customers WHERE id = $cust_id;";

    mysql_query($delete_str);
  }

  public function getTransactions() {
    $this->transactions = mysql_query("SELECT * FROM transactions ORDER BY date_purchased DESC");
  }

  public function filterTransactionsByCustomer($customer_id) {
    $select_str = "SELECT * FROM transactions WHERE customer_id = $customer_id";

    $this->transactions = mysql_query($select_str);
  }

  public function filterTransactionsByDate($date) {
    $select_str = "SELECT * FROM transactions WHERE date_purchased LIKE '$date%'";

    $this->transactions = mysql_query($select_str);
  }

  public function filterTransactionsByDateRange($date1, $date2) {
    $select_str = "SELECT * FROM transactions WHERE DATE(date_purchased) BETWEEN '$date1' AND '$date2'";

    $this->transactions = mysql_query($select_str);
  }


  public function insertTransaction($values) {
    $id = $values['id'];
    $customer_id = $values['customer_id'];
    $item_id = $values['item_id'];
    $discount = $values['discount'];
    $item_price = $values['item_price'];
    $total_price = $values['total_price'];
    $qty = $values['quantity'];
    $date_purchased = $values['date_purchased'];
    $payment_type = $values['payment_type'];

    $insert_query = "INSERT INTO `$this->db_name`.`transactions` (
                    `id` ,
                    `customer_id` ,
                    `item_id` ,
                    `discount` ,
                    `item_price` ,
                    `total_price` ,
                    `quantity`,
                    `date_purchased`,
                    `payment_type`
                    )
                    VALUES (
                    '$id',
                    '$customer_id',
                    '$item_id',
                    '$discount',
                    '$item_price',
                    '$total_price',
                    '$qty',
                    '$date_purchased',
                    '$payment_type'
                    );";

    mysql_query($insert_query);
  }

  public function getDiscount() {
    $sql = "SELECT * FROM settings"; 

    $this->discount = mysql_query($sql);
  }

  public function insertDiscount($dc) {
    $sql = "INSERT INTO `$this->db_name`.`settings` (`discount`) VALUES ($dc);";

    mysql_query($sql);
  }

  public function updateDiscount($dc) {
    $sql = "UPDATE settings SET discount = $dc";

    mysql_query($sql);
  }

  public function dbDisconnect() {
    mysql_close($link);
  }
}
?>
