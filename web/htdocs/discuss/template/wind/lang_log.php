<?php
$logtype=array(
	'bk_save'   => '�s��',
	'bk_draw'   => '����',
	'bk_vire'   => '��b',
	'bk_credit' => '�ഫ',

	'topped'    => '�m��',
	'digest'    => '���',
	'highlight'	=> '�[�G',
	'push'		=> '���e',
	'locked'	=> '��w',
	'delrp'		=> '�R�^�_',
	'deltpc'	=> '�R�D�D',
	'delete'	=> '�R��',
	'move'		=> '����',
	'copy'		=> '�_��',
	'edit'		=> '�s��',
	'shield'    => '�̽�',
	'unite'     => '�X��',
	'remind'    => '����',

	'credit'	=> '����',
	'deluser'	=> '�Τ�',

	'cy_donate'	=> '���m',
	'cy_join'	=> '�[�s',
	'cy_vire'	=> '��b',
);

$lang = array (
	'bk_save_descrip_1'		=>	"[b]{$log[username1]}[/b]�ϥά����s�ڥ\��A�s�J���B�J{$log[field1]}{$db_moneyname}",
	'bk_save_descrip_2'		=>	"[b]{$log[username1]}[/b]�ϥΩw���s�ڥ\��A�s�J���B�J{$log[field1]}{$db_moneyname}",
	'bk_draw_descrip_1'		=>	"[b]{$log[username1]}[/b]�ϥά������ڥ\��A���X���B�J{$log[field1]}{$db_moneyname}",
	'bk_draw_descrip_2'		=>	"[b]{$log[username1]}[/b]�ϥΩw�����ڥ\��A���X���B�J{$log[field1]}{$db_moneyname}",
	'bk_vire_descrip'		=>	"[b]{$log[username1]}[/b]�ϥ���b�\��A��b��[b]{$log[username2]}[/b]���B�J{$log[field1]}{$db_moneyname}",
	'bk_credit_descrip'		=>	"[b]{$log[username1]}[/b]�ϥοn���ഫ�\��A�N{$log[sellname]}�ഫ��{$log[buyname]},�`�@��O {$log[sellname]}:{$log[field1]}�A��o {$log[buyname]}:{$log[field2]}",

	'topped_descrip'		=>	"�峹�J[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n�ާ@�J�N�峹�]���m��{$log[topped]}\n��]�J{$log[reason]}",
	'untopped_descrip'		=>	"�峹�J[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n�ާ@�J�Ѱ��峹�m��\n��]�J{$log[reason]}",
	'digest_descrip'		=> "�峹�J[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n�ާ@�J�N�峹�]�����{$log[digest]}\n��]�J{$log[reason]}\n�v�T�J{$log[affect]}",
	'undigest_descrip'		=>	"�峹�J[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n�ާ@�J�����峹���\n��]�J{$log[reason]}\n�v�T�J{$log[affect]}",
	'highlight_descrip'		=>	"�峹�J[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n�ާ@�J�N�峹���D�[�G\n��]�J{$log[reason]}",
	'unhighlight_descrip'		=>	"�峹�J[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n�ާ@�J�N�峹���D�����[�G\n��]�J{$log[reason]}",
	'push_descrip'			=>	"�峹�J[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n�ާ@�J�N�峹���e\n��]�J{$log[reason]}",
	'lock_descrip'			=>	"�峹�J[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n�ާ@�J�N�峹��w\n��]�J{$log[reason]}",
	'unlock_descrip'		=>	"�峹�J[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n�ާ@�J�N�峹�Ѱ���w\n��]�J{$log[reason]}",
	'delrp_descrip'			=> "�峹�J[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n�ާ@�J�R���^�_\n��]�J{$log[reason]}\n�v�T�J{$log[affect]}",
	'deltpc_descrip'		=> "�峹�J[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n�ާ@�J�R���D�D\n��]�J{$log[reason]}\n�v�T�J{$log[affect]}",
	'del_descrip'		=>  "�峹�J[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n�ާ@�J�N�峹�R��\n��]�J{$log[reason]}\n�v�T�J{$log[affect]}",
	'move_descrip'			=>  "�峹�J[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n�ާ@�J�N�峹���ʨ�s����([url=$db_bbsurl/thread.php?fid={$log[tofid]}][b]$log[toforum][/b][/url])\n��]�J{$log[reason]}",
	'copy_descrip'			=>	"�峹�J[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n�ާ@�J�N�峹�_���s����([url=$db_bbsurl/thread.php?fid={$log[tofid]}][b]$log[toforum][/b][/url])\n��]�J{$log[reason]}",
	'edit_descrip'			=>	"�峹�J[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n�ާ@�J�s��峹",

	'credit_descrip'		=>	"�峹�J[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n�ާ@�J�峹�Q����\n��]�J{$log[reason]}\n�v�T�J{$log[affect]}",
	'creditdel_descrip'		=>	"�峹�J[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n�ާ@�J�峹�����Q����\n��]�J{$log[reason]}\n�v�T�J{$log[affect]}",
	'deluser_descrip'		=>	"�Τ� [b]{$log[username1]}[/b] �Q�R��\n�ާ@�J��q�R���Τ�",

	'join_descrip'		=> "[b]{$log[username1]}[/b] �[�J�s[b]{$log[cname]}[/b]�A��O������J{$log[field1]}�C",
	'donate_descrip'	=> "[b]{$log[username1]}[/b] �ϥή��m���Ҧb�s($log[cname])���m������J{$log[field1]}�C",
	'cy_vire_descrip'	=> "[b]{$log[username2]}[/b] �ϥθs������޲z�\��A���Τ�[b]{$log[username1]}[/b]��b {$log[field1]}������A�t�Φ�������O�J{$log[tax]}�C",
	'shield_descrip'		=> "�峹�J[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n�ާ@�J�̽��D�D\n��]�J{$log[reason]}",
	'unite_descrip'     =>
	"�峹�J[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n�ާ@�J�D�D�X��\n��]�J{$log[reason]}",
	'remind_descrip'		=> "�峹�J[url=$db_bbsurl/read.php?tid=$log[tid]]$log[subject][/url]\n�ާ@�J�޲z����\n��]�J{$log[reason]}",
);
?>