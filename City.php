<?php
	require_once 'database_connection.php';
	
	
	class City{
		public $city_id;
		public $City_name;
		
		public function getAllCities(){
			
			$sql = "SELECT * FROM city;";
			$result = $GLOBALS['conn']->query($sql);
	
			$jsonList = array();
			$count = 0;
		
			if ($result ) {
				while($row = $result->fetch(PDO::FETCH_ASSOC)){
				$city = new City();
				
				$city->city_id = $row['city_id'];
				$city->City_name = $row['City_name'];
				
			
				$jsonList[$count] = $city;
				$count++;
			}
		   echo json_encode($jsonList);
		} else {
			echo "Table is empty";
			}
	
		}
	}
?>