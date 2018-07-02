<?php include('database_info.php');
		include('dbname.php');
		
$Date=$Detail=$Cheque=$Debit=$Credit=$Balance="";
	$Date=$_POST["Date"];
	$Detail=$_POST["Detail"];
	$Cheque=$_POST["Cheque"];
	if(isset($_POST["Debit"]))
	{
		$Debit=$_POST["Debit"];
	}
	if(isset($_POST["Credit"]))
	{
		$Credit=$_POST["Credit"];
	}
		$Balance=$_POST["Balance"];
	
$mysql = mysqli_connect("$dbservername", "$dbusername", "$dbpassword", "$dbname");
if($mysql->connect_error)
{
	die('Connection not established '. $mysql->connect_error());	
}

$sql="INSERT INTO transaction(Date,Detail,Cheque,Debit,Credit,Balance) VALUES ('$Date','$Detail','$Cheque','$Debit','$Credit','$Balance')";
if($mysql->query($sql)  ===  TRUE)
{
	echo "<h3>Data entered successfully</h3><br/><br/>";
	echo "<h1>Thank You!</h1><br/>";
	echo "You will be redirected in 1 seconds!";
	//header('bank.php');
	header('refresh:1;url=bank.html');
}
else
{
	echo"Error:". $sql ."<br/>". $mysql->error;
}
$mysql->close();	
?>