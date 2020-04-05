<?php
if(isset($_SESSION)){
	foreach($_SESSION as $key=>$val){
		$_SESSION[$key]=trimSpecialCharacters(trim($val));
	}
}
if(isset($_POST)){
	foreach($_POST as $key=>$val){
		if(!is_array($val)){
		    $val = htmlspecialchars($val);
			if( $key != 'PAYTM_MERCHANT_KEY' )
			$_POST[$key]= str_replace( 'amp;', '&', trimSpecialCharacters(trim($val)) );
			$$key = $val;
		}
		else{
			foreach($val as $k=>$v){
				$val[$k]= str_replace( 'amp;', '&', htmlspecialchars( trimSpecialCharacters(trim($v)) ) );
			}
			$$key = $val;

		}
	}
}
?>
