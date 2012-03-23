<?php
class DB {
  public $items;
	public $link;
	public $item;
	public $customers;
	public $customer;
	public $transactions;
	
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

	public function getItems() {
	  $this->items = mysql_query("SELECT * FROM items;", $this->link);
	}
	
	public function getItem($item_id) {
	  $this->item = mysql_query("SELECT * FROM items WHERE id = $item_id");
	}
	
	public function getCustomers() {
		$this->customers = mysql_query("SELECT * FROM customers;", $this->link);	  
	}
	
	public function getCustomer($cust_id) {
		$this->customer = mysql_query("SELECT * FROM customers WHERE id = $cust_id");
	}
	
	public function insertTransaction($values) {
		$id = $values['id'];
		$customer_id = $values['customer_id'];
		$item_id = $values['item_id'];
		$discount = $values['discount'];
		$item_price = $values['item_price'];
		$total_price = $values['total_price'];
		$date_purchased = $values['date_purchased'];
		$payment_type = $values['payment_type'];
		
		$insert_query = "INSERT INTO `$this->db_name`.`transactions` (
										`id` ,
										`customer_id` ,
										`item_id` ,
										`discount` ,
										`item_price` ,
										`total_price` ,
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
										'$date_purchased',
										'$payment_type'
										);";
										
	  mysql_query($insert_query);
	}
	
	public function getTransactions() {
		$this->transactions = mysql_query("SELECT * FROM transactions ORDER BY date_purchased DESC");
	}
	
	public function dbDisconnect() {
	  mysql_close($link);
  }
}
?>
