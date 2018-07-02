<?php	session_start();
		include('database_info.php');
$mysql = mysqli_connect("$dbservername", "$dbusername", "$dbpassword", "register_firm_details");

	
	$name=$_POST["name"];
	$email=$_POST["email"];
	$phone=$_POST["phone"];
	$address=$_POST["address"];
	$firm_name=$_POST["firm_name"];
	$firm_address=$_POST["firm_address"];
	$firm_email=$_POST["firm_email"];
	$firm_phone=$_POST["firm_phone"];
	$firm_gstin_no=$_POST["firm_gstin_no"];
	$area_of_business=$_POST["area_of_business"];
	$items_sold=$_POST["items_sold"];
	$business_turnover=$_POST["business_turnover"];

	$_SESSION["name"]=$name;
	$_SESSION["email"]=$email;
	$_SESSION["phone"]=$phone;
	$_SESSION["address"]=$address;
	$_SESSION["firm_name"]=$firm_name;
	$_SESSION["firm_address"]=$firm_address;
	$_SESSION["firm_email"]=$firm_email;
	$_SESSION["firm_phone"]=$firm_phone;
	$_SESSION["firm_gstin_no"]=$firm_gstin_no;
	$_SESSION["area_of_business"]=$area_of_business;
	$_SESSION["items_sold"]=$items_sold;
	$_SESSION["business_turnover"]=$business_turnover;
	
	
	
	
	
	
	
	
	
	
	
	
	
	$user_id = $_POST["user_id"];
	$_SESSION["username"]=$user_id;
	$password = $_POST["password"];
/*	$password = md5($_POST["password"]);
*/
if($mysql->connect_error)
{
	
	$conn = new mysqli("$dbservername", "$dbusername", " $dbpassword");

	 $sql34 = "CREATE DATABASE  register_firm_details";
				
				
			if ($conn->query($sql34) === TRUE) 
			{
			
				
				$mysql1 = mysqli_connect("$dbservername", "$dbusername", "$dbpassword", "register_firm_details");

				$sql_tab = "CREATE TABLE registration_details (
				name TEXT
				email TEXT,
				phone TEXT,
				address TEXT,
				firm_name TEXT,
				firm_address TEXT ,
				firm_email TEXT ,
				firm_phone TEXT ,
				firm_gstin_no TEXT ,
				area_of_business TEXT ,
				items_sold TEXT ,
				business_turnover TEXT)";
				
				
				$sql_tab1 = "CREATE TABLE login_details (
				user_id TEXT
				password TEXT)";
				
				
								if (mysqli_query($mysql, $sql_tab) && mysqli_query($mysql, $sql_tab1)) {
								echo "Table MyGuests created successfully";
								} else {
								echo "Error creating table: " . mysqli_error($conn);
								}
	
	
	
	
	
}
}


$mysql = mysqli_connect("$dbservername", "$dbusername", "$dbpassword", "register_firm_details");

$sql= "INSERT INTO registration_details( name, email, phone, address , firm_name ,firm_address, firm_email, firm_phone, firm_gstin_no, area_of_business, items_sold, business_turnover) 
            VALUES ('$name', '$email', '$phone', '$address', '$firm_name', '$firm_address','$firm_email', '$firm_phone','$firm_gstin_no','$area_of_business','$items_sold','$business_turnover')";


			
			
	
$sql1="INSERT INTO login_details( user_id, password) VALUES ('$user_id','$password')";






if($mysql->query($sql)  ===  TRUE  &&  $mysql->query($sql1)  ===  TRUE )
{
	echo "<h3>Data entered successfully</h3><br/><br/>";
	echo "<h1>Thank You!</h1><br/><br/>";
	echo "You will be redirected in 10 seconds!";
	header('refresh:5;url=db_creation.php');
}
else
{
echo "Error:". $sql ."<br/>". $mysql->error;
}

	


$mysql->close();


?>
