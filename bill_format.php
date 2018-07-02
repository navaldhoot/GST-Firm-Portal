<?php 	
	session_name('bill');
	session_start();

	include('dbname.php');
	include('database_info.php');
	?>
	
	
<!DOCTYPE html>
	<head>
		<title>Bill generation</title>
		<style>
			table, th, td {
    				border: 1px solid black;
    				border-collapse: collapse;
				}
			table.A{
				background-color:#ccccff;
				}
			body{
				background-color:"WHITE";
				}
		</style>
	</head>
	<body>
			<div align="center"><b>Bill</b></div>



			<table class="A"align="center" border="1" style="width:100%; border-collapse:collapse;">
			<tr>
				<td rowspan="3"  colspan="2" align="left" bgcolor="KHAKI">
				
				<?php 
				
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
					echo "<b>".$row['firm_name']."</b><br>".$row['firm_address']."<br>".$row['firm_phone']."
						<br><b>GSTIN/UIN:   </b>".row['firm_gstin_no'];
		
		
		
		
				
				
				}
				?>
<!---				Akash<b><br>
				1232<br>
				GSTIN/UIN: 23ASDFG1234S1ZX-->
				</td>
				
				<td colspan="3">Invoice No.<br>
				<?php echo $_SESSION["invoice_no"];?>
				</td>
				
				<td colspan="2">Date<br>
				<?php echo $_SESSION["bill_date"];?>
				</td>	
			</tr>
			<tr>
				<td colspan="3">Delivery Note<br>
				<?php echo $_SESSION["firm_delivery_note"];?>
				</td>
				
				<td colspan="2">Mode/Terms of Payment
				<br>
				<?php echo $_SESSION["mod_of_payment"];?>

				</td>	
			</tr>

			<tr>
				<td colspan="3">Supplier's Ref.<br>
				<?php echo $_SESSION["supplier_ref"];?>
				</td>
				
				<td colspan="2">Other Reference(s)<br>
				<?php echo $_SESSION["other_ref"];?>
				</td>
			</tr>
			
			<tr>
				<td rowspan="4" colspan="2" align="left" bgcolor="PAPAYAWHIP">
				<b>Buyer<b><br>
				<?php echo $_SESSION["buyer_name"];?><br>
				<?php echo $_SESSION["buyer_address"];?><br>
				GSTIN No.- <?php echo $_SESSION["buyer_gstin_no"];?>
				</td>
				
				<td colspan="3">Buyer's Order No.<br>
				<?php echo $_SESSION["buyer_order_no"];?>
				</td>
				
				<td colspan="2">Order Date<br>
				<?php echo $_SESSION["order_date"];?>
				</td>	
			</tr>
			<tr>
				<td colspan="3">Despatch Document No.<br>
				<?php echo $_SESSION["despatch_document_no"];?>
				</td>
				
				<td colspan="2">Delivery Note Date<br>
				<?php echo $_SESSION["delivery_note_date"];?>
				</td>	
			</tr>
			<tr>
				<td colspan="3">Despatched Through</br>
				<?php echo $_SESSION["despatched_through"];?>
				</td>
				<td colspan="2">Destination<br>
				<?php echo $_SESSION["destination"];?>
				</td>
			</tr>
			<tr>
				<td colspan="5">Terms of Delivery<br>
				<?php echo $_SESSION["terms_of_delivery"];?>
				</td>
			</tr>
			<tr>
				<td>S.No.</td>				
				<td>Description of Goods</td>
				<td>HSN/SAC</td>
				<td>Quantity</td>
				<td>Rate</td>
				<td>per</td>
				<td>Amount</td>
			</tr>
			
			
		<?php
		$NumRows=$_SESSION["NumRows"];
		for($n=1;$n<=$NumRows;$n=$n+1)
		{
			echo "<tr>
				<td>".$n."</td>				
				<td>".$_SESSION{'item'.$n}."</td>
				<td>".$_SESSION{'hsn_code'.$n}."</td>
				<td>".$_SESSION{'quantity'.$n}."</td>
				<td>".$_SESSION{'rate'.$n}."</td>
				<td>".$_SESSION{'per'.$n}."</td>
				<td>".$_SESSION{'total'.$n}."</td>
			</tr>";
		
		
		}
		if($_SESSION['cgst_total2'] != 0)
		{
			
			echo "<tr>
					<td></td>
					<td align='right'>CGST</td>
					<td></td>
					<td></td>
					<td align='right'>2.5</td>
					<td>%</td>
					<td>".$_SESSION['cgst_total2']."</td>
				</tr>";
			echo "<tr>
					<td></td>
					<td align='right'>SGST</td>
					<td></td>
					<td></td>
					<td align='right'>2.5</td>
					<td>%</td>
					<td>".$_SESSION['cgst_total2']."</td>
				</tr>";
			
			
			
		}
		if($_SESSION['cgst_total6'] != 0)
		{
			
			echo "<tr>
					<td></td>
					<td align='right'>CGST</td>
					<td></td>
					<td></td>
					<td align='right'>6</td>
					<td>%</td>
					<td>".$_SESSION['cgst_total6']."</td>
				</tr>";
			echo '<tr>
					<td></td>
					<td align="right">SGST</td>
					<td></td>
					<td></td>
					<td align="right">6</td>
					<td>%</td>
					<td>'.$_SESSION['cgst_total6'].'</td>
				</tr>';
			
			
		}
		if($_SESSION['cgst_total9'] != 0)
		{
			
			echo '<tr>
					<td></td>
					<td align="right">CGST</td>
					<td></td>
					<td></td>
					<td align="right">9</td>
					<td>%</td>
					<td>'.$_SESSION['cgst_total9'].'</td>
				</tr>';
			echo '<tr>
					<td></td>
					<td align="right">SGST</td>
					<td></td>
					<td></td>
					<td align="right">9</td>
					<td>%</td>
					<td>'.$_SESSION['cgst_total9'].'</td>
				</tr>';
		}
		if($_SESSION['cgst_total14'] != 0)
		{
			
			echo '<tr>
					<td></td>
					<td align="right">CGST</td>
					<td></td>
					<td></td>
					<td align="right">14</td>
					<td>%</td>
					<td>'.$_SESSION['cgst_total14'].'</td>
				</tr>';
			echo '<tr>
					<td></td>
					<td align="right">SGST</td>
					<td></td>
					<td></td>
					<td align="right">14</td>
					<td>%</td>
					<td>'.$_SESSION['cgst_total14'].'</td>
				</tr>';
		}
		if($_SESSION['roundoff'] != 0)
		{
			echo '<tr>
					<td></td>
					<td align="right">RoundOff</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>'.$_SESSION['roundoff'].'</td>
				</tr>';
		}


		
		
		?>	
		
		
			
			
			<tr>
				<td></td>				
				<td align="right">
				Total
				</td>
				<td></td>
				<td>
				
				</td>
				
				<td></td>
				<td></td>
				
				<td>
				<?php echo $_SESSION["grandtotal"];?>
				</td>
			</tr>
			<tr>
				<td colspan="7" bgcolor="LIGHTYELLOW">
				Amount Chargeable(in words)
				<br>
				<?php echo $_SESSION["wordsamount"]; ?>
				</td>
			</tr>
			<tr>
				<td rowspan="2">
				HSN/SAC
				</td>				
				<td rowspan="2">
				Taxable Value
				</td>
				<td colspan="2" align="center">
				Central Tax
				</td>
				<td colspan="2" align="center">
				State Tax
				</td>
				<td>
				Total Tax Amount
				</td>
			</tr>
			<tr>
				<td align="center">Rate</td>				
				<td align="center">Amount</td>
				<td align="center">Rate</td>				
				<td align="center">Amount</td>
			</tr>
			
		<?php 
			for($k=1;$k<=$NumRows;$k=$k+1)
			{	
			echo	'<tr>
					<td>'.$_SESSION{'hsn_code'.$k}.'</td>				
					<td align="right">'.$_SESSION{'total'.$k}.'</td>
					<td>'.$_SESSION{'cgst'.$k}.'</td>
					<td>'.$_SESSION{'cgst_amount'.$k}.'</td>
					<td>'.$_SESSION{'cgst'.$k}.'</td>
					<td>'.$_SESSION{'cgst_amount'.$k}.'</td>
					<td>'.$_SESSION{'totaltaxitem'.$k}.'</td>
			</tr>';
			}

			
			
			
			
			
			
		?>	
		
			
			<tr>
				<td align="right">Total</td>				
				
				<td align="right">
				 <?php echo $_SESSION["totalquantity"];?>
				</td>
				
				<td></td>
				
				<td><?php echo $_SESSION["totalcgstamount"];?>				</td>
				
				<td></td>
				
				<td>
				<?php echo $_SESSION["totalcgstamount"];?>				</td>
				
				<td>
				<?php echo $_SESSION["totaltaxpayable"];?>
				</td>
			</tr>
			<tr>
				<td colspan="7" bgcolor="LIGHTYELLOW">
					Tax Amount(in words):INR <?php echo $_SESSION["taxamountwords"]; ?><br><br><br>	
				</td>
			</tr/>	
			 <tr>   
				<td colspan="5">                
					Company's GSTIN No.:
					GSTIBSGAKSK123
				</br>
					We declare that this invoice shows the actual price of the</br> goods described and that all particulars are true and</br> correct.
				</td>
				<td colspan="2" align="right" bgcolor="LIGHTYELLOW">
				For Mukesh
				<br/><br/><br/>
				Authorised Signatory
					
				</td>
			</tr>
			</tr>
		</table>
			<div align="center">This is a Computer Generated Invoice</div>
	</body>
	
	
	
	<?php 
	session_name('bill');
	session_unset();?>
</html>
