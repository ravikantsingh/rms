<div class="row cart-container">
        <div class="cart-content">
           
            <?php
                $i = 1;
                
                $counter = 0;
                $orderID = '';
                foreach( $results as $result ){
                    if( $orderID != $result['order_id']){
                        if( $orderID != '' ){
                            $content .= '</div>';
                          	                $content .= '<div class="card-header-label '. $barClass .'">'.$table_no.'</div>';
                          	                $content .= '</div>
                          	                <table><tr><td>
                                            <form class="text-right" action="./?option=pos" method="post">
                                              <input type="hidden" name="token" value="'.md5( $orderID.date('YmdHis') ).'"  />
                                              <input type="hidden" name="orderID" value="'. $orderID.'"  />
                                              <input type="submit" class="btn btn-default btn-block" value="Add Items" />
                                            </form>
                                            </td><td>
                                            <form class="text-right" action="./?option=cart" method="post">
                                              <input type="hidden" name="token" value="'.md5( $orderID.date('YmdHis') ).'"  />
                                              <input type="hidden" name="orderID" value="'. $orderID.'"  />
                                              <input type="submit" class="btn btn-default btn-block" value="Finalise" />
                                            </form>
                                            </td>
                                            <td>
                                              <form class="text-center" action="./?option=tables" method="post">
                                                <input type="hidden" name="token" value="'.md5( $orderID.date('YmdHis') ).'"  />
                                                <input type="hidden" name="orderID" value="'. $orderID.'"  />
                                                <input type="hidden" name="action" value="print">
                                                <input type="submit" class="btn btn-default btn-block" value="Print KOT" />
                                                    
                                              </form>
                                            </td>
                                            </tr>
                                            </table>
                      	                </div>
                  	                </div>
                          	        ';
            	            $class = '';
            
            
            
                        $content .= '';
                        $counter++;
                        if( $counter % 3 == 0 ){
            
                              $content .= '</div>';
                          }
                        }
                        if( $counter % 3 == 0 ){
                         $content .= '<div class="row" style="margin: 0; display: flex;" >
                                      ';
                        }
                    
                        $content .= '
                                    <div class="col-sm-4 padding-10-hr margin-top" style="flex:1;">
                                        <div class="card padding-5" data-id="'.$orderID.'" style="height:100%;">
        
                                            <input type="hidden" id="'.$orderID.'"  />
        
                                            <div class="card-body min-height-75"> ';
        
                                            
                                            $content .= '<div class="item-container">';
                                            
                                            
                        $orderID = $result['order_id'];
                        $table_no = $result['table_no'];
                    }
                    // else{
    
                          $content .= '<div class="item-table">
                                        <div class="item-name">  '.getProductNameFromID( $dbh, $result['product_id'] ).'</div><div class="item-qty"> '.$result['quantity'].'</div>
                                      </div>';
                                            
                    // }
                    
    		    }
    		    $content .= '</div>';
          	                $content .= '<div class="card-header-label '. $barClass .'">'.$result['table_no'].'</div>';
          	                $content .= '</div>
                            
                            <table><tr><td>
                                <form class="text-right" action="./?option=pos" method="post">
                                  <input type="hidden" name="token" value="'.md5( $orderID.date('YmdHis') ).'"  />
                                  <input type="hidden" name="orderID" value="'. $orderID.'"  />
                                  <input type="submit" class="btn btn-default btn-block" value="Add Items" />
                                </form>
                                </td><td>
                                <form class="text-right" action="./?option=cart" method="post">
                                  <input type="hidden" name="token" value="'.md5( $orderID.date('YmdHis') ).'"  />
                                  <input type="hidden" name="orderID" value="'. $orderID.'"  />
                                  <input type="submit" class="btn btn-default btn-block" value="Finalise" />
                                </form>
                                </td><td>
                                <form class="text-right" action="./?option=cart" method="post">
                                  
                                </form>
                                <form class="text-center" action="./?option=tables" method="post">
                                    <input type="hidden" name="token" value="'.md5( $orderID.date('YmdHis') ).'"  />
                                    <input type="hidden" name="orderID" value="'. $orderID.'"  />
                                    <input type="hidden" name="action" value="print">
                                    <input type="submit" class="btn btn-default btn-block" value="Print KOT" />
                                        
                                </form>
                                </td>
                                </tr>
                            </table>
      	                </div>
  	                </div>
          	        ';
               $class = '';
            
            
            
                $content .= '';
                $counter++;
                if( $counter % 3 == 0 ){
    
                      $content .= '</div>';
                  }
    		    echo $content;
		    ?>
		    
        </div>
        <input type="hidden" name = "orderID" value="<?php echo $orderID; ?>" />
        <input type="hidden" name = "date" value="<?php echo date( "Y-m-d H:i:s" ); ?>" />
</div>