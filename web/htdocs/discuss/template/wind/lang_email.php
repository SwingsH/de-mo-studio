<?php

$lang = array (

'email_check_subject'			=>"�E���z�b {$db_bbsname} �|���b�������n�B�J!",
'email_check_content'			=>"{$rg_name},�z�n�I\n\n{$db_bbsname}�w��z����ӡI\n�����z�o�E���z���Τ�W(�I���U����}�E��,�p�G�Τ�W�O������I���U����}�E��)\n{$db_bbsurl}/register.php?vip=activating&r_uid={$winduid}&pwd={$timestamp}\n�z���`�U�W��:{$rg_name}\n�z���K�X��:{$regpwd}\n�кɧ֧R�����l��A�H�K�O�H���ݨ�z���K�X\n\n�p�G�ѤF�K�X�A�i�H����ϼg�H�к޲z�����s�]�w\n�Ьd�ݪ��ϦU�����o�K�W�h�A�H�K���l�Q�R��\n���Ϧa�}�J{$db_bbsurl}\n\n�����Ϫ��� PHPWind �[�],�w��X��: http://www.phpwind.com",
'email_additional'				=>"From:{$fromemail}\r\nReply-To:{$fromemail}\r\nX-Mailer: PHPWind�l��ֻ�",
'email_welcome_subject'			=>"{$rg_name},�z�n,�P�±z�`�U{$db_bbsname}",
'email_welcome_content'			=>"{$rg_name},�z�n�I\n\n{$db_bbsname}�w��z����ӡI\n�z���`�U�W��:{$rg_name}\n�z���K�X��:{$regpwd}\n�кɧ֧R�����l��A�H�K�O�H���ݨ�z���K�X\n\n�p�G�ѤF�K�X�A�i�H����ϼg�H�к޲z�����s�]�w\n�Ьd�ݪ��ϦU�����o�K�W�h�A�H�K���l�Q�R��\n���Ϧa�}�J{$db_bbsurl}\n\n�����Ϫ��� PHPWind �[�],�w��X��: http://www.phpwind.com",
'email_sendpwd_subject'			=>"{$db_bbsname} �K�X���o",
'email_sendpwd_content'			=>"�Ш�U�������}�ק�K�X�J \n {$db_bbsurl}/sendpwd.php?action=getback&pwuser={$pwuser}&submit={$submit}\n�ק��Шc�O�z���K�X\n�w��Ө� {$db_bbsname}�ڭ̪����}�O:{$db_bbsurl}\n",
'email_reply_subject'			=>"{$receiver}�z�b{$db_bbsname}�����l���^�_",
'email_reply_content'			=>"Hi, {$receiver} ,\n    �ڬO{$db_bbsname}�l��j�ϡA\n    �z�b{$db_bbsname}�o���峹: {$old_title}\n    �{�b���H�^�_.�֨����`�@�U�a\n    {$db_bbsurl}/read.php?fid={$fid}&tid={$tid}\n    �U���A���H�ѻP�D�D��,�ڱN���ӥ��Z�F\n\n___________________________________\n�w��X�� {$db_wwwname}\n�����Ϫ���PHPWind �[�],�w��X��: http://www.phpwind.com",

);
?>