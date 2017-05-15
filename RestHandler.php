<?php
require_once("SimpleRest.php");
require_once("Customer.php");
		
class RestHandler extends SimpleRest {

	
	
	//get customer using email address and password( this is used for login purpose)
	function getCustomerByEmailAndPasssword($email,$pass) {	

		$customer = new Customer();
		$rawData = $customer->getCustomerByEmailAndPasssword($email,$pass);
		$this->encode($rawData);
	}
	
	
	
	//update cutomer's data.
	function updateCustomer($customer) {	
		$rawData = $customer->updateCustomer($customer);
	
	}
	
	
	

	public function encodeHtml($responseData) {
	
		$htmlResponse = "<table border='1'>";
		foreach($responseData as $key=>$value) {
    			$htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
		}
		$htmlResponse .= "</table>";
		return $htmlResponse;		
	}
	
	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}
	
	public function encodeXml($responseData) {
		// creating object of SimpleXMLElement
		$xml = new SimpleXMLElement('<?xml version="1.0"?><mobile></mobile>');
		foreach($responseData as $key=>$value) {
			$xml->addChild($key, $value);
		}
		return $xml->asXML();
	}
	
	public function encode($rawData){
		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No data found!');		
		} else {
			$statusCode = 200;
		}
		
		//$requestContentType = $_SERVER['HTTP_ACCEPT'];
		//$this ->setHttpHeaders($requestContentType, $statusCode);
				
		//if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
		/*	
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeHtml($rawData);
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeXml($rawData);
		}
		*/
		print_r ( $response ) ;
	}	
}
?>