<?php
if(isset($_POST) && count( $_POST ) > 0 ){
    include_once('../../../inc/scripts/config.php');
    include_once('../../../inc/scripts/functions.php');
    
    $content = '';
    $sql=$dbh->prepare("SELECT * FROM `order_details` WHERE ( `status` = '1' OR `status` = '2' ) AND  `canceled` = '0' AND `token` != 0 ORDER BY `token` ASC");
	$run=$sql->execute( array(  ) );
	$results= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	$token = $_POST['token'];
	$contenthash = array();
    foreach( $results as $result ){
        array_push( $contenthash, $result['status'] );
    }
	$contenthash = md5(implode( ' ', $contenthash  ));
	if($_POST['token'] != $contenthash){
    	if( $run && $count > 0 ){
    	    $class = '';
          $counter = 0;$display = 1;
          
          foreach( $results as $result ){
            $items = getOrderItems( $dbh, $result['order_id'] );
            if( !$items ) continue;
            
            if( $counter % 9 == 0 ){
                 $content .= '<div class="display-wrapper" id = "display-'.( $display++ ).'" '.( ($display > 2) ? 'style = "display: none;"' : '' ).' >';
            }
            if( $counter % 3 == 0 ){
                 $content .= '<div class="row" style="margin: 0; display: flex;" >
                              ';
            }
                $date = date_add(date_create( $result['date']), date_interval_create_from_date_string( '+'.$result['p_time'].' minutes' ) );
                $date = date_format($date, 'Y-m-d H:i:s');
                $t  = $result['p_time']*60;
                $rt = strtotime( $date ) - strtotime( date('Y-m-d H:i:s') ) ;
                $p  = ($t != 0 ) ? min( ( ( ( $t - $rt )*100  ) / $t), 100 ) : 0;
                $barClass = ( $p < 85 ) ? 'progress-bar-green' : ( ( $p < 95 ) ? 'progress-bar-orange' : 'progress-bar-red' );
                $barClass = ( $result['status'] == 2 ) ?  'progress-bar-blue' : $barClass ;
                    $content .= '
                                <div class="col-sm-4 padding-10-hr margin-top" style="flex:1;">
                                    <div class="card padding-5" data-id="'.$result['order_id'].'" style="height:100%;">
    
                                        <input type="hidden" id="'.$result['order_id'].'"  />
    
                                        <div class="card-body min-height-120"> ';
    
                                        $content .= '<div class="progress-bar-container">
                                                      ';
                                        $content .=   ( $result['status'] != 2 ) ?    '<div class="progress-loading"><div class="progress-loading-bar '. $barClass .'" style="width:'.$p.'%" data-t="'.$t.'" data-rt="'.($t - $rt).'"> </div></div>' : '<div class ="order-text blink" > Your order is ready... </div>';
                                        $content .=     '
                                                      
                                                    </div>';
                                        $token = substr($result['token'],6,10)*1;
                      	                $content .= '<div class="card-header-label-display '. $barClass .'">'.$token.'</div>';
                      	                $content .= '</div>
                  	                </div>
              	                </div>
                      	        ';
    	            $class = '';
    
    
    
                $content .= '';
                $counter++;
                if( $counter % 3 == 0 ){
    
                    $content .= '</div>';
                }
                if( $counter % 9 == 0 ){
    
                    $content .= '</div>';
                }
    
    	    }
    	    $content .= '<input type="hidden" value="1" id="activeDisplay" data-display = "'.($display-1).'" />';
        }
        $content .= '<input type="hidden" value="'.( $contenthash ).'" id="content" />';
        $data = array('success', $content );
        echo json_encode($data);
	}
	else{
	    $data = array('fail');
        echo json_encode($data);

	}
}
else{
    $data = array('fail');
    echo json_encode($data);
}