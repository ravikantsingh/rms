<?php
set_time_limit (300);
include('../../../../inc/scripts/config.php');
include('../../../../inc/scripts/functions.php');

$college=college($dbh);
if($_POST['batch']<='6')
$year='1st Year';
else
$year='1st Semester';
?>
<html>
	<head>
	<title><?php echo $college['name']." | Voter List | ".$_POST['batch_name'];?> </title>
	<style type="text/css">
	    table { page-break-inside:auto }
	    tr    { page-break-inside:avoid; page-break-after:auto }
	    thead { display:table-header-group }
	    tfoot { display:table-footer-group }
	    }
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
								<td>Voter List 2019 - 2020</td>
							</tr>
							<tr style="font-size:24px; font-weight:bold;">
								<td>Subject Name: <?php echo $_POST['batch_name'].' '.$year;?></td>
							</tr>
						</table>
			<table border="1px" width="100%" style="text-align:center;border-collapse: collapse;">
				<tr>
					<th>S.No</th>
					<th>Ledger Number</th>
					<th>Student's Name</th>
					<th>Father's Name</th>
					<th>Address</th>
					<th>Photo</th>
					<th>Sign</th>
					<th>Signature</th>
				<tr>


<?php
$i=0;
$batch=$_POST['batch'];
$sql="SELECT * FROM `main` WHERE `batch`='$batch' AND `ledgerNumber`!='' AND `status`!='x' ORDER BY `ledgerNumber` ASC";
$sqlCheck=$dbh->prepare($sql);
$runCheck=$sqlCheck->execute();
$res=$sqlCheck->fetchAll();
foreach( $res as $row )
	{
		$i++;$colr='';

		echo "<tr>";
		echo '<td>'.$i.'</td><td><b>'.$row['ledgerNumber'].'</b></td><td>'.$row['sname'].'</td><td>'.$row['fname'].'</td><td>'.$row['add'].' Dist: '.$row['distt'].' State: '.$row['state'].' Pin:'.$row['pin'].'</td><td><img width="100px" height="100px" src="../../../../userHome/img/photo/'.$row['photo_id'].'"></td><td><img width="140px" height="50px" src="../../../../userHome/img/sign/'.$row['sign_id'].'"></td><td width="140px" height="50px"></td>';
		echo "</tr>";
		if(($i%7)==0)
		{
		    echo '</table><table width="100%" style="text-align:center;border-collapse: collapse; margin-top:5px; border:1px solid #666;page-break-before: always;">
							<tr style="font-size:25px; font-weight:bold;color: #fff;background-color: #000;height: 50px;">
								<td rowspan="3" style="background-color:#FFF; border-right:1px solid #000;"><img src="'.$college['favicon'].'" width="80px" height="80px" style="border-radius:50%;"></td>
								<td style="transform:scale(1.7);">'.$college['name'].'<br /></td>
							</tr>
							<tr>
								<td>Voter List 2019 - 2020</td>
							</tr>
							<tr style="font-size:24px; font-weight:bold;">
								<td>Subject Name: '.$_POST['batch_name'].' '.$year.'</td>
							</tr>
						</table>
						<table border="1px" width="100%" style="text-align:center;border-collapse: collapse;">
				<tr>
					<th>S.No</th>
					<th>Ledger Number</th>
					<th>Student\'s Name</th>
					<th>Father\'s Name</th>
					<th>Address</th>
					<th>Photo</th>
					<th>Sign</th>
					<th>Signature</th>
				<tr>';
		}
	}
?>
			</table>
			</div>
		</body>
</html>
