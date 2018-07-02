<?php 
	session_start();
	
	include('database_info.php');
	
$mysql = mysqli_connect("$dbservername", "$dbusername", "$dbpassword", "register_firm_details");
	$user_id=$_POST["user_id"];
	$password=$_POST["password"];
	$i=1;
$_SESSION["dbname"]=$user_id;
	$_SESSION["i"]=$i;

if($mysql->connect_error)
{
	echo "Not";
	die('Connection not established '. $mysql->connect_error());	
}
$sql="SELECT * from login_details where user_id='$user_id'";

		$qry = mysqli_query($mysql,$sql);	

		while($row = mysqli_fetch_array($qry,MYSQLI_ASSOC))
		{
			
			$x=$row["password"];
			if( $x == $password )
			{
				echo  "Login Sucessfully";
			header('refresh:0;url=dbname.php');					
			}
			else
			{
				echo "Username and Password Not Matches";
					header('refresh:10;url=login.html');

			}
			
			
			
			
		}













?>