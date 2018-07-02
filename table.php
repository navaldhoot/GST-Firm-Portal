<?php include('database_info.php');
		include('dbname.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="shortcut icon" href="favicongst.ico" />

		<!------TITLE----------->
	<title>Table Generation</title>
	<!----------INCLUSION OF FONT AWESOME LIBRARY---------------->
	<script src="https://use.fontawesome.com/7d44bc7623.js"></script>
	<link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
	<!------------BOOTSTRAP  FILE---------->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-----------CSS FILE---------->
	<link rel="stylesheet"  type="text/css" href="css/register.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<style>
	h1{
		text-align:left;
		font-size:30px;
		
	}
	.choice{
		text-align:center;
		font-size:20px;
		padding:10px;
		
	}
	
			table{
				margin:20px;
				align:center;
			}
			table, th, td {
    				border: 2px solid black;
    				border-collapse: collapse;
					padding:10px;
				}
			 .header{
	padding:0px;
	background:white;
}
.logo img{
	height:180px;
}
.heading h1
{
font-family: Open Sans, sans-serif;
font-weight: 800;
font-size: 45px;
}
.heading h3
{
font-family: Open Sans, sans-serif;
font-weight: normal;
font-size: 30px;
}

.head-under {
	width:300px;
    border: 2px solid #0a4bff;
    margin-right: 50%;
    margin-left: 0;
    margin-top: 8px;
}

.login-menu{
background:#235c73;
}

.login-menu a{
color:white;
text-decoration:none;
font-size:20px;
font-weight:300;

}

.login-menu ul li{
display:inline-block;
padding:10px;	
}

.menu-center{
text-align:center;
}
footer{
background:#235c73;
text-align:center;
color:white;
font-size:20px;
}
	</style>
	</head>
	
	<body>
	<div class="container-fluid">
		<div class="row header">
            <div class="col-md-4 col-sm-4 logo">
                	<img src="images/logo.png" alt="gst Icon">
            </div>
            <div class="col-md-8 col-sm-8 heading"> 	
				<h1>GST Firm Portal</h1>      
				<hr class="head-under">
				<h3>Mission,Vision & Values</h3>
			</div>
		</div>			

	<!---------------------MENU ------------------------->
	<div class="row login-menu">
	
	<div class="col-md-12 menu-center">

		<ul>
				<li><a href="login_homepage.html">Home</a></li>
				<li><a href="profile_page.php">Profile</a></li>
				<li><a href="item.html">Products</a></li>
				<li><a href="purchase.html">Purchases</a></li>
				<li><a href="bill.html">Bill Generation</a></li>
				<li><a href="#">Table Representation</a></li>
				<li><a href="bank.html">Bank Details</a></li>
   			<li class="logout"><a href="logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>
			<ul>
    
	</div>
	</div>
	
	
	
	
	
	
	
	
	
	
	
	<form action="table.php" method="post">

		
			<div class="row">
				<div class="col-md-12">
					<h1 align="center">Table Generation</h1>
				</div></br>
			</div>
			<br/>
			<div>Select which table is to be generated</div>
			<br/>
			<div class="row choice">
				<div class="col-md-4">
					<input type="radio" name="table" value="1">Bank Transaction
				</div>
				<div class="col-md-4">
					<input type="radio" name="table" value="2">Purchase Details
				</div>
				<div class="col-md-4">
					<input type="radio" name="table" value="3">Sales Details
				</div>
			</div>
			<input type="submit" name="submit" value="Submit"><br><br><br><br><br/>
			<?php
			

$mysql = mysqli_connect("$dbservername", "$dbusername", "$dbpassword", "$dbname");
if($mysql->connect_error)
{
	echo "Not";
	die('Connection not established '. $mysql->connect_error());	
}
if(isset($_POST['submit']))
{
	if(!empty($_POST['table'])) 
	{
        if ($_POST['table']=="2") 
		{
			
			$i=1;
			
			echo "<h1>Purchase Details Table</h1>";
			echo "<br><br>";
			echo  "<table border='1' width='100%'>
			<tr>
			<th>S.no.</th>
			<th>Supplier Invoice No</th>
			<th>Party Account Name</th>
			<th>Party GSTIN</th>
			<th>Date</th>
			<th>Item Name</th>
			<th>Quantity</th>
			<th>Rate</th>
			<th>IGST</th>
			<th>Total</th>
			<th>Total with tax</th>
		</tr>";
	if ($result = $mysql->query("SELECT * FROM purchase_details"))
	{
if($result->num_rows > 0)
{
	while($row=$result->fetch_assoc())
	{
		echo "<tr>
				<td>".$i."</td>
				<td>".$row['supplier_invoice_no']."</td>
				<td>".$row['party_account_name']."</td>
				<td>".$row['party_gstin']."</td>
				<td>".$row['date']."</td>
				<td>".$row["item_name"]."</td>
				<td>".$row['quantity']."</td>
				<td>".$row['rate']."</td>
				<td>".$row['igst']."</td>
				<td>".$row['total']."</td>
				<td>".$row['total_with_tax']."</td>
			</tr>";
			$i++;
	}

	}}			echo "</table>";
}}}
$mysql->close();





			?>
					
<?php

			$mysql = mysqli_connect("$dbservername", "$dbusername", "$dbpassword", "$dbname");
			if($mysql->connect_error)
			{
			echo "Not";
			die('Connection not established '. $mysql->connect_error());	
			}
			
$sql="SELECT * from transaction";
$result=$mysql->query($sql);

if(isset($_POST['submit']))
{
	if(!empty($_POST['table'])) 
	{
        if ($_POST['table']=="1") 
		{
						$j=1;

echo "<h1>Bank Transaction Table</h1>";
echo "<br><br>";
 echo  "<table border='1'>
		<tr>
			<th>S.No.</th>
			<th>Date</th>
			<th>Detail</th>
			<th>Cheque</th>
			<th>Debit</th>
			<th>Credit</th>
			<th>Balance</th>
		</tr>";
if($result->num_rows > 0)
{
	while($row=$result->fetch_assoc())
	{
		echo "<tr>
				<td>".$j."</td>
				<td>".$row["Date"]."</td>
				<td>".$row["Detail"]."</td>
				<td>".$row["Cheque"]."</td>
				<td>".$row["Debit"]."</td>
				<td>".$row["Credit"]."</td>
				<td>".$row["Balance"]."</td>
			</tr>";
		$j++;
	}
}	
echo "</table>";}}}
			$mysql->close();
?>
		<?php
			

$mysql = mysqli_connect("$dbservername", "$dbusername", "$dbpassword", "$dbname");
if($mysql->connect_error)
{
	echo "Not";
	die('Connection not established '. $mysql->connect_error());	
}
if(isset($_POST['submit']))
{
	if(!empty($_POST['table'])) 
	{
        if ($_POST['table']=="3") 
		{
			
			$k=1;
			
			echo "<h1>Sales Details Table</h1>";
			echo "<br><br>";
			echo  "<table border='1' width='100%'>
			<tr>
			<th>S.no.</th>
			<th>Invoice No</th>
			<th>Bill Date</th>
			<th>Buyer Name</th>
			<th>Buyer Address</th>
			<th>Buyer GSTIN</th>
			<th>Item List</th>
			<th>Quantity List</th>
			<th>Rate List</th>
			<th>Per(Unit)</th>
			<th>Tax List</th>
			<th>Tax Amount</th>
			<th>Grandtotal</th>
		</tr>";
	if ($result = $mysql->query("SELECT * FROM bill_details"))
	{
if($result->num_rows > 0)
{
	while($row=$result->fetch_assoc())
	{
		echo "<tr>
				<td>".$k."</td>
				<td>".$row['invoice_no']."</td>
				<td>".$row['bill_date']."</td>
				<td>".$row['buyer_name']."</td>
				<td>".$row['buyer_address']."</td>
				<td>".$row['buyer_gstin_no']."</td>
				<td>".$row['itemlist']."</td>
				<td>".$row['quantitylist']."</td>
				<td>".$row['ratelist']."</td>
				<td>".$row['perlist']."</td>
				<td>".$row['taxlist']."</td>
				<td>".$row['taxamount']."</td>
				<td>".$row['grandtotal']."</td>
			</tr>";
			$k++;
	}

	}}			echo "</table>";
}}}
$mysql->close();





			?>
	


<!-- FOOTER ROW--->
	<div class="row">
		<footer>Copyright &copy;
		ANNS
		</footer>
	</div>
	<!-- END OF FOOTER ROW----------->





		</div>


	</body>
</html>