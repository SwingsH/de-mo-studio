<?php
!function_exists('adminmsg') && exit('Forbidden');
$basename="$admin_file?adminjob=manager";

include(D_P.'data/sql_config.php');
if(!$_POST['action']){
	include PrintEot('manager');exit;
} else{
	$rs=$db->get_one("SELECT uid FROM pw_members WHERE username='$username'");
	if(!$rs && $username!=$admin_name){
		$errorname=$username;
		adminmsg('user_not_exists');
	}
	if($password){
		$check_pwd!=$password && adminmsg('password_confirm');
		$S_key=array("\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n",'#');
		foreach($S_key as $value){
			if (strpos($password,$value)!==false){ 
				adminmsg('illegal_password'); 
			}
		}
		$password=md5($password);
	} else{
		$password=$manager_pwd;
	}
	if($db_hostweb!=0){
		$db_hostweb=1;
	}
	if(empty($pconnect)){
		$pconnect=0;
	}
	$attachdb='';
	foreach($attach_url as $key=>$value){
		$attachdb .= $attachdb ? ",'".$value."'" : "'$value'";
	}
	$hackarray='';
	foreach($db_hackdb as $key=>$value){
		$hackarray.="'$value[1]'=>array('$value[0]','$value[1]','$value[2]'),\r\n\t\t";
	}
	include(GetLang('all'));

	$writetofile=
"<?php
/**
* $lang[info]
*/
\$dbhost = '$dbhost';			// $lang[dbhost]
\$dbuser = '$dbuser';			// $lang[dbuser]
\$dbpw = '$dbpw';				// $lang[dbpw]
\$dbname = '$dbname';			// $lang[dbname]
\$database = 'mysql';			// $lang[database]
\$PW = '$PW';					// $lang[PW]
\$pconnect = '$pconnect';		//$lang[pconnect]

/*
$lang[charset]
*/
\$charset='$charset';

/**
* $lang[ma_info]
*/
\$manager='$username';			//$lang[manager_name]
\$manager_pwd='$password';	    //$lang[manager_pwd]

/**
* $lang[hostweb]
*/
\$db_hostweb='$db_hostweb';		//$lang[ifhostweb]

/*
* $lang[attach_url]
*/
\$attach_url=array($attachdb);



/**
* $lang[hackdb]
*/
\$db_hackdb=array(

		$hackarray
		);
".'?>';

	writeover(D_P.'data/sql_config.php',$writetofile);
	if(!$rs && $username==$admin_name){
		$db->update("INSERT INTO pw_members SET username='$username',password='$password',groupid='3',regdate='$timestamp'");
	} else{
		$db->update("UPDATE pw_members SET password='$password',groupid='3' WHERE username='$username'");
	}
	adminmsg('operate_success');
}
function writesqlcinfig(){

}
?>