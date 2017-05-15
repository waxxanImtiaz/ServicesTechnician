<?php
require_once('db_class.php');
$d = new db();

$conn = $d->conn;
if(isset($_POST['app_start']) && $_POST['app_start']== true) // when user starts app
{
	
	
	$user_id=$_POST['userid'];
//	$user_fb_id=mysqli_real_escape_string($_POST['user_fb_id']);
	$sql = "SELECT users.id as userid,cities.id as cityid, cities.name as city_name, areas.id as area_id, areas.name as area_name, users.name, users.email,users.phone,users.email, users.address, users.password FROM users, cities, areas WHERE users.id=".$user_id." AND users.city_id=cities.id AND users.area_id=areas.id";
//	echo $sql;
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) ==1) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		$response = array($row);
header('Content-type: text/javascript');
echo json_encode($response);
    }
} else {
    $response = array('req_status' => 'failure');
header('Content-type: text/javascript');
echo json_encode($data);
}

mysqli_close($response);


}
else if(isset($_POST['req_service']) && $_POST['req_service']== true) // when user requests service
{
	
	$stmt=$conn->prepare("INSERT INTO serviceforms (username,address,phone,service_type_id,message,user_id) VALUES (?,?,?,?,?,?)");
	$stmt->bind_param("sssisi", $name,$address,$phone,$service_type,$message,$user_id);
	$name=$_POST['name'];
	$address=$_POST['address'];
	$phone=$_POST['phone'];
	$service_type=$_POST['service_type'];
	$message=$_POST['message'];
	$user_id=$_POST['userid'];
	

if($stmt->execute())
{
	$response = array('req_status' => 'success');
header('Content-type: text/javascript');
echo json_encode($response);
}
else
{
	
	$response = array('req_status' => 'failure');
header('Content-type: text/javascript');
echo json_encode($response); 
}
$stmt->close();
$conn->close();

}
else if(isset($_POST['complain']) && $_POST['complain']== true) // when user submits complain
{
	$stmt=$conn->prepare("INSERT INTO complain (complain_text,user_id) VALUES (?,?)");
	$stmt->bind_param("si", $complain_text,$user_id);
	$complain_text=$_POST['complain_text'];
	$user_id=$_POST['userid'];
	
	if($stmt->execute())
{
	$response = array('req_status' => 'success');
header('Content-type: text/javascript');
echo json_encode($response);
}
else
{
	
	$response = array('req_status' => 'failure');
header('Content-type: text/javascript');
echo json_encode($response); 
}

$stmt->close();
$conn->close();
}
else if(isset($_POST['feedback']) && $_POST['feedback']== true) // when user submits feedback
{
	$stmt=$conn->prepare("INSERT INTO feedback (username,phone,email,city_id,feedback,user_id) VALUES (?,?,?,?,?,?)");
	$stmt->bind_param("sssisi", $username,$phone,$email,$city_id,$feedback,$user_id);
	$username=$_POST['username'];
	$phone=$_POST['phone'];
	$email=$_POST['email'];
	$city_id=$_POST['city_id'];
	$feedback=$_POST['feedback'];
	$user_id=$_POST['userid'];
if($stmt->execute())
{
	$response = array('req_status' => 'success');
header('Content-type: text/javascript');
echo json_encode($response);
}
else
{
	
	$response = array('req_status' => 'failure');
header('Content-type: text/javascript');
echo json_encode($response);
}
$stmt->close();
$conn->close();
}
