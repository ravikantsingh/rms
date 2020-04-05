<?php 
$group = 0;
if( isset( $_POST['batchSearch'] ) && isset( $_POST['stream'] ) && isset( $_POST['group'] ) ){ 
                $batch = $_POST['stream'];
                $group = $_POST['group'];
                $sort = ( isset( $_POST['sort'] ) ) ?  $_POST['sort'] : "`stream".$batch."`.`roll_number`";
                if( isset($_POST['lock'] ) && isset($_POST['enrollment'] ) ){
                    $x=lockPayment( $dbh, $enrollment, $_POST['lock'] );
                    
                }
        }
        ?>  
<div class="row">
  <div class="col-sm-12 sm-fifty">
    <div class="panel panel-default">
      <div class="panel-heading"> <i class="clip-stats"></i> <?php if( isset( $batch ) ){ ?> Showing Students Stats For <?php echo batchIdToName( $dbh, $batch ); } else{ echo 'Students Stats'; } ?> 
        <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
      </div>
      <div class="panel-body">
        <div class="flot-container" style = "height: 90vh;">
          <form class="smart-wizard form-horizontal" method="post" action="./?option=report" >
            <div id="searchfield">
              <ul>
                <li class="searchfilter">Filter</li>
                <li>
                  <select name="stream" id="stream" class="form-control">
                    <?php 
							   ////////////////////////////////////////////////////
							   
							    $opt='<option value="0" >Select Stream</option>';
								$sqlCheck=$dbh->prepare("SELECT * FROM `batch_type` WHERE `active`='1' AND `counselling`='1' ");
								$runCheck=$sqlCheck->execute();
								$row= $sqlCheck->fetchAll(PDO::FETCH_ASSOC);
								 foreach($row as $tmp){
									if(isset($batch) && $batch==$tmp['batch_id']){
										$opt.='<option selected="selected" value="'.$tmp['batch_id'].'">'.$tmp['batch_name'].'</option>';
										$seats = $tmp['seats_available'];
										$seatsOccupied = $tmp['seats_occupied'];
										$ewsSeats = $tmp['ews_seats'];
										$ewsSeatsOccupied = $tmp['ews_seats_occupied'];
									}
									else $opt.='<option value="'.$tmp['batch_id'].'">'.$tmp['batch_name'].'</option>';
								}
							   ////////////////////////////////////////////////////
							   echo $opt; ?>
                  </select>
                </li>
                <li>
                  <select name="group" id="group" class="form-control">
                    <option  <?php echo ( $group == 0 )? 'selected="selected"' : '' ?> value="0">All</option>
                    <option  <?php echo ( $group == 1 )? 'selected="selected"' : '' ?>  value="1">Counselling Done</option>
                    <option  <?php echo ( $group == 2 )? 'selected="selected"' : '' ?>  value="2">Counselling Not Done</option>
                    <option  <?php echo ( $group == 3 )? 'selected="selected"' : '' ?>  value="3">Payment Done</option>
                    <option  <?php echo ( $group == 4 )? 'selected="selected"' : '' ?>  value="4">Payment Not Done</option>
                  </select>
                </li>
                <div id="batch-searchfield">
                  <li>
                    <input name="batchSearch" id="search" type="submit" value="Generate Report" class="btn btn-bricky">
                  </li>
                 
                </div>
              </ul>
            </div>
          </form>
        <?php if( isset( $_POST['batchSearch'] ) && isset( $_POST['stream'] ) ){ ?>
          <form name="studentListForm" id="studentListForm" method="post" action="">
              
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table" id="tablestudent" class="table  table-full-width table-bordered">
                            <tbody><tr>
                                <td style="border-bottom:none;">
									 <div id="table_wrapper">
                                  	<table width="100%" cellspacing="0" cellpadding="0" id="" border="0" align="center" class="table table-full-width table-bordered" style="white-space:nowrap;">
	                                  	<thead class="th">
										<tr>
    										<th id="thsl" width="3%" align="center"><a>S.No</a></th>
    										<th id="th3" class="sortable" align="left" width="">
    										    <form method="post" action="./?option=report" enctype="multipart/form-data" ">
                            						<input type="hidden" name="batchSearch" value=" <?php echo $_POST['batchSearch']; ?>" />
                            						<input type="hidden" name="stream" value=" <?php echo $batch; ?>" />
                            						<input type="hidden" name="group" value=" <?php echo $group; ?>" />
                            						<input type="hidden" name="sort" value="sname" />
                            						<input type="submit" value = "Student Name" class = "btn btn-link" style="padding:0" />
                            					</form></th>
                                          <th id="th3"  align="left" width=""><a href="">Contact</a></th>
                                          <th id="th3" class="sortable" align="left" width="">
                                                <form method="post" action="./?option=report" enctype="multipart/form-data" ">
                            						<input type="hidden" name="batchSearch" value=" <?php echo $_POST['batchSearch']; ?>" />
                            						<input type="hidden" name="stream" value=" <?php echo $batch; ?>" />
                            						<input type="hidden" name="group" value=" <?php echo $group; ?>" />
                            						<input type="hidden" name="sort" value="enrollment" />
                            						<input type="submit" value = "Enrollment" class = "btn btn-link" style="padding:0" />
                            					</form>
                            				</th>
                                          <th id="th3" class="sortable" align="left" width="">
                                              <form method="post" action="./?option=report" enctype="multipart/form-data" ">
                            						<input type="hidden" name="batchSearch" value=" <?php echo $_POST['batchSearch']; ?>" />
                            						<input type="hidden" name="stream" value=" <?php echo $batch; ?>" />
                            						<input type="hidden" name="group" value=" <?php echo $group; ?>" />
                            						<input type="hidden" name="sort" value="rollNumber" />
                            						<input type="submit" value = "Roll No." class = "btn btn-link" style="padding:0" />
                            					</form>
                            			</th>
                                          <th id="th3" class="sortable" align="left" width="">
                                                <form method="post" action="./?option=report" enctype="multipart/form-data" ">
                            						<input type="hidden" name="batchSearch" value=" <?php echo $_POST['batchSearch']; ?>" />
                            						<input type="hidden" name="stream" value=" <?php echo $batch; ?>" />
                            						<input type="hidden" name="group" value=" <?php echo $group; ?>" />
                            						<input type="hidden" name="sort" value="ledgerNumber" />
                            						<input type="submit" value = "Ledger" class = "btn btn-link" style="padding:0" />
                            					</form>
                            				</th>
                                          <th id="th3" class="sortable" align="left" width="">
                                              <form method="post" action="./?option=report" enctype="multipart/form-data" ">
                            						<input type="hidden" name="batchSearch" value=" <?php echo $_POST['batchSearch']; ?>" />
                            						<input type="hidden" name="stream" value=" <?php echo $batch; ?>" />
                            						<input type="hidden" name="group" value=" <?php echo $group; ?>" />
                            						<input type="hidden" name="sort" value="dob" />
                            						<input type="submit" value = "Date of Birth" class = "btn btn-link" style="padding:0" />
                            					</form>
                            				</th>
                                          <th id="th3" class="sortable" align="left" width="">
                                                <form method="post" action="./?option=report" enctype="multipart/form-data" ">
                            						<input type="hidden" name="batchSearch" value=" <?php echo $_POST['batchSearch']; ?>" />
                            						<input type="hidden" name="stream" value=" <?php echo $batch; ?>" />
                            						<input type="hidden" name="group" value=" <?php echo $group; ?>" />
                            						<input type="hidden" name="sort" value="gender" />
                            						<input type="submit" value = "Gender" class = "btn btn-link" style="padding:0" />
                            					</form>
                            				</th>
                                          <th id="th3" class="sortable" align="left" width="">
                                              <form method="post" action="./?option=report" enctype="multipart/form-data" ">
                            						<input type="hidden" name="batchSearch" value=" <?php echo $_POST['batchSearch']; ?>" />
                            						<input type="hidden" name="stream" value=" <?php echo $batch; ?>" />
                            						<input type="hidden" name="group" value=" <?php echo $group; ?>" />
                            						<input type="hidden" name="sort" value="category" />
                            						<input type="submit" value = "Category" class = "btn btn-link" style="padding:0" />
                            					</form>
                            				</th>
                                          
                                            <th id="thsl" align="center">Action</th>
    									    <th id="th3" class="sortable" align="left" width=""><a href="">Payment</a></th>
                                        </tr>
                                      </thead>
										<tbody class="table" id="changeBody">
<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$sqlCheck=$dbh->prepare("SELECT `stream".$batch."`.`id`, `main`.`enrollment`, `main`.`sname`, `main`.`ledgerNumber`, `main`.`fname`, `main`.`dob`, `main`.`mobile`, `main`.`email`, `main`.`gender`, `main`.`category`, `main`.`rollNumber`, `main`.`isPaymentLock`, `finalized` FROM `stream".$batch."` INNER JOIN `main` ON `stream".$batch."`.`roll_number` = `main`.`rollNumber`  WHERE `stream".$batch."`.`roll_number` != '' AND `main`.`rollNumber` != ''  ORDER BY  ".$sort." ASC  ");
$total =0; $counselling = 0; $paymentDone= 0; $i = 0;
$runCheck=$sqlCheck->execute();
$rows=$sqlCheck->fetchAll();
foreach( $rows as $row ){
    $enrollment=$row['enrollment'];
	$style = '';
	$action = '';
	$total++;
	$echo = ( $group == 0 ) ? true : false;
    if( $row['finalized'] ){ 
        $style = 'style = "background-color: #0000ff; color: #ffffff; "';
        $counselling++;
        if( $group == 1 ) $echo = true;
    }
    else{
        if( $group == 2 ) $echo = true;
    }
    if( isPaymentDone( $dbh, $enrollment, 'Admission Fee' ) ) {
        $style = 'style = "background-color: #084808; color: #ffffff; "';
        $paymentDone++;
        if( $group == 3 ) $echo = true;
    }
    else{
        if( $group == 4 && $row['finalized'] ) $echo = true;
    }
    
        $action = '
    					<form method="post" action="./?option=report#form.'.$enrollment.'" enctype="multipart/form-data" id= "form.'.$enrollment.'">
    						<input type="hidden" name="enrollment" value="'.$enrollment.'" />
    						<input type="hidden" name="batchSearch" value="'.$_POST['batchSearch'].'" />
    						<input type="hidden" name="stream" value="'.$batch.'" />
    						<input type="hidden" name="group" value="'.$group.'" />
    						<input type="hidden" name="lock" value="'.( ( $row['isPaymentLock'] ) ? 0 : 1 ).'" />
    						<input type="submit"'.( ( $row['isPaymentLock'] ) ? ' class="btn btn-dark-beige" value="Un-Lock"' : ' class="btn btn-bricky" value="Lock"' ).' />
    					</form>
    					';
    
	echo ( $echo ) ? '
        <tr class="tabledown"  '.$style.' >

            <td class="countstart" align="center">'.(++$i).'</td>
            <td id="">'.$row['sname'].'<br />S/O '.$row['fname'].'</td>
            <td id=""><i class="fa fa-mobile" aria-hidden="true"></i> '.$row['mobile'].'<br /><i class="fa fa-envelope-o" aria-hidden="true"></i> '.$row['email'].'</td>
            <td id="">'.$enrollment.'</td>
            <td id="">'.$row['rollNumber'].'</td>
            <td id="">'.$row['ledgerNumber'].'</td>
            <td id="">'.$row['dob'].'</td>
            <td id="">'.$row['gender'].'</td>
            <td id="">'.$row['category'].'</td>
            <td><a class="btn btn-bricky" target="_blank" href="'.HOST.'cpadmin/adminHome/?option=adminLogin&data='.$row['mobile'].'">Access</a></td>
            <td id="">'.$action.'</td>
            </tr>
        ' : '';

	}
?>
            <tr>
                <td colspan="12">
                    <table class="table table-bordered table-striped" style= "font-size: 18px; font-weight: bold;">
                        <tr>
                         <td>Total Students</td>
                         <td><?php echo $total; ?></td>
                         <td>Counselling Done</td>
                         <td><?php echo $counselling; ?></td>
                         <td>Payment Done</td>
                         <td><?php echo $paymentDone; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="12">
                    <table class="table table-bordered table-striped" style= "font-size: 18px; font-weight: bold;">
                        <tr>
                         <td>Total Seats</td>
                         <td><?php echo $seats; ?></td>
                         <td>Seats Occupied</td>
                         <td><?php echo $seatsOccupied; ?></td>
                         <td>Ews Seats</td>
                         <td><?php echo $ewsSeats; ?></td>
                         <td>Ews Seats Occupied</td>
                         <td><?php echo $ewsSeatsOccupied; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            
											</tbody>
                                                </table>
												</div>
                                                </td>
                                            </tr>



                                        </tbody></table>


                        <input type="hidden" id="hiddenforstudent" value="10">
          </form>
          
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>


</div>
  <script type="text/javascript">
$(document).ready(function() {
  $("#expStudentExcelPopUp").click(function() {
   window.location.replace('./test.php');
  });
$('#getDetails').click(function(){
	var field=$('#getDetailsfield').val();
	var val=$('#getDetailssearch').val();
	if(field=='0'||val=='')
		alert('Please Select Search Field or Enter Search Value');
	else{
		$.post("./inc/post/<?php echo $option;?>_search.php",{field: field,val: val},function(data){
				$('#changeBody').empty();
				$('#changeBody').html(data);
			});
	}
	});
$("#clear").click(function() {
   window.location.replace('./?option=<?php echo $option; ?>');
  });

});
function itemPerPage(range){
	window.location='<?php echo HOST;?>cpadmin/adminHome/?option=<?php echo $option; ?>&range='+range;
}
</script>

</div>
</body></html>
