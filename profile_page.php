<?php include('database_info.php');
		include('dbname.php');

		$mysql = mysqli_connect("$dbservername", "$dbusername", "$dbpassword", "$dbname");
if($mysql->connect_error)
{
	echo "Not";
	die('Connection not established '. $mysql->connect_error());	
}
$sql="SELECT * from profile_info";

		$qry = mysqli_query($mysql,$sql);	

		while($row = mysqli_fetch_array($qry,MYSQLI_ASSOC))
		{

			$name=$row['name'];
			$email=$row['email'];
			$phone=$row['phone'];
			$address=$row['address'];
			$firm_name=$row['firm_name'];
			$firm_email=$row['firm_email'];
			$firm_address=$row['firm_address'];
			$firm_phone=$row['firm_phone'];
			$firm_gstin_no=$row['firm_gstin_no'];
			$area_of_business=$row['area_of_business'];
			$items_sold=$row['items_sold'];
			$business_turnover=$row['business_turnover'];
		}
		
		
		
		
		$mysql->close();
		
		
		
		
		
	
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" href="favicongst.ico" />

  <title>Profile</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
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
  

  .jumbotron {
      background-color: black;
      color: #fff;
      padding: 5px 5px;
	  margin-bottom: 0px;
  }
  .container-fluid {
      padding: 0px 0px;
  }
  .bg-grey {
      background-color: #f6f6f6;
  }
  .navbar-nav
  {
	 color: white;
	 }
  @media screen and (max-width: 768px) {
    .col-sm-4 {
      text-align: center;
      margin: 25px 0;
    }
  }
  .row
  {
	padding-left: 50px;
	}
  .extra{
   padding-left:50px;
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
				<h3>Mission, Vision & Values</h3>
			</div>
		</div>			

	<!---------------------MENU ------------------------->
	<div class="row login-menu">
	
	<div class="col-md-12 menu-center">

		<ul>
				<li><a href="login_homepage.html">Home</a></li>
				<li><a href="#">Profile</a></li>
				<li><a href="item.html">Products</a></li>
				<li><a href="purchase.html">Purchases</a></li>
				<li><a href="bill.html">Bill Generation</a></li>
				<li><a href="table.php">Table Representation</a></li>
				<li><a href="bank.html">Bank Details</a></li>
   			<li class="logout"><a href="logout.php"><span class="glyphicon glyphicon-user"></span> Logout</a></li>
			<ul>
    
	</div>
	</div>
	
	
	
	<h1>Personal Info</h1>
	<div class="row">
		<div class="col-md-4">
		<b> Name:</b>
		</div>
		<div class="col-md-8">
		<?php echo $name;?>
		</div>
	</div>

	<div class="row">
		<div class="col-md-4">
		<b> Address:</b>
		</div>
		<div class="col-md-8">
		<?php echo $address;?>
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-md-4">
		<b>Phone no.:</b>
		</div>
		<div class="col-md-8">
		<?php echo $phone;?>
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-md-4">
		<b>Email id:</b>
		</div>
		<div class="col-md-8">
		<?php echo $email;?>
		</div>
	</div>


<h3>Firm details</h3>

	<div class="row">
		<div class="col-md-4">
		<b>Firm name:</b>
		</div>
		<div class="col-md-8">
		<?php echo $firm_name;?>
		</div>
	</div>
	
	
	<div class="row">
		<div class="col-md-4">
		<p><strong>Address:</strong></p>
		</div>
		<div class="col-md-8">
			<?php echo $firm_address;?>
	</div>
	</div>
	
	<div class="row">
		<div class="col-md-4">
		<b>Firm Email:</b>
		</div>
		<div class="col-md-8">
			<?php echo $firm_email;?>
	</div>
	</div>
	
	<div class="row">
		<div class="col-md-4">
		<b>Firm Phone:</b>
		</div>
		<div class="col-md-8">
			<?php echo $firm_phone;?>
	</div>
	</div>
	
	
	<div class="row">
		<div class="col-md-4">
		<b>Firm GSTIN no.:</b>
		</div>
		<div class="col-md-8">
			<?php echo $firm_gstin_no;?>
		</div>
	</div>
	</br>
	
	<div class="row">
		<div class="col-md-4">
		<b>Area Of Business</b>
		</div>
		<div class="col-md-8">
			<?php echo $area_of_business;?>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-4">
		<b>Business Turnover</b>
		</div>
		<div class="col-md-8">
			<?php echo $business_turnover;?>
		</div>
	</div>
	
	
	
	</br>
	
	<!--
	<h3>Banking Details</h3>
	<div class="row">
		<div class="col-md-4">
		<b>Bank User Name:</b>
		</div>
		<div class="col-md-8">
			<input type="text"/>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-4">
		<b>Firm name:</b>
		</div>
		<div class="col-md-8">
			<input type="text"/>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-4">
		<b>Bank Name:</b>
		</div>
		<div class="col-md-8">
			<input type="text"/>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-4">
		<b>Firm name:</b>
		</div>
		<div class="col-md-8">
			<input type="text"/>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-4">
		<b>Branch Name:</b>
		</div>
		<div class="col-md-8">
			<input type="text"/>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-4">
		<b>Account no.::</b>
		</div>
		<div class="col-md-8">
			<input type="text"/>
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-4">
		<b>Ifsc code:</b>
		</div>
		<div class="col-md-8">
			<input type="text"/>
		</div>
	</div>
	</br>
	
	
</div>

<input type="submit" value="Submit">
</form>
	-->
		
		<!-- FOOTER ROW--->
	<div class="row">
		<footer>Copyright &copy;
		ANNS
		</footer>
	</div>
	<!-- END OF FOOTER ROW----------->

</body>
</html>



