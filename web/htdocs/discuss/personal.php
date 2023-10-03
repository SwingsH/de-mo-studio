<?php
require_once('global.php');
$groupid=='guest' && Showmsg('not_login');

(!is_numeric($page) || $page<1) && $page = 1;
$db_showperpage = 20;
require_once(R_P.'require/header.php');
if(!$action || $action=='digest' || $action=='poll' || $action=='sale'){
	require_once(D_P.'data/bbscache/forum_cache.php');
	require_once(R_P.'require/forum.php');
	
	if($action=='digest'){
		$sql = " AND digest>'0'";
	}elseif($action=='poll'){
		$sql = " AND pollid>'0'";
	}elseif($action=='sale'){
		$sql = " AND ifsale='1'";
	}else{
		$sql = "";
	}
	$limit = "LIMIT ".($page-1)*$db_showperpage.",$db_showperpage";
	@extract($db->get_one("SELECT COUNT(*) AS count FROM pw_threads WHERE authorid='$winduid' AND fid!='$db_recycle' $sql"));
	$pages = numofpage($count,$page,ceil($count/$db_showperpage),"personal.php?action=$action&");

	$threaddb=array();
	$query=$db->query("SELECT tid,fid,subject,postdate,lastpost,replies,hits,digest,titlefont FROM pw_threads WHERE authorid='$winduid' AND fid!='$db_recycle' $sql ORDER BY postdate DESC $limit");
	while($rt=$db->fetch_array($query)){
		if ($rt['titlefont']){
			$titledetail=explode("~",$rt['titlefont']);
			if($titledetail[0])$rt['subject']="<font color=\"$titledetail[0]\">$rt[subject]</font>";
			if($titledetail[1])$rt['subject']="<b>$rt[subject]</b>";
			if($titledetail[2])$rt['subject']="<i>$rt[subject]</i>";
			if($titledetail[3])$rt['subject']="<u>$rt[subject]</u>";
		}
		$rt['subject']=substrs($rt['subject'],35);
		$rt['forum']=$forum[$rt['fid']]['name'];
		$rt['postdate']=get_date($rt['postdate']);
		$threaddb[]=$rt;
	}
	require_once(PrintEot('personal'));footer();
}elseif($action=='post'){
	require_once(D_P.'data/bbscache/forum_cache.php');
	require_once(R_P.'require/forum.php');

	$limit = "LIMIT ".($page-1)*$db_showperpage.",$db_showperpage";
	@extract($db->get_one("SELECT COUNT(*) AS count FROM pw_posts WHERE authorid='$winduid' AND fid!='$db_recycle'"));
	$pages = numofpage($count,$page,ceil($count/$db_showperpage),"personal.php?action=post&");

	$postdb=array();
	$query=$db->query("SELECT p.pid,p.postdate,t.tid,t.fid,t.subject,t.authorid,t.author,t.titlefont,t.digest FROM pw_posts p LEFT JOIN pw_threads t USING(tid) WHERE p.authorid='$winduid' AND p.fid!='$db_recycle' ORDER BY p.postdate DESC $limit");
	while($rt=$db->fetch_array($query)){
		if ($rt['titlefont']){
			$titledetail=explode("~",$rt['titlefont']);
			if($titledetail[0])$rt['subject']="<font color=\"$titledetail[0]\">$rt[subject]</font>";
			if($titledetail[1])$rt['subject']="<b>$rt[subject]</b>";
			if($titledetail[2])$rt['subject']="<i>$rt[subject]</i>";
			if($titledetail[3])$rt['subject']="<u>$rt[subject]</u>";
		}
		$rt['subject']=substrs($rt['subject'],35);
		$rt['forum']=$forum[$rt['fid']]['name'];
		$rt['postdate']=get_date($rt['postdate']);
		$postdb[]=$rt;
	}
	require_once(PrintEot('personal'));footer();	
}elseif($action=='rewsort'){
	$rewtdb=$rewpdb=array(0,0,0);
	$query=$db->query("SELECT COUNT(*) AS count,ifreward FROM pw_threads WHERE fid!='$db_recycle' AND authorid='$winduid' AND ifreward>'0' GROUP BY ifreward");
	while($rt=$db->fetch_array($query)){
		$rewtdb[0]+=$rt['count'];
		$rewtdb[$rt['ifreward']]=$rt['count'];
	}
	$query=$db->query("SELECT COUNT(*) AS count,ifreward FROM pw_posts WHERE fid!='$db_recycle' AND authorid='$winduid' AND ifreward>'0' GROUP BY ifreward");
	while($rt=$db->fetch_array($query)){
		$rewpdb[0]+=$rt['count'];
		$rewpdb[$rt['ifreward']]=$rt['count'];
	}
	require_once(PrintEot('personal'));footer();
}elseif($action=='question'){
	require_once(D_P.'data/bbscache/forum_cache.php');
	require_once(D_P.'data/bbscache/creditdb.php');
	require_once(R_P.'require/forum.php');
	$limit = "LIMIT ".($page-1)*$db_showperpage.",$db_showperpage";
	@extract($db->get_one("SELECT COUNT(*) AS count FROM pw_threads WHERE fid!='$db_recycle' AND authorid='$winduid' AND ifreward>'0'"));
	$pages = numofpage($count,$page,ceil($count/$db_showperpage),"personal.php?action=question&");
	
	$rewdb=array();
	$query=$db->query("SELECT tid,fid,subject,ifreward,rewardinfo FROM pw_threads WHERE fid!='$db_recycle' AND authorid='$winduid' AND ifreward>'0' $limit");
	list($db_moneyname,$db_moneyunit,$db_rvrcname,$db_rvrcunit,$db_creditname,$db_creditunit)=explode("\t",$db_credits);
	while($rt=$db->fetch_array($query)){
		$rewardinfo=explode("\n",$rt['rewardinfo']);
		list($rw_b_name,$rw_b_val,$rw_a_name,$rw_a_val)=explode('|',$rewardinfo[0]);
		$rw_b_name = is_numeric($rw_b_name) ? $_CREDITDB[$rw_b_name][0] : ${'db_'.$rw_b_name.'name'};
		$rw_a_name = is_numeric($rw_a_name) ? $_CREDITDB[$rw_a_name][0] : ${'db_'.$rw_a_name.'name'};
		$rt['binfo']=$rw_b_val."&nbsp;".$rw_b_name;
		$rt['ainfo']=$rw_a_val."&nbsp;".$rw_a_name;
		$rt['forum']=$forum[$rt['fid']]['name'];
		if($rt['ifreward']==2 && strpos($rewardinfo[1],"|")!==false){
			$rt['rewname']=substr($rewardinfo[1],0,strpos($rewardinfo[1],"|"));
		}
		$rewdb[]=$rt;
	}

	require_once(PrintEot('personal'));footer();
}elseif($action=='answer'){
	require_once(D_P.'data/bbscache/forum_cache.php');
	require_once(D_P.'data/bbscache/creditdb.php');
	require_once(R_P.'require/forum.php');
	$limit = "LIMIT ".($page-1)*$db_showperpage.",$db_showperpage";
	@extract($db->get_one("SELECT COUNT(*) AS count FROM pw_posts WHERE authorid='$winduid' AND ifreward='2'"));
	$pages = numofpage($count,$page,ceil($count/$db_showperpage),"personal.php?action=answer&");

	$rewdb=array();
	$query=$db->query("SELECT p.pid,p.content,t.tid,t.fid,t.subject,t.rewardinfo FROM pw_posts p LEFT JOIN pw_threads t USING(tid) WHERE p.fid!='$db_recycle' AND p.authorid='$winduid' AND p.ifreward='2' $limit");

	list($db_moneyname,$db_moneyunit,$db_rvrcname,$db_rvrcunit,$db_creditname,$db_creditunit)=explode("\t",$db_credits);
	while($rt=$db->fetch_array($query)){
		$rewardinfo=explode("\n",$rt['rewardinfo']);
		list($rw_b_name,$rw_b_val,$rw_a_name,$rw_a_val)=explode('|',$rewardinfo[0]);
		$rw_b_name = is_numeric($rw_b_name) ? $_CREDITDB[$rw_b_name][0] : ${'db_'.$rw_b_name.'name'};
		$rt['binfo']=$rw_b_val."&nbsp;".$rw_b_name;
		$rt['forum']=$forum[$rt['fid']]['name'];
		$rt['content']=substrs($rt['content'],30);
		$rewdb[]=$rt;
	}

	require_once(PrintEot('personal'));footer();
	
}elseif($action=='actsort'){
	$act=$db->get_one("SELECT COUNT(*) AS count FROM pw_activity WHERE admin='$winduid'");
	$query=$db->query("SELECT COUNT(*) AS count,state FROM pw_actmember WHERE winduid='$winduid' GROUP BY state");
	$actdb=array(0,0,0);
	while($rt=$db->fetch_array($query)){
		$actdb[$rt['state']]=$rt['count'];
	}
	require_once(PrintEot('personal'));footer();
}elseif($action=='held' || $action=='hold'){
	if($action=='held'){
		$sql = " AND deadline>'$timestamp'";
	}else{
		$sql = " AND deadline<'$timestamp'";
	}
	$actdb=array();
	$query=$db->query("SELECT * FROM pw_activity WHERE admin='$winduid' $sql");
	while($rt=$db->fetch_array($query)){
		$rt['starttime']=get_date($rt['starttime'],'Y-m-d');
		$rt['endtime']=get_date($rt['endtime'],'Y-m-d');
		$actdb[]=$rt;			
	}
	require_once(PrintEot('personal'));footer();
}elseif($action=='applying' || $action=='apply'){
	if($action=='applying'){
		$sql = " AND a.deadline>'$timestamp'";
	}else{
		$sql = " AND a.deadline<'$timestamp'";
	}
	$actdb=array();
	$query=$db->query("SELECT am.state,a.* FROM pw_actmember am LEFT JOIN pw_activity a ON am.actid=a.id WHERE am.winduid='$winduid' $sql");
	while($rt=$db->fetch_array($query)){
		$rt['starttime']=get_date($rt['starttime'],'Y-m-d');
		$rt['endtime']=get_date($rt['endtime'],'Y-m-d');
		$actdb[]=$rt;			
	}
	require_once(PrintEot('personal'));footer();
}
?>