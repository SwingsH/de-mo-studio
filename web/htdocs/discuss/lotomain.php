<?php

require_once('./global.php');
require_once(R_P.'data/bbscache/level.php');
require_once('./require/bbscode.php');
//require_once('./plugins/bank_config.php');
//require_once('./advcenter/pet_config.php');

if(!groupid=="guest" || $winduid=='') Showmsg("您沒有權限使用此功能");

$wind_in='loto';

switch($hack)
{
        default:
                include 'hack/lotoloby.php';
        break;
        
        case 'lotoshop':
                include "hack/lotoshop.php";
        break;

        case 'lotoshop2':
                include "hack/lotoshop2.php";
        break;

        case 'lotoshop3':
                include "hack/lotoshop3.php";
        break;
}

function numofpage($count,$page,$numofpage,$url)
{
	global $db_readperpage;
	if ($numofpage<=1){
		return ;
	}else{
		$fengye="<a href=\"{$url}page=1\"><< </a>";
		$flag=0;
		for($i=$page-3;$i<=$page-1;$i++)
		{
			if($i<1) continue;
			$fengye.=" <a href={$url}page=$i>&nbsp;$i&nbsp;</a>";
		}
		$fengye.="&nbsp;&nbsp;<b>$page</b>&nbsp;";
		if($page<$numofpage)
		{
			for($i=$page+1;$i<=$numofpage;$i++)
			{
				$fengye.=" <a href={$url}page=$i>&nbsp;$i&nbsp;</a>";
				$flag++;
				if($flag==4) break;
			}
		}
		$fengye.=" <a href=\"{$url}page=$numofpage\"> >></a>&nbsp;&nbsp;Pages: (  $numofpage total )";
		return $fengye;
	}
}
?>