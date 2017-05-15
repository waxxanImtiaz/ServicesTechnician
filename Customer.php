<p><?php
	require_once 'database_connection.php';


	class Customer{
		public $cid;
		public  $name;
		public  $email;
		public  $password;
		public  $mobile;
		public  $address;
		public  $areadId;
		public  $cityId;
		
		public function setName($name){
			$this->name = $name;
		}
		public function getName(){
			return $this->name;
		}
		public function setEmail($email){
			$this->email = $email;
		}
		public function getEmail(){
			return $this->email;
		}	
		public function setMobile($mobile){
			$this->mobile = $mobile;
		}
		public function getMobile(){
			return $this->mobile;
		}
		public function setPassword($password){
			$this->password = $password;
		}
		public function getPassword(){
			return $this->password;
		}
		public function setAddress($address){
			$this->address = $address;
		}
		public function getAddress(){
			return $this->address;
		}
		public function setAreaId($areadId){
			$this->areadId = $areadId;
		}
		public function getAreadId(){
			return $this->areadId;
		}
		public function getCustomerByEmailAndPasssword($userName,$password){
			
			$sql = "SELECT * FROM users WHERE PASSWORD='$password' AND email = '$userName';";
	
	
	
			$result = $GLOBALS['conn']->query($sql);
			$customer = new Customer();
			//echo "password=".$password;
			//echo " email=".$userName;
			
			
			if ($result ){
				
				if($row = $result->fetch(PDO::FETCH_ASSOC)){
					//if($row['email'] == $userName && $row['password'] == $password){
						
						$customer->setName($row['name']);
						$customer->cid = $row['id'];
						$customer->setEmail($row['email']);
						$customer->setPassword($password );
						$customer->setMobile($row['phone']);
						$customer->setAddress($row['address']);
						$customer->setAreaId($row['area_id']);
						$customer->cid = $row['id'];
						$customer->cityId= $row['city_id'];
						

						return $customer;
					//}
				 }
			}
		}
		public function addCustomer($name,$email,$password,$gender,$mobileNumber,$customerArea,$shippingAddress,$address){
			$areaId = (int)$customerArea;
			$areaId++;
			
			$sql = "insert into users (name,email,phone,password,address,gender,area_id) values('$name','$email','$mobileNumber','$password','$address','gender',$areaId);";
	
		 
			if($GLOBALS['conn']->query($sql) == true){
				echo "signedup";
			}else
				echo "notsignedup";
				die();
		}
		public function updateCustomer($customer){
			
			$areadId = (int)$customer->customerArea;
			$custId = (int)$customer->cid;
	
		
			$areaId++;
			$sql = "update users set name = '$customer->name',email='$customer->email',phone='$customer->mobile',password='$customer->password',address='$customer->address',area_id=$areadId where id=$custId;";
	
		
			  if($GLOBALS['conn']->query($sql)){
				echo "Data updated successfully!";
			    }else 
				echo "Data not updated";
			
			
		
		}
	
		public function getCustomerById($id){
			
			
			$sql = "SELECT * FROM `customer` WHERE id = $id;";
	
			$result = $GLOBALS['conn']->query($sql);
			$customer = new Customer();
			
			if ($result ){
				if($row = $result->fetch(PDO::FETCH_ASSOC)){
					//if($row['email'] == $userName && $row['password'] == $password){
						
						$customer->setName($row['name']);
						$customer->setEmail($row['email']);
						$customer->setMobile($row['phone']);
						$customer->setAddress($row['address']);
						$customer->setAreaId($row['area_id']);
						$customer->setCustomerId($row['id']);
						
						
						return $customer;
					//}
				 }
			}
		}
	}		

?></p>