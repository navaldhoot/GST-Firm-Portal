<?php 	include('database_info.php');
		include('dbname.php');
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
<?php

	
	
	$invoice_no=$_POST["invoice_no"];
	$bill_date=$_POST["bill_date"];
	$firm_delivery_note=$_POST["firm_delivery_note"];
	$mod_of_payment=$_POST["mod_of_payment"];
	$supplier_ref=$_POST["supplier_ref"];
	$other_ref=$_POST["other_ref"];
	$buyer_name=$_POST["buyer_name"];
	$buyer_address=$_POST["buyer_address"];
	$buyer_gstin_no=$_POST["buyer_gstin_no"];
	$buyer_order_no=$_POST["buyer_order_no"];
	$order_date=$_POST["order_date"];
	$despatch_document_no=$_POST["despatch_document_no"];
	$delivery_note_date=$_POST["delivery_note_date"];
	$despatched_through=$_POST["despatched_through"];
	$destination=$_POST["destination"];
	$terms_of_delivery=$_POST["terms_of_delivery"];

/*
	$_SESSION['invoice_no']=$invoice_no;
	$_SESSION['bill_date']=$bill_date;
	$_SESSION['firm_delivery_note']=$firm_delivery_note;
	$_SESSION['mod_of_payment']=$mod_of_payment;
	$_SESSION['supplier_ref']=$supplier_ref;
	$_SESSION['other_ref']=$other_ref;
	$_SESSION['buyer_name']=$buyer_name;
	$_SESSION['buyer_address']=$buyer_address;
	$_SESSION['buyer_gstin_no']=$buyer_gstin_no;
	$_SESSION['buyer_order_no']=$buyer_order_no;
	$_SESSION['order_date']=$order_date;
	$_SESSION['despatch_document_no']=$despatch_document_no;
	$_SESSION['delivery_note_date']=$delivery_note_date;
	$_SESSION['despatched_through']=$despatched_through;
	$_SESSION['destination']=$destination;
	$_SESSION['terms_of_delivery']=$terms_of_delivery;
	
	*/
	
	
	
	$cgst_total2=$cgst_total6=$cgst_total9=$cgst_total14=0;
	$grandtotal=0;
	$totalcgstamount=$totaltaxpayable=$totalquantity=0;
	
	$itemlist=$quantitylist=$ratelist=$perlist=$taxlist=$taxamount="";
	$NumRows=$_POST["NumRows"];
	$_SESSION['NumRows']=$NumRows;

	$i=1;
	while($i <= $NumRows)
	{
		
		
		${"item".$i}=$_POST["item".$i];
		${"quantity".$i}=$_POST["quantity".$i];
		${"rate".$i}=$_POST["rate".$i];
		${"per".$i}=$_POST["per".$i];

		$itemlist=$itemlist."".${"item".$i}."\n";
		$quantitylist=$quantitylist."".${"quantity".$i}."\n";
		$ratelist=$ratelist."".${"rate".$i}."\n";
		$perlist=$perlist."".${"per".$i}."\n";
		
		/*
		
		$_SESSION{"item".$i}=${"item".$i};
		$_SESSION{"quantity".$i}=${"quantity".$i};
		$_SESSION{"rate".$i}=${"rate".$i};
		$_SESSION{"per".$i}=${"per".$i};
	
*/
	
	
		$i=$i+1;	
	
	}
	
	
	
	$mysql = mysqli_connect("$dbservername", "$dbusername", "$dbpassword", "$dbname");

	if($mysql->connect_error)
	{
		echo "Not";
		die('Connection not established '. $mysql->connect_error());	
	}
	/*
	echo  " DATA IN Tables:";
	echo  "<table border='1'>
			<tr>
			<th>S.NO.</th>
			<th>Item Name</th>
			<th>Quantity</th>
			<th>Rate</th>
			<th>Unit</th>
			<th>Total</th>
			<th>HSN Code</th>
			<th>CGST</th>
			<th>CGST Amount</th>
			<th>SGST</th>
			<th>SGST Amount</th>
			<th>Total WITH TAX</th>
		</tr>";
	
	*/
	for($j=1;$j<=$NumRows;$j=$j+1)
	{	
		$sql="SELECT * from item_details where item_name='${"item".$j}'";

		$qry = mysqli_query($mysql,$sql);	

		while($row = mysqli_fetch_array($qry,MYSQLI_ASSOC))
		
		{

		
		
		
		
		
		
		
		${"total".$j}=${'quantity'.$j}*${'rate'.$j};
		${"sgst_amount".$j}= ($row["sgst"]*${"total".$j})/100;
		${"cgst_amount".$j}= ($row["cgst"]*${"total".$j})/100;
		${"totaltaxamount".$j}=${'total'.$j} + ${'sgst_amount'.$j} + ${'cgst_amount'.$j} ;
		$grandtotal = $grandtotal + ${"totaltaxamount".$j};
		$totaltaxpayable = $totaltaxpayable + (2*  ${'sgst_amount'.$j});	
		
		
		$taxlist=$taxlist."".$row["sgst"]."\n";
		$taxamount=$taxamount."".${"sgst_amount".$j}."\n";
		
		
		
		
		
		
		
		
		${"totaltaxitem".$j}= 2*  ${'sgst_amount'.$j};

		$totalcgstamount= $totalcgstamount + ${"cgst_amount".$j};
		$totalquantity = $totalquantity + ${"total".$j};
		
		
	/*	
		
		$_SESSION{"total".$j}=${"total".$j};
		$_SESSION{"sgst_amount".$j}=${"sgst_amount".$j};
		$_SESSION{"cgst_amount".$j}=${"cgst_amount".$j};
		$_SESSION{"totaltaxamount".$j}=${"totaltaxamount".$j};
		$_SESSION{"totaltaxitem".$j}=${"totaltaxitem".$j};
	
		
		
		*/
		
		
		if($row["cgst"]== "2.5%")
		{
				$cgst_total2= $cgst_total2 + ${"cgst_amount".$j};
		}
		if($row["cgst"]== "6%")
		{
				$cgst_total6= $cgst_total6 + ${"cgst_amount".$j};
		}
		if($row["cgst"]== "9%")
		{
				$cgst_total9= $cgst_total9 + ${"cgst_amount".$j};
		}
		if($row["cgst"]== "14%")
		{
				$cgst_total14= $cgst_total14 + ${"cgst_amount".$j};
		}
		
		
		${"hsn_code".$j}=$row["hsn_code"];
		${"cgst".$j}=$row["cgst"];
		
		/*$_SESSION{"hsn_code".$j}=${"hsn_code".$j};
		$_SESSION{"cgst".$j}=${"cgst".$j};
	
		*/
		/*
		echo "<tr>
				<td>".$j."</td>
				<td>".$row["item_name"]."</td>
				<td>".${'quantity'.$j}."</td>
				<td>".${'rate'.$j}."</td>
				<td>".${'per'.$j}."</td>
				<td>".${'total'.$j}."</td>
				<td>".$row["hsn_code"]."</td>
				<td>".$row["cgst"]."</td>
				<td>".${"sgst_amount".$j}."</td>
				<td>".$row["sgst"]."</td>
				<td>".${"sgst_amount".$j}."</td>
				<td>".${"totaltaxamount".$j}."</td>
			</tr>";*/
	}
}
/*			echo "</table>";
			
		
		
		echo "TAXABLE DETAILS";
		if($cgst_total2 != 0)
		{
			
			echo "<br>CGST   2.5%   =".$cgst_total2;
			echo "<br>SGST   2.5%   =".$cgst_total2;
		}
		if($cgst_total6 != 0)
		{
			
			echo "<br>CGST  6%   =  ".$cgst_total6;
			echo "<br>SGST  6%   =  ".$cgst_total6;
		}
		if($cgst_total9 != 0)
		{
			
			echo "<br>CGST  9%  =  ".$cgst_total9;
			echo "<br>SGST  9%  =  ".$cgst_total9;
		}
		if($cgst_total14 != 0)
		{
			
			echo "<br>CGST  14%  = ".$cgst_total14;
			echo "<br>SGST  14%  = ".$cgst_total14;
		}
*/		
$cash=(int)$grandtotal;  //take number wihout decimal
	$decpart = $grandtotal - $cash; //get decimal part of number

	if($decpart >= 0.50)
	{
		$roundoff= 	number_format((1 - $decpart),2);
		
		$grandtotal = ceil($grandtotal);
	}
	else
	{
		$roundoff = number_format((-$decpart),2);
		$grandtotal= floor($grandtotal);
	}





	
	/*	echo "<br>Round off =  ".$roundoff;
		echo "<br>GRAND TOTAL =  ".$grandtotal; 
		*/$wordsamount=ucwords(convert_digit_to_words($grandtotal));
		$taxamountwords=ucwords(convert_digit_to_words($totaltaxpayable));
	/*	echo "<br>".$wordsamount;
*/
		/*
		$_SESSION['wordsamount']=$wordsamount;
		$_SESSION['taxamountwords']=$taxamountwords;
		
		$_SESSION['cgst_total2']=$cgst_total2;
		$_SESSION['cgst_total6']=$cgst_total6;
		$_SESSION['cgst_total9']=$cgst_total9;
		$_SESSION['cgst_total14']=$cgst_total14;
		$_SESSION['roundoff']=$roundoff;	
		$_SESSION['grandtotal']=$grandtotal;

		$_SESSION['totalquantity']=$totalquantity;
		$_SESSION['totaltaxpayable']=$totaltaxpayable;
		$_SESSION['totalcgstamount']=$totalcgstamount;
	
	*/

		$sql1= "INSERT INTO bill_details( invoice_no, bill_date, buyer_name, buyer_address , buyer_gstin_no , itemlist, quantitylist,ratelist,perlist,taxlist,taxamount,grandtotal)
		VALUES ('$invoice_no', 'bill_date', '$buyer_name', '$buyer_address', '$buyer_gstin_no', '$itemlist', '$quantitylist', '$ratelist', '$perlist', '$taxlist', '$taxamount','$grandtotal')";



			
				
		$qry1 = mysqli_query($mysql,$sql1);	




	
			
			
			$mysql->close();

			
			
