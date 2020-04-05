<?php
include_once('../../inc/scripts/config.php');
include_once('../../inc/scripts/functions.php');

echo '<table>';
for($i=1;$i<=10;$i++){
    
     $sql=$dbh->prepare("SELECT * FROM `cart` WHERE `table_no`=?");
	$run=$sql->execute( array( $i ) );
	$results= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
	    echo '<tr>';
      foreach( $results as $result ){
        
            echo '<td>Table No '.$i;
        

   echo '<form class="text-right" action="../?option=pos" method="post">
                                      <input type="hidden" name="token" value="'.md5( $result['order_id'].date('YmdHis') ).'"  />
                                      <input type="hidden" name="order_id" value="'. $result['order_id'].'"  />
                                      <input type="submit" class="btn btn-default" value="Add Items" />
                                    </form>
    <form class="text-right" action="../?option=cart" method="post">
                                      <input type="hidden" name="token" value="'.md5( $result['order_id'].date('YmdHis') ).'"  />
                                      <input type="hidden" name="order_id" value="'. $result['order_id'].'"  />
                                      <input type="submit" class="btn btn-default" value="Finalize Table" />
                                    </form>';
  echo '</td>';
        break;
       
      }
      echo '</tr>';
	} 
	
}
echo '</table>';
?>