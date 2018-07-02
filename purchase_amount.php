<?php include('database_info.php');
		include('dbname.php');
	$supplier_invoice_no=$_POST["supplier_invoice_no"];
	$party_account_name=$_POST["party_account_name"];
	$party_GSTIN=$_POST["party_GSTIN"];
	$date=$_POST["date"];
	$total=$total_with_tax=0;
	
	$NumRows=$_POST["NumRows"];
	$grandtotal=$grandtotaltax=$itemlist=$itemrate=$itemquantity=$itemigst="";
	$i=1;
	while($i <= $NumRows)
	{
		
		
		${"item_name".$i}=$_POST["item_name".$i];
		${"quantity".$i}=$_POST["quantity".$i];
		${"rate".$i}=$_POST["rate".$i];
		${"igst".$i}=$_POST["igst".$i];

		
		$itemlist=$itemlist."".${"item_name".$i}."\n";
		$itemrate=$itemrate."".${"rate".$i}."\n";
		$itemquantity=$itemquantity."".${"quantity".$i}."\n";
		$itemigst=$itemigst."".${"igst".$i}."\n";
		$i=$i+1;	
	
	}

	
	$mysql = mysqli_connect("$dbservername", "$dbusername", "$dbpassword", "$dbname");
if($mysql->connect_error)
{
	echo "Not";
	die('Connection not established '. $mysql->connect_error());	
}
echo  " DATA IN Tables:";
	echo  "<table border='1' width='100%'>
			<tr>
			<th>supplier invoice no</th>
			<th>party account name</th>
			<th>party GSTIN</th>
			<th>date</th>
			<th>item name</th>
			<th>quantity</th>
			<th>rate</th>
			<th>igst</th>
			<th>total</th>
			<th>total with tax</th>
		</tr>";
	
	
	for($j=1;$j<=$NumRows;$j=$j+1)
	{	
		${"total".$j}=${'quantity'.$j}*${'rate'.$j};
		$_SESSION{"total".$j}=${"total".$j};
		${"total_with_tax".$j}=${"total".$j} + (${"igst".$j}*${"total".$j})/100;
		$_SESSION{"total_with_tax".$j}=${"total_with_tax".$j};
	$grandtotal = $grandtotal + ${"total".$j};
		$_SESSION{"grandtotal"}=${"grandtotal"};
		$grandtotaltax = $grandtotaltax + ${'total_with_tax'.$j};	
		$_SESSION{"grandtotaltax"}=${"grandtotaltax"};
		echo "<tr>
				<td>".${'supplier_invoice_no'}."</td>
				<td>".${'party_account_name'}."</td>
				<td>".${'party_GSTIN'}."</td>
				<td>".${'date'}."</td>
				<td>".${"item_name".$j}."</td>
				<td>".${'quantity'.$j}."</td>
				<td>".${'rate'.$j}."</td>
				<td>".${'igst'.$j}."</td>
				<td>".${'total'.$j}."</td>
				<td>".${'total_with_tax'.$j}."</td>
			</tr>";
	}

			echo "</table>";
			
	echo "Grand Total=".$grandtotal."\n";
	echo "Grand Total with Tax=".$grandtotaltax;
	
	
	
		
	$sql= "INSERT INTO purchase_details(supplier_invoice_no,party_account_name,party_GSTIN,date,item_name,quantity,rate,igst,total,total_with_tax) VALUES ('$supplier_invoice_no','$party_account_name','$party_GSTIN','$date','$itemlist','$itemquantity','$itemrate','$itemigst','$grandtotal','$grandtotaltax')";
if($mysql->query($sql)  ===  TRUE)
{
	echo "<h3>Data entered successfully</h3><br/><br/>";
	echo "<h1>Thank You!</h1><br/>";
	echo "You will be redirected in 5 seconds!";
	header('refresh:0;url=purchase.html');	
}
else
{
echo "Error:". $sql ."<br/>". $mysql->error;
}
$mysql->close();
header('refresh:5;url=purchase.html');	
?>
	
		