function convert_digit_to_words($no)  
	{   
	
	//creating array  of word for each digit
	 $words = array('0'=> 'Zero' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fourteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'forty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred','1000' => 'thousand','100000' => 'lac','10000000' => 'crore');
	 //$words = array('0'=> '0' ,'1'=> '1' ,'2'=> '2' ,'3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9','10' => '10','11' => '11','12' => '12','13' => '13','14' => '14','15' => '15','16' => '16','17' => '17','18' => '18','19' => '19','20' => '20','30' => '30','40' => '40','50' => '50','60' => '60','70' => '70','80' => '80','90' => '90','100' => '100','1000' => '1000','100000' => '100000','10000000' => '10000000');
	 
	 
	 //for decimal number taking decimal part
	$decimalstr='';
	 
	$cash=(int)$no;  //take number wihout decimal
/*	$decpart = $no - $cash; //get decimal part of number
	
	$decpart=sprintf("%01.2f",$decpart); //take only two digit after decimal
	
	$decpart1=substr($decpart,2,1); //take first digit after decimal
	$decpart2=substr($decpart,3,1);   //take second digit after decimal  
	
	$decimalstr='';
	
	//if given no. is decimal than  preparing string for decimal digit's word
	
	if($decpart>0)
	{
	 $decimalstr.="point ".$decpart1." ".$numbers[$decpart2];
	}
	*/ 
	    if($no == 0)
	        return ' ';
	    else {
	    $novalue='';
	    $highno=$no;
	    $remainno=0;
	    $value=100;
	    $value1=1000;       
	            while($no>=100)    {
	                if(($value <= $no) &&($no  < $value1))    {
	                $novalue=$words["$value"];
	                $highno = (int)($no/$value);
	                $remainno = $no % $value;
	                break;
	                }
	                $value= $value1;
	                $value1 = $value * 100;
	            }       
	          if(array_key_exists("$highno",$words))  //check if $high value is in $words array
	              return $words["$highno"]." ".$novalue." ".convert_digit_to_words($remainno).$decimalstr;  //recursion
	          else {
	             $unit=$highno%10;
	             $ten =(int)($highno/10)*10;
	             return $words["$ten"]." ".$words["$unit"]." ".$novalue." ".convert_digit_to_words($remainno
	             ).$decimalstr; //recursion
	           }
	    }
	}
			
			
			
			
			
			
			
