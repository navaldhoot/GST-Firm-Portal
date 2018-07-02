<?php
	include('dbname.php');
	include('database_info.php');
$item_name=$hsn_code=$igst=$cgst=$sgst=$notes="";

	
	$item_name=$_POST["item_name"];
	$hsn_code=$_POST["hsn_code"];
	$igst=$_POST["igst"];
	$cgst=$_POST["cgst"];
	$sgst=$_POST["sgst"];
	$notes=$_POST["notes"];


$mysql = mysqli_connect("$dbservername", "$dbusername", "$dbpassword", "$dbname");

if($mysql->connect_error)
{
	echo "Not";
	die('Connection not established '. $mysql->connect_error());	
}
$sql= "INSERT INTO item_details( item_name, hsn_code, igst, cgst , sgst , notes) VALUES ('$item_name', '$hsn_code', '$igst', '$cgst', '$sgst', '$notes')";


if($mysql->query($sql)  ===  TRUE)
{
	echo "<h3>Data entered successfully</h3><br/><br/>";
	echo "<h1>Thank You!</h1><br/><br/>";
	echo "You will be redirected in 10 seconds!";
	header('refresh:10;url=item.html');
}
else
{
echo "Error:". $sql ."<br/>". $mysql->error;
}
	
$mysql->close();


?>
