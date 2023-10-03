<?php
require_once('global.php');
!$winduid && Showmsg('not_login');
if($action=='apply'){
	$actid=(int)$actid;
	if(!$step){
		$sql=" LEFT JOIN pw_tmsgs tm ON t.tid=tm.tid";
		$sqlsel=",tm.ifconvert,tm.content";
	}else{
		$sql=$sqlsel='';
	}
	$act=$db->get_one("SELECT t.authorid,t.subject as tsubject,a.* $sqlsel FROM pw_threads t LEFT JOIN pw_activity a ON t.activeid=a.id $sql WHERE t.tid='$tid' AND a.id='$actid'");
	!$act && Showmsg('data_error');
	$act['deadline']<$timestamp && Showmsg('time_out');
	if($act['num']){
		@extract($db->get_one("SELECT COUNT(*) AS count FROM pw_actmember WHERE actid='$actid' AND state='1'"));
		$count>=$act['num'] && Showmsg('num_full');
	}
	if($act['sexneed']){
		$member=$db->get_one("SELECT gender FROM pw_members WHERE uid='$winduid'");
		$member['gender']!=$act['sexneed'] && Showmsg('apply_gender_error');
	}
	$rt=$db->get_one("SELECT state FROM pw_actmember WHERE winduid='$winduid' AND actid='$actid'");
	$rt && Showmsg('have_act');
	if(!$step){
		require_once(R_P.'require/header.php');
		require_once(R_P.'require/bbscode.php');
		$read=array();
		$act['starttime']=get_date($act['starttime'],'Y-m-d');
		$act['endtime']=get_date($act['endtime'],'Y-m-d');
		$act['deadline']=get_date($act['deadline'],'Y-m-d');
		$act['content']=str_replace("\n","<br>",$act['content']);
		$act['ifconvert']==2 && $act['content']=convert($act['content'],$db_windpost);

		$query=$db->query("SELECT COUNT(*) AS count,state FROM pw_actmember WHERE actid='$actid' GROUP BY state");
		$act_total=$act_y=0;
		while($rt=$db->fetch_array($query)){
			$act_total+=$rt['count'];
			$rt['state']==1 && $act_y+=$rt['count'];
		}
		require_once PrintEot('active');footer();
	}elseif($_POST['step']==2){
		!$contact && Showmsg('contact_empty');
		$contact = Char_cv($contact);
		$message = Char_cv($message);
		$state = $act['authorid']==$winduid ? 1 : 0;
		$db->update("INSERT INTO pw_actmember (actid,winduid,state,applydate,contact,message) VALUES ('$actid','$winduid','$state','$timestamp','$contact','$message')");
		refreshto("read.php?tid=$tid&fpage=$fpage",'operate_success');
	}
}elseif($action=='view'){
	require_once(R_P.'require/header.php');
	require_once(R_P.'require/forum.php');
	require_once(R_P.'require/bbscode.php');

	$actid=(int)$actid;
	$act=$db->get_one("SELECT a.*,t.authorid,t.subject as tsubject,tm.ifconvert,tm.content FROM pw_activity a LEFT JOIN pw_threads t ON a.tid=t.tid LEFT JOIN pw_tmsgs tm ON t.tid=tm.tid WHERE a.id='$actid'");
	!$act && Showmsg('data_error');
	$admincheck = $act['authorid']==$winduid ? 1 : 0;

	if(!$admincheck){
		$ifact=$db->get_one("SELECT * FROM pw_actmember WHERE actid='$actid' AND winduid='$winduid' AND state='1'");
		!$ifact && Showmsg("actid_view_error");
	}

	$act['starttime']=get_date($act['starttime'],'Y-m-d');
	$act['endtime']=get_date($act['endtime'],'Y-m-d');
	$act['deadline']=get_date($act['deadline'],'Y-m-d');
	$tid=$act['tid'];
	
	$act['content']=str_replace("\n","<br>",$act['content']);
	$act['ifconvert']==2 && $act['content']=convert($act['content'],$db_windpost);
	
	if($admincheck){
		$sql = "";
	}else{
		$sql = "AND a.state='1'";
	}
	$query=$db->query("SELECT COUNT(*) AS count,state FROM pw_actmember WHERE actid='$actid' GROUP BY state");
	$act_total=$act_y=0;
	while($rt=$db->fetch_array($query)){
		$act_total+=$rt['count'];
		$rt['state']==1 && $act_y+=$rt['count'];
	}
	$db_showperpage=30;
	(!is_numeric($page) || $page<1) && $page = 1;
	$limit = "LIMIT ".($page-1)*$db_showperpage.",$db_showperpage";
	$pages = numofpage($act_total,$page,ceil($act_total/$db_showperpage),"active.php?action=view&actid=$actid&");

	$actdb=array();
	$query=$db->query("SELECT a.*,m.username,m.gender FROM pw_actmember a LEFT JOIN pw_members m ON a.winduid=m.uid WHERE a.actid='$actid' $sql ORDER BY applydate DESC $limit");
	while($rt=$db->fetch_array($query)){
		$rt['applydate']=get_date($rt['applydate']);
		$actdb[]=$rt;
	}
	require_once PrintEot('active');footer();
}elseif($action=='pass' || $action=='unpass'){
	$actid=(int)$actid;
	$selids='';
	foreach($selid as $key=>$val){
		is_numeric($val) && $selids .= $selids ? ','.$val : $val;
	}
	!$selids && Showmsg('selid_illegal');

	$read=$db->get_one("SELECT t.authorid FROM pw_threads t LEFT JOIN pw_activity a ON t.activeid=a.id WHERE t.tid='$tid' AND a.id='$actid'");
	!$read && Showmsg('data_error');
	$read['authorid']!=$winduid && Showmsg('active_manager_right');

	$state = $action=='pass' ? 1 : 2;
	$db->update("UPDATE pw_actmember SET state='$state' WHERE actid='$actid' AND id IN($selids)");
	refreshto("active.php?action=view&actid=$actid&tid=$tid",'operate_success');
}elseif($action=='exit'){
	$read=$db->get_one("SELECT t.tid FROM pw_threads t LEFT JOIN pw_activity a ON t.activeid=a.id WHERE t.tid='$tid' AND a.id='$actid'");
	!$read && Showmsg('data_error');
	$db->update("DELETE FROM pw_actmember WHERE actid='$actid' AND winduid='$winduid'");
	refreshto("read.php?tid=$tid",'operate_success');
}elseif($action=='cancle'){
	$read=$db->get_one("SELECT t.authorid FROM pw_threads t LEFT JOIN pw_activity a ON t.activeid=a.id WHERE t.tid='$tid' AND a.id='$actid'");
	!$read && Showmsg('data_error');
	$read['authorid']!=$winduid && Showmsg('active_manager_right');
	$db->update("DELETE FROM pw_activity WHERE id='$actid'");
	$db->update("DELETE FROM pw_actmember WHERE actid='$actid'");
	$db->update("UPDATE pw_threads SET activeid='' WHERE tid='$tid'");
	refreshto("read.php?tid=$tid",'operate_success');
}
?>