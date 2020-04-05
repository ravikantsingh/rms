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
	</style>
	</head>
		<body>
		<div style="width:750px;">
			<table width="100%" style="text-align:center;border-collapse: collapse; border: 1px solid #666;">
							<tr style="font-size:25px; font-weight:bold;color: #fff;background-color: #000;height: 50px;">
								<td rowspan="3" style="background-color:#FFF; border-right: 1px solid #000;"><img src="<?php echo  $college['favicon'] ?>" width="80px" height="80px" style="border-radius: 50%;"></td>
								<td style="transform:scale(1.7);"><?php echo $college['name'].'<br /><!--<span style="font-size:14px;">'.$college['address'].'</span>'; ?>--></td>
							</tr>
							<tr>
								<td>Entrance Exam 2018 - 2019</td>
							</tr>
							<tr style="font-size:24px; font-weight:bold;">
								<td>Subject Name: <?php echo $_POST['batch_name'];?></td>
							</tr>
						</table>
			<table border="1px" width="100%" style="text-align:center;border-collapse: collapse;">
				<tr>
					<th>S.No</th>
					<th>Roll Number</th>
					<th>Name</th>
					<th>Subject</th>
					<th>Photo</th>
					<th>Sign</th>
					<th>Attendance</th>
				<tr>


<?php
$i=0;
$batch=$_POST['batch'];
$sql="SELECT * FROM `main` WHERE `batch`='$batch' AND `status`>='7' ORDER BY `rollNumber` ASC";
$sqlCheck=$dbh->prepare($sql);
$runCheck=$sqlCheck->execute();
$res=$sqlCheck->fetchAll();
foreach( $res as $row )
	{
		$i++;$colr='';

		echo "<tr>";
		echo '<td>'.$i.'</td><td>'.$row['rollNumber'].'</td><td>'.$row['sname'].'</td><td>'.$_POST['batch_name'].'</td><td><img width="100px" height="100px" src="../../../../userHome/img/photo/'.$row['photo_id'].'"><!--<br /><a href="../../../../userHome/img/photo/'.$row['photo_id'].'" download="p_'.$row['rollNumber'].'.jpg">Download Photo</a>--></td><td><img width="140px" height="50px" src="../../../../userHome/img/sign/'.$row['sign_id'].'"><!--<br /><a href="../../../../userHome/img/sign/'.$row['sign_id'].'" download="s_'.$row['rollNumber'].'.jpg">Download Sign</a>--></td><td width="140px" height="50px"></td>';
		echo "</tr>";
		if(($i%9)==0)
		{
		    echo '</table><table width="100%" style="text-align:center;border-collapse: collapse; margin-top:5px; border:1px solid #666;page-break-before: always;">
							<tr style="font-size:25px; font-weight:bold;color: #fff;background-color: #000;height: 50px;">
								<td rowspan="3" style="background-color:#FFF; border-right:1px solid #000;"><img src="'.$college['favicon'].'" width="80px" height="80px" style="border-radius:50%;"></td>
								<td style="transform:scale(1.7);">'.$college['name'].'<br /></td>
							</tr>
							<tr>
								<td>Entrance Exam 2018 - 2019</td>
							</tr>
							<tr style="font-size:24px; font-weight:bold;">
								<td>Subject Name: '.$_POST['batch_name'].'</td>
							</tr>
						</table>
						<table border="1px" width="100%" style="text-align:center;border-collapse: collapse;">
				<tr>
					<th>S.No</th>
					<th>Roll Number</th>
					<th>Name</th>
					<th>Subject</th>
					<th>Photo</th>
					<th>Sign</th>
					<th>Attendance</th>
				<tr>';
		}
	}
?>
			</table>
			</div>
		</body>
</html>
