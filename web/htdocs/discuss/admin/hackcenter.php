<?php
!function_exists('adminmsg') && exit('Forbidden');
$basename="$admin_file?adminjob=hackcenter";
if(!$action){
	include PrintEot('hackcenter');exit;
} elseif($action=='edit'){
	if(!$_POST['step']){
		$hackname=$db_hackdb[$id][0];
		$hacksign=$db_hackdb[$id][1];
		$db_hackdb[$id][2]=='2' ? $method_2='checked' : ($db_hackdb[$id][2]=='1' ? $method_1='checked' : $method_0='checked');
		include PrintEot('hackcenter');exit;
	} else{
		if(!$hackname || !$hacksign){
			adminmsg('hackcenter_empty');
		}
		$oldsign=$db_hackdb[$id][1];
		$oldfile1=$db_hackdb[$id][2];
		$oldfile2=$db_hackdb[$id][3];
		foreach($db_hackdb as $key=>$value){
			if($key!=$id){
				if($hacksign==$value[1]){
					adminmsg('hackcenter_sign_exists');
				}
			}
		}
		$db_hackdb[$id]=array($hackname,$hacksign,$ifopen);
		$hackarray='';
		foreach($db_hackdb as $key=>$value){
			foreach($value as $k => $val){
				$value[$k] = str_replace(array("\\","'"),array("",""),$val);
			}
			$hackarray.="'$value[1]'=>array('$value[0]','$value[1]','$value[2]'),\r\n\t\t";
		}
		write_config($hackarray);
		adminmsg('operate_success');
	}
} elseif($action=='add'){
	if(!$_POST['step']){
		$method_1='checked';
		include PrintEot('hackcenter');exit;
	} else{
		if(!$hackname || !$hacksign){
			adminmsg('hackcenter_empty');
		}
		if(!is_dir(R_P."hack/$hacksign")){
			adminmsg('hackcentre_upload');
		}
		foreach($db_hackdb as $key=>$value){	
			if($hacksign==$value[1]){
				adminmsg('hackcenter_sign_exists');
			}
		}
		if(file_exists(R_P."hack/$hacksign/sql.txt")){
			updatedb(R_P."hack/$hacksign/sql.txt");
			P_unlink(R_P."hack/$hacksign/sql.txt");
		}
		$db_hackdb[]=array($hackname,$hacksign,$ifopen);
		$hackarray='';
		foreach($db_hackdb as $key=>$value){
			foreach($value as $k => $val){
				$value[$k] = str_replace(array("\\","'"),array("",""),$val);
			}
			$hackarray.="'$value[1]'=>array('$value[0]','$value[1]','$value[2]'),\r\n\t\t";
		}
		write_config($hackarray);
		adminmsg('operate_success');
	}
} elseif($action=='del'){
	PostCheck($verify);
	if(!$db_hackdb[$id]){
		adminmsg('hackcenter_del');
	}
	unset($db_hackdb[$id]);

	$hackarray='';
	foreach($db_hackdb as $key=>$value){
		$hackarray.="'$value[1]'=>array('$value[0]','$value[1]','$value[2]'),\r\n\t\t";
	}
	write_config($hackarray);
	if(P_rmdir(R_P."hack/$id")===false){
		adminmsg('hackcenter_del_fail');
	}else{
		adminmsg('operate_success');
	}
}
function write_config($hackarray){
	include(D_P.'data/sql_config.php');

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
\$pconnect = '$pconnect';		// $lang[pconnect]

/*
$lang[charset]
*/
\$charset='$charset';

/**
* $lang[ma_info]
*/
\$manager='$manager';			//$lang[manager_name]
\$manager_pwd='$manager_pwd';	//$lang[manager_pwd]

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
}
function P_rmdir($pathname){
	strpos($pathname,'..')!==false && exit('Forbidden');
	if(is_dir($pathname)){
		if($handle = opendir($pathname)){
			while(($file = readdir($handle))){
				if($file == "." || $file == ".."){
					continue;
				}
				if(is_dir($pathname."/".$file)){
					P_rmdir($pathname."/".$file);
				}else{
					P_unlink($pathname."/".$file);
				}
			}
			closedir($handle);
			return rmdir($pathname);
		}
		return false;
	}else{
		return 0;
	}
}
function updatedb($filename) {
	global $db,$charset;
	
	$sql=file($filename);
	$query='';
	$num=0;
	foreach($sql as $key => $value){
		$value=trim($value);
		if(!$value || $value[0]=='#') continue;
		if(eregi("\;$",$value)){
			$query.=$value;
			if(eregi("^CREATE",$query)){
				$extra = substr(strrchr($query,')'),1);
				$tabtype = substr(strchr($extra,'='),1);
				$tabtype = substr($tabtype, 0, strpos($tabtype,strpos($tabtype,' ') ? ' ' : ';'));
				$query = str_replace($extra,'',$query);
				if($db->server_info() > '4.1'){
					$extra = $charset ? "ENGINE=$tabtype DEFAULT CHARSET=$charset;" : "ENGINE=$tabtype;";
				}else{
					$extra = "TYPE=$tabtype;";
				}
				$query .= $extra;
			}elseif(eregi("^DROP",$query) || eregi("^DELETE",$query)){
				continue;
			}elseif(eregi("^INSERT",$query)){
				$query='REPLACE '.substr($query,6);
			}
			$db->query($query);
			$query='';
		} else{
			$query.=$value;
		}
	}
}
?>