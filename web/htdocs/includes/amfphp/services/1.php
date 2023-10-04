<?php

require_once('../../dm_db.php');
require_once('../../dm_classes.php');
require_once('../../dm.function.default.php');

$log = new ErrorLog('../../log/', '1to999999.txt');

// sprintf('%02d',$arr_mix[0]) 

for( $i=0 ; $i<=999999 ; $i++ ){
	
	$str = sprintf('%06d', $i ) ;	
	$log->save( $str );
}

?>