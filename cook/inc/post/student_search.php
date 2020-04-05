<?php
include('../../../../inc/scripts/config.php');
include('../../../../inc/scripts/functions.php');
$field=$_POST['field'];
$val=$_POST['val'].'%';
//$field='sname';
//$val='josep%';
$msg='';
if($field=='sname')
$sql="SELECT * FROM `main` WHERE `sname` LIKE ? ";
else if($field=='mobile')
$sql="SELECT * FROM `main` WHERE `mobile` LIKE ? ";
else if($field=='email')
$sql="SELECT * FROM `main` WHERE `email` LIKE ? ";
else if($field=='fname')
$sql="SELECT * FROM `main` WHERE `fname` LIKE ? ";
else if($field=='enrollment')
$sql="SELECT * FROM `main` WHERE `enrollment` LIKE ? ";
else if($field=='rollNumber')
$sql="SELECT * FROM `main` WHERE `rollNumber` LIKE ? ";
	$sqlCheck=$dbh->prepare($sql);
		$runCheck=$sqlCheck->execute(array($val));
		$res=$sqlCheck->fetchAll();
foreach( $res as $row )
			{
				$enrollment=$row['enrollment'];
			 $status = returnstatusArray();
			 $status = $status[$row['status']];
		  $batch_name=batchIdToName( $dbh, $row['batch']);
			$course_name=streamName( $row['courseID']);

		 $sqlCheck=$dbh->prepare("SELECT * FROM `q_details` WHERE `enrollment`=? AND `level`='HIGH SCHOOL'");
		 $runCheck=$sqlCheck->execute(array($enrollment));
		 $rowh=$sqlCheck->fetch();

			{
				$h_board=$rowh['board'];
				$h_roll_no=$rowh['roll_no'];
				$h_pass_year=$rowh['pass_year'];
				$h_mark_m=$rowh['mark_m'];
				$h_mark_o=$rowh['mark_o'];
			}
		 $sqlCheck=$dbh->prepare("SELECT * FROM `q_details` WHERE `enrollment`=? AND `level`='Intermediate'");
		 $runCheck=$sqlCheck->execute(array($enrollment));
		 $rowi=$sqlCheck->fetch();
		{
				$sqlCheck=$dbh->prepare("SELECT * FROM `inter_subject_group` WHERE `id`= ? ");
				 $runCheck=$sqlCheck->execute(array($rowi['type']));
				 $row_hig=$sqlCheck->fetch();

					{
						$i_type=$row_hig['subject_group'];

					}
				$i_board=$rowi['board'];
				$i_roll_no=$rowi['roll_no'];
				$i_pass_year=$rowi['pass_year'];
				$i_mark_m=$rowi['mark_m'];
				$i_mark_o=$rowi['mark_o'];
			}
		$sqlCheck=$dbh->prepare("SELECT * FROM `q_details` WHERE `enrollment`=? AND `level`='Graduation'");
		 $runCheck=$sqlCheck->execute(array($enrollment));
		 $rowgr=$sqlCheck->fetch();
		{
				$sqlCheck=$dbh->prepare("SELECT * FROM `ug_subject_group` WHERE `id`= ? ");
				 $runCheck=$sqlCheck->execute(array($rowgr['type']));
				 $row_gra=$sqlCheck->fetch();

					{
						$g_type=$row_gra['subject_group'];

					}

				$g_board=$rowgr['board'];
				$g_roll_no=$rowgr['roll_no'];
				$g_pass_year=$rowgr['pass_year'];
				$g_mark_m=$rowgr['mark_m'];
				$g_mark_o=$rowgr['mark_o'];
			}
		$sqlCheck=$dbh->prepare("SELECT * FROM `w_details` WHERE `enrollment`=?");
			 $runCheck=$sqlCheck->execute(array($enrollment));
			 $roww=$sqlCheck->fetch();
			{
				$sqlCheck=$dbh->prepare("SELECT * FROM `weitage_type` WHERE `weitage_id`= ? ");
				 $runCheck=$sqlCheck->execute(array($roww['catA']));
				 $row_cata=$sqlCheck->fetch();

					{
						$w_catA=$row_cata['weitage_name'];

					}
				$sqlCheck=$dbh->prepare("SELECT * FROM `weitage_type` WHERE `weitage_id`= ? ");
				 $runCheck=$sqlCheck->execute(array($roww['catB']));
				 $row_catb=$sqlCheck->fetch();

					{
						$w_catB=$row_catb['weitage_name'];

					}

				$w_smmClg=$roww['smmClg'];
				$w_ff=$roww['ff'];
				$w_ph=$roww['ph'];
				$w_ph_per=$roww['ph_per'];
				$w_domicile=$roww['domicile'];
				$w_s_id=$roww['s_id'];
			}
				$msg.='
                                                <tr class="tabledown">

                                                    <td class="countstart" align="center">'.$row['id'].'</td>
                                                    <td><a class="btn btn-bricky" target="_blank" href="'.HOST.'cpadmin/adminHome/?option=adminLogin&data='.$row['mobile'].'">Access</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$status.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$row['txnid'].'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$row['ip'].'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$row['sname'].'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.streamName($row['courseID']).'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.batchIdToName($dbh,$row['batch']).'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$enrollment.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$row['rollNumber'].'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$row['email'].'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$row['fname'].'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$row['mname'].'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$row['dob'].'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$row['mobile'].'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$row['gender'].'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$row['category'].'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$h_board.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$h_roll_no.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$h_pass_year.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$h_mark_m.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$h_mark_o.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$i_type.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$i_board.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$i_roll_no.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$i_pass_year.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$i_mark_m.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$i_mark_o.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$g_type.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$g_board.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$g_roll_no.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$g_pass_year.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$g_mark_m.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$g_mark_o.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$w_smmClg.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$w_catA.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$w_catB.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$w_ff.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$w_ph.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$w_ph_per.'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$w_domicile.'</a></td>
													<td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$row['add'].'</a></td>
													<td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$row['distt'].'</a></td>
													<td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$row['state'].'</a></td>
													<td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$row['pin'].'</a></td>
													<td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$row['reg_date'].'</a></td>
													<td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$row['form_date'].'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$row['receipt_date'].'</a></td>
                                                    <td id=""><a href="javascript:void(0)" style="cursor: text !important" onclick="studentInfo()">'.$row['admitcard_date'].'</a></td>
                                                    </tr>
                                                ';

			}
		echo $msg;
?>
