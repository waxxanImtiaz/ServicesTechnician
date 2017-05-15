<?php
require_once("RestHandler.php");		
$view = "";
if($_GET){
	$view = $_GET["view"];
}
else if($_POST ){
	$view = $_POST["view"];
}else if( isset($_PUT["view"]) ){
	$view = "put method";
	$view = $_POST["view"];
}else if( isset($_DELETE["view"]) ){
	$view = $_POST["view"];
}

		

/*
controls the RESTful services
URL mapping
*/

	$restHandler = new RestHandler();
switch($view){
	case "customer":
		/*		
		*to handle REST Url /customer/    
		*(get customer by email and password)
		*/	
		$restHandler->getCustomerByEmailAndPasssword($_GET["email"],$_GET["password"]);
		break;
	case "updatecustomer":
	/*		
		*to handle REST Url /update/customer/ 
		*(update a customer's data )
		*/	
		$customer = new Customer();
		$customer->cid= $_POST["id"];
		$customer->name = $_POST["name"];
		$customer->email = $_POST["email"];
		$customer->password = $_POST["password"];
		$customer->mobileNumber = $_POST["mobileNumber"];
		$customer->customerArea = $_POST["customerArea"];
		$customer->address = $_POST["address"];
		
		$restHandler->updateCustomer($customer);
		break;
	case "" :
		//404 - not found;
		break;
}
?>