/*
header('refresh:5;url=bill_format.php');	
*/	?>





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
					$firm_name=$row['firm_name'];
					echo "<b>".$row['firm_name']."</b><br>".$row['firm_address']."<br>".$row['firm_phone']."
						<br><b>GSTIN/UIN:   </b>".$row['firm_gstin_no'];
		
		
		
		
				
				
				}
				?>
<!--		Akash<b><br>
				1232<br>
				GSTIN/UIN: 23ASDFG1234S1ZX-->
				</td>
				
				<td colspan="3">Invoice No.<br>
				<?php echo $invoice_no;?>
				</td>
				
				<td colspan="2">Date<br>
				<?php echo $bill_date;?>
				</td>	
			</tr>
			<tr>
				<td colspan="3">Delivery Note<br>
				<?php echo $firm_delivery_note;?>
				</td>
				
				<td colspan="2">Mode/Terms of Payment
				<br>
				<?php echo $mod_of_payment;?>

				</td>	
			</tr>

			<tr>
				<td colspan="3">Supplier's Ref.<br>
				<?php echo $supplier_ref;?>
				</td>
				
				<td colspan="2">Other Reference(s)<br>
				<?php echo $other_ref;?>
				</td>
			</tr>
			
			<tr>
				<td rowspan="4" colspan="2" align="left" bgcolor="PAPAYAWHIP">
				<b>Buyer<b><br>
				<?php echo $buyer_name;?><br>
				<?php echo $buyer_address?><br>
				GSTIN No.- <?php echo $buyer_gstin_no;?>
				</td>
				
				<td colspan="3">Buyer's Order No.<br>
				<?php echo $buyer_order_no;?>
				</td>
				
				<td colspan="2">Order Date<br>
				<?php echo $order_date;?>
				</td>	
			</tr>
			<tr>
				<td colspan="3">Despatch Document No.<br>
				<?php echo $despatch_document_no;?>
				</td>
				
				<td colspan="2">Delivery Note Date<br>
				<?php echo $delivery_note_date;?>
				</td>	
			</tr>
			<tr>
				<td colspan="3">Despatched Through</br>
				<?php echo $despatched_through;?>
				</td>
				<td colspan="2">Destination<br>
				<?php echo $destination;?>
				</td>
			</tr>
			<tr>
				<td colspan="5">Terms of Delivery<br>
				<?php echo $terms_of_delivery;?>
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
		for($n=1;$n<=$NumRows;$n=$n+1)
		{
			echo "<tr>
				<td>".$n."</td>				
				<td>".${'item'.$n}."</td>
				<td>".${'hsn_code'.$n}."</td>
				<td>".${'quantity'.$n}."</td>
				<td>".${'rate'.$n}."</td>
				<td>".${'per'.$n}."</td>
				<td>".${'total'.$n}."</td>
			</tr>";
		
		
		}
		if( $cgst_total2 != 0)
		{
			
			echo "<tr>
					<td></td>
					<td align='right'>CGST</td>
					<td></td>
					<td></td>
					<td align='right'>2.5</td>
					<td>%</td>
					<td>".$cgst_total2."</td>
				</tr>";
			echo "<tr>
					<td></td>
					<td align='right'>SGST</td>
					<td></td>
					<td></td>
					<td align='right'>2.5</td>
					<td>%</td>
					<td>".$cgst_total2."</td>
				</tr>";
			
			
			
		}
		if($cgst_total6 != 0)
		{
			
			echo "<tr>
					<td></td>
					<td align='right'>CGST</td>
					<td></td>
					<td></td>
					<td align='right'>6</td>
					<td>%</td>
					<td>".$cgst_total6."</td>
				</tr>";
			echo '<tr>
					<td></td>
					<td align="right">SGST</td>
					<td></td>
					<td></td>
					<td align="right">6</td>
					<td>%</td>
					<td>'.$cgst_total6.'</td>
				</tr>';
			
			
		}
		if($cgst_total9 != 0)
		{
			
			echo '<tr>
					<td></td>
					<td align="right">CGST</td>
					<td></td>
					<td></td>
					<td align="right">9</td>
					<td>%</td>
					<td>'.$cgst_total9.'</td>
				</tr>';
			echo '<tr>
					<td></td>
					<td align="right">SGST</td>
					<td></td>
					<td></td>
					<td align="right">9</td>
					<td>%</td>
					<td>'.$cgst_total9.'</td>
				</tr>';
		}
		if($cgst_total14 != 0)
		{
			
			echo '<tr>
					<td></td>
					<td align="right">CGST</td>
					<td></td>
					<td></td>
					<td align="right">14</td>
					<td>%</td>
					<td>'.$cgst_total14.'</td>
				</tr>';
			echo '<tr>
					<td></td>
					<td align="right">SGST</td>
					<td></td>
					<td></td>
					<td align="right">14</td>
					<td>%</td>
					<td>'.$cgst_total14.'</td>
				</tr>';
		}
		if($roundoff != 0)
		{
			echo '<tr>
					<td></td>
					<td align="right">RoundOff</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>'.$roundoff.'</td>
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
				<?php echo $grandtotal;?>
				</td>
			</tr>
			<tr>
				<td colspan="7" bgcolor="LIGHTYELLOW">
				Amount Chargeable(in words)
				<br>
				<?php echo $wordsamount; ?>
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
					<td>'.${'hsn_code'.$k}.'</td>				
					<td align="right">'.${'total'.$k}.'</td>
					<td>'.${'cgst'.$k}.'</td>
					<td>'.${'cgst_amount'.$k}.'</td>
					<td>'.${'cgst'.$k}.'</td>
					<td>'.${'cgst_amount'.$k}.'</td>
					<td>'.${'totaltaxitem'.$k}.'</td>
			</tr>';
			}

			
			
			
			
			
			
		?>	
		
			
			<tr>
				<td align="right">Total</td>				
				
				<td align="right">
				 <?php echo $totalquantity;?>
				</td>
				
				<td></td>
				
				<td><?php echo $totalcgstamount;?>				</td>
				
				<td></td>
				
				<td>
				<?php echo $totalcgstamount;?>				</td>
				
				<td>
				<?php echo $totaltaxpayable;?>
				</td>
			</tr>
			<tr>
				<td colspan="7" bgcolor="LIGHTYELLOW">
					Tax Amount(in words):INR <?php echo $taxamountwords; ?><br><br><br>	
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
				For <?php echo $firm_name; ?>
				<br/><br/><br/>
				Authorised Signatory
					
				</td>
			</tr>
			</tr>
		</table>
			<div align="center">This is a Computer Generated Invoice</div>
	
	
	
	
	
	
	
	
		<a href="billpdf.php">Download</a>
	
	
	
	
	
	
	
	
	</body>
	
	
	
</html>	
