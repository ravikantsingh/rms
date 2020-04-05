<?php
set_time_limit (300);
include('../../../../inc/scripts/config.php');
include('../../../../inc/scripts/functions.php');

$college=college($dbh);
?>
<html>
	<head>
	<title><?php echo $college['name']." | Sitting Plan | ".$_POST['batch_name'];?> </title>
	<style type="text/css">
	    table { page-break-inside:auto }
	    tr    { page-break-inside:avoid; page-break-after:auto }
	    thead { display:table-header-group }
	    tfoot { display:table-footer-group }
	    @media all{@page {size: landscape}}
	</style>
	</head>
		<body>
		<div style="">
			<table width="100%" style="text-align:center;border-collapse: collapse; border: 1px solid #666; ">
							<tr style="font-size:25px; font-weight:bold;color: #fff;background-color: #000;height: 50px;">
								<td rowspan="3" style="background-color:#FFF; border-right: 1px solid #000;"><img src="<?php echo  $college['favicon'] ?>" width="80px" height="80px" style="border-radius: 50%;"></td>
								<td style="transform:scale(1.7);"><?php echo $college['name'].'<br /><!--<span style="font-size:14px;">'.$college['address'].'</span>'; ?>--></td>
							</tr>
							<tr>
								<td>Library Report 2019 - 2020</td>
							</tr>
							<tr style="font-size:24px; font-weight:bold;">
								<td>Subject Name: <?php echo $_POST['batch_name'];?> 1st Year</td>
							</tr>
						</table>
			<table border="1px" width="100%" style="text-align:center;border-collapse: collapse;">
				<tr>
					<th>S.No</th>
					<th>Ledger/Roll No</th>
					<th>Student's Name</th>
					<th>Father's Name</th>
					<th>Subject</th>
					<th>Choice1</th>
					<th>Choice2</th>
					<th>Choice3</th>
					<th>Address</th>
					<th>Photo</th>
					<th>Sign</th>
					<th>Transaction Details</th>
					<th>Signature</th>
				<tr>
			

<?php
$i=0;
$batch=$_POST['batch'];
$sql="SELECT * FROM `main` WHERE `batch`='$batch' AND `ledgerNumber`!='' ORDER BY `ledgerNumber` ASC";
$sqlCheck=$dbh->prepare($sql);
$runCheck=$sqlCheck->execute();
$res=$sqlCheck->fetchAll();
foreach( $res as $row ) 
	{	
		$i++;$colr='';$choice1='';$choice2='';$choice3='';
		if($batch=='1'||$batch=='2'||$batch=='3'||$batch=='4')
		{
		   $sql11="SELECT * FROM `stream".$batch."` WHERE `roll_number`= ? ";
		   $sqlCheck1=$dbh->prepare($sql11);
		   $runCheck1=$sqlCheck1->execute(array($row['rollNumber']));
		   $row_batch1=$sqlCheck1->fetch();
			{
				$choice1=$row_batch1['choice1'];
				$choice2=$row_batch1['choice2'];
				$choice3=$row_batch1['choice3'];
			}
		   $sql2="SELECT * FROM `transaction` WHERE `enrollment`= ? AND `amount`>'300' AND `status`='TXN_SUCCESS'";
		   $sqlCheck2=$dbh->prepare($sql2);
		   $runCheck2=$sqlCheck2->execute(array($row['enrollment']));
		   $row_batch2=$sqlCheck2->fetch();
			{
				$amount=$row_batch2['amount'];
				$date=$row_batch2['date'];
				$txnid=$row_batch2['txnid'];
			}
		}
		echo "<tr>";
		echo '<td>'.$i.'</td><td><b>'.$row['ledgerNumber'].'<br/>'.$row['rollNumber'].'</b></td><td>'.$row['sname'].'</td><td>'.$row['fname'].'</td><td>'.$_POST['batch_name'].'</td><td>'.$choice1.'</td><td>'.$choice2.'</td><td>'.$choice3.'</td><td>'.$row['add'].' Dist: '.$row['distt'].' State: '.$row['state'].' Pin:'.$row['pin'].'</td><td><img width="100px" height="100px" src="../../../../userHome/img/photo/'.$row['photo_id'].'"><!--<br /><a href="../../../../userHome/img/photo/'.$row['photo_id'].'" download="p_'.$row['rollNumber'].'.jpg">Download Photo</a>--></td><td><img width="140px" height="50px" src="../../../../userHome/img/sign/'.$row['sign_id'].'"><!--<br /><a href="../../../../userHome/img/sign/'.$row['sign_id'].'" download="s_'.$row['rollNumber'].'.jpg">Download Sign</a>--></td><td>'.$txnid.'<br/>'.$amount.'<br/>'.$date.'</td><td width="140px" height="50px"></td>';
		echo "</tr>";
		if(($i%7)==0)
		{
		    echo '</table><table width="100%" style="text-align:center;border-collapse: collapse; margin-top:5px; border:1px solid #666;page-break-before: always;">
							<tr style="font-size:25px; font-weight:bold;color: #fff;background-color: #000;height: 50px;">
								<td rowspan="3" style="background-color:#FFF; border-right:1px solid #000;"><img src="'.$college['favicon'].'" width="80px" height="80px" style="border-radius:50%;"></td>
								<td style="transform:scale(1.7);">'.$college['name'].'<br /></td>
							</tr>
							<tr>
								<td>Library Report 2019 - 2020</td>
							</tr>
							<tr style="font-size:24px; font-weight:bold;">
								<td>Subject Name: '.$_POST['batch_name'].' 1st Year</td>
							</tr>
						</table>
						<table border="1px" width="100%" style="text-align:center;border-collapse: collapse;">
				<tr>
					<th>S.No</th>
					<th>Ledger/Roll No</th>
					<th>Student\'s Name</th>
					<th>Father\'s Name</th>
					<th>Subject</th>
					<th>Choice1</th>
					<th>Choice2</th>
					<th>Choice3</th>
					<th>Address</th>
					<th>Photo</th>
					<th>Sign</th>
					<th>Transaction Details</th>
					<th>Signature</th>
				<tr>';
		}
	}
?>
			</table>
			</div>
		</body>
</html>