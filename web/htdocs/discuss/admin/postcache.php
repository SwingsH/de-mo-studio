<?php
!function_exists('adminmsg') && exit('Forbidden');
$basename="$admin_file?adminjob=postcache";
include(D_P."data/bbscache/dbset.php");

if(empty($action)){	
	$motiondb=$facedb=array();
	$query=$db->query("SELECT * FROM pw_actions");
	while($postcache=$db->fetch_array($query)){
		$motiondb[]=$postcache;
	}
	$query=$db->query("SELECT * FROM pw_smiles");
	while($postcache=$db->fetch_array($query)){
		$facedb[]=$postcache;
	}
	include PrintEot('postcache');exit;
} elseif($_POST['action']=='addact'){
	if (empty($images) || empty($names) || empty($descrips)){
		adminmsg('postcache_emmpty');
	}
	foreach($names as $key=>$value){
		if($value && $images[$key] && $descrips[$key]){
			$value=Char_cv($value);
			$value1=Char_cv($images[$key]);	
			$value2=Char_cv($descrips[$key]);
			$db->update("INSERT INTO pw_actions(images,name,descrip) VALUES('$value1','$value','$value2') ");
		}
	}
	updatecache_p();
	adminmsg('operate_success');
} elseif($_POST['action']=='addface'){
	if (empty($face1)){
		adminmsg('postcache_emmpty');
	}
	$facedb=explode(',',$face1);
	$facedb=array_unique($facedb);
	foreach($facedb as $key=>$value){
		$value=Char_cv(ieconvert($value));
		$db->update("INSERT INTO pw_smiles(image) VALUES('$value')");
	}
	updatecache_p();
	adminmsg('operate_success');
} elseif($_POST['action']=='delete'){
	$delids='';
	if(is_array($delid)){
		foreach($delid as $value){
			is_numeric($value) && $delids.=$value.',';
		}
	}
	$delids=substr($delids,0,-1);
	(!$delids || $table!='pw_actions' && $table!='pw_smiles') && adminmsg('operate_error');
	$db->update("DELETE FROM $table WHERE id IN($delids)");
	updatecache_p();
	adminmsg('operate_success');
}
?>