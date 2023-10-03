<?php
$forum=array(
'1' => Array(
		'fid' => '1',
		'fup'=>'0',
		'type' => 'category',
		'name' => 'DEMO調查局',
		'f_type' => 'forum',
		'cms' => '0',
		'ifhide' => '1',
		),
'2' => Array(
		'fid' => '2',
		'fup'=>'1',
		'type' => 'forum',
		'name' => '『網站反應區』',
		'f_type' => 'forum',
		'cms' => '0',
		'ifhide' => '1',
		),
'14' => Array(
		'fid' => '14',
		'fup'=>'1',
		'type' => 'forum',
		'name' => '『我的流行日記』- 註冊後方可進入',
		'f_type' => 'forum',
		'cms' => '0',
		'ifhide' => '1',
		),
'28' => Array(
		'fid' => '28',
		'fup'=>'1',
		'type' => 'forum',
		'name' => '『流行特賣會現場』- 註冊後方可進入',
		'f_type' => 'hidden',
		'cms' => '0',
		'ifhide' => '1',
		),
'5' => Array(
		'fid' => '5',
		'fup'=>'1',
		'type' => 'forum',
		'name' => '『Demo Model募集專區』- 註冊後方可進入',
		'f_type' => 'forum',
		'cms' => '0',
		'ifhide' => '1',
		),
'13' => Array(
		'fid' => '13',
		'fup'=>'5',
		'type' => 'sub',
		'name' => 'Model 資料填寫區',
		'f_type' => 'forum',
		'cms' => '0',
		'ifhide' => '1',
		),
'10' => Array(
		'fid' => '10',
		'fup'=>'5',
		'type' => 'sub',
		'name' => 'Model 拍前問題區',
		'f_type' => 'forum',
		'cms' => '0',
		'ifhide' => '1',
		),
'12' => Array(
		'fid' => '12',
		'fup'=>'5',
		'type' => 'sub',
		'name' => 'Model 拍後心得區',
		'f_type' => 'forum',
		'cms' => '0',
		'ifhide' => '1',
		),
'3' => Array(
		'fid' => '3',
		'fup'=>'1',
		'type' => 'forum',
		'name' => '回收站',
		'f_type' => 'hidden',
		'cms' => '0',
		'ifhide' => '1',
		),

);
$forumcache='
<option value="1">>> DEMO調查局</option>
<option value="2"> &nbsp;|- 『網站反應區』</option>
<option value="14"> &nbsp;|- 『我的流行日記』- 註冊後方可進入</option>
<option value="5"> &nbsp;|- 『Demo Model募集專區』- 註冊後方可進入</option>
<option value="13"> &nbsp; &nbsp;|-  Model 資料填寫區</option>
<option value="10"> &nbsp; &nbsp;|-  Model 拍前問題區</option>
<option value="12"> &nbsp; &nbsp;|-  Model 拍後心得區</option>
';
$cmscache='
';

$md_groups=',3,';
$md_ifmsg='1';
$md_ifopen='0';


$ltitle=$lpic=$lneed=array();
/**
* 蘇�瓬�
*/
$ltitle[1]='';		$lpic[1]='';
$ltitle[2]='遊客';		$lpic[2]='8';

/**
* 奪燴郪
*/
$ltitle[3]='管理員';		$lpic[3]='3';
$ltitle[4]='總版主';		$lpic[4]='4';
$ltitle[5]='論壇版主';		$lpic[5]='5';
$ltitle[6]='禁止發言';		$lpic[6]='8';
$ltitle[7]='未驗證會員';		$lpic[7]='8';

/**
* 杻忷郪
*/
$ltitle[16]='榮譽會員';		$lpic[16]='5';

/**
* 頗埜郪
*/
$ltitle[8]='素人';		$lpic[8]='9';		$lneed[8]='0';
$ltitle[9]='街頭型人';		$lpic[9]='10';		$lneed[9]='100';
$ltitle[10]='時尚教主';		$lpic[10]='11';		$lneed[10]='1000';


$_CREDITDB=array(
		'1'=>array('好評度','點','自定義積分'),
		);

$gp_right=array(
	'1'=>array('imgwidth'=>'','imgheight'=>'','fontsize'=>''),
	'2'=>array('imgwidth'=>'','imgheight'=>'','fontsize'=>''),
	'3'=>array('imgwidth'=>'','imgheight'=>'','fontsize'=>''),
	'4'=>array('imgwidth'=>'','imgheight'=>'','fontsize'=>''),
	'5'=>array('imgwidth'=>'','imgheight'=>'','fontsize'=>''),
	'6'=>array('imgwidth'=>'','imgheight'=>'','fontsize'=>''),
	'7'=>array('imgwidth'=>'','imgheight'=>'','fontsize'=>''),
	'8'=>array('imgwidth'=>'','imgheight'=>'','fontsize'=>'3'),
	'9'=>array('imgwidth'=>'','imgheight'=>'','fontsize'=>''),
	'10'=>array('imgwidth'=>'','imgheight'=>'','fontsize'=>''),
	'16'=>array('imgwidth'=>'','imgheight'=>'','fontsize'=>''),
);

$customfield=array(
);


$_MEDALDB=array(
'1'=>array(
	'id'=>'1',
	'name'=>'終身成就獎',
	'intro'=>'謝謝您為社區發展做出的不可磨滅的貢獻!!',
	'picurl'=>'1.gif',
),
'2'=>array(
	'id'=>'2',
	'name'=>'優秀斑竹獎',
	'intro'=>'辛勞地為論壇付出勞動，收獲快樂，感謝您!',
	'picurl'=>'2.gif',
),
'3'=>array(
	'id'=>'3',
	'name'=>'宣傳大使獎',
	'intro'=>'謝謝您為社區積極宣傳,特頒發此獎!',
	'picurl'=>'3.gif',
),
'4'=>array(
	'id'=>'4',
	'name'=>'特殊貢獻獎',
	'intro'=>'您為論壇做出了特殊貢獻,謝謝您!',
	'picurl'=>'4.gif',
),
'5'=>array(
	'id'=>'5',
	'name'=>'金點子獎',
	'intro'=>'為社區提出建設性的建議被采納,特頒發此獎!',
	'picurl'=>'5.gif',
),
'6'=>array(
	'id'=>'6',
	'name'=>'原創先鋒獎',
	'intro'=>'謝謝您積極發表原創作品,特頒發此獎!',
	'picurl'=>'6.gif',
),
'7'=>array(
	'id'=>'7',
	'name'=>'貼圖大師獎',
	'intro'=>'帖圖高手,堪稱大師!',
	'picurl'=>'7.gif',
),
'8'=>array(
	'id'=>'8',
	'name'=>'灌水天才獎',
	'intro'=>'能夠長期提供優質的社區水資源者,可得這個獎章!',
	'picurl'=>'8.gif',
),
'9'=>array(
	'id'=>'9',
	'name'=>'新人進步獎',
	'intro'=>'新人有很大的進步可以得到這個獎章!',
	'picurl'=>'9.gif',
),
'10'=>array(
	'id'=>'10',
	'name'=>'幽默大師獎',
	'intro'=>'您總是能給別人帶來歡樂,謝謝您!',
	'picurl'=>'10.gif',
),
);

?>