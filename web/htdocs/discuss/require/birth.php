<?php
!function_exists('readover') && exit('Forbidden');

if($birthcontrol<$tdtime){
	$birthman='';
	$birthcontrol=$tdtime;
	$get_today=get_date($timestamp,'Y-m-d');
	$todayyear=substr($get_today,0,strpos($get_today,'-'));
	$gettoday=substr($get_today,strpos($get_today,'-')+1);
	$query = $db->query("SELECT username,bday,gender FROM pw_members WHERE bday LIKE '%$gettoday'");
	while(@extract($db->fetch_array($query))){
		$birthday=substr($bday,strpos($bday,'-')+1);
		if($gettoday==$birthday)
		{
			$birthyear=substr($bday,0,strpos($bday,'-'));
			$age=$todayyear-$birthyear;
			$birthman.="$username~$gender~$age".",";
		}
	}
	$db->update("UPDATE pw_bbsinfo SET birthcontrol='$tdtime',birthman='".addslashes($birthman)."' WHERE id=1");
}
$birthmen=explode(',',$birthman);
$birthnum=count($birthmen)-1;
$index_birth='';
if($birthnum==0){
	include PrintEot('birth');
	//$index_birth.='-->';
} else{
	for($i=0;$i<$birthnum;$i++)
	{
		$userarray=explode("~",$birthmen[$i]);
		$rawname=rawurlencode($userarray[0]);
		include PrintEot('birth');
		//$index_birth.='-->';
	}
}
?>