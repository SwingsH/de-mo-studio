<html>
����O BOM (Byte-Order Mark)�H
<p>
�b�@�ǥ��x�W�A�O��N���ƭȸ��j�� byte ��b�e���A�o�٬� Big Endian (BE) ���t�ΡF���ǥ��x�h�ۤϡA�O��N���ƭȸ��p�� byte ��b�e���A�٬� Little Endian (LE) ���t�ΡC
<p>
�Y�� LE �覡�s�X�ABOM �|���ܬ� 0xFF 0xFE�A�Ӧb Unicode ���w�q���O���s�b U+FFFE �o�Ӧr����.
<p>
�Y�� BE �覡�s�X�ABOM �|���ܬ� 0xFE 0xFF�A�� U+FEFF ��n�O�b Unicode �������Ħr���A�N�����O�@�Ӥ����Ŷ��� space �Ÿ��A�ҥH�Y�ϨS�Q������ BOM�A�]���|��\���̲��Ϳ��~���T��. 
<p>
�p�󲾰��H (�ϥ� PHP)
<p>
BOM�H���O���}�Y���@�����ê��r�šA�Ω����Y�ǽs�边�ѧO�o�O��UTF-8�s�X�����C��PHP�bŪ�����ɷ|��o�Ǧr��Ū�X�A�q�ӧΦ��F���}�Y�t���@�ǵL�k�ѧO���r�Ū����D�C
�n�˴��@��UTF-8���O�_�t��BOM�H���A�N�O�˴����}�Y���r�T�ӲšA�O�_��0xEF, 0xBB, 0xBF�C
<p>
�U�観�Ӥp�{���A�ϥΪ̥i�H�j�M�Y�ӥؿ��U�Ҧ����A���˴��O�_�[�FBOM�C
<p>

<?php 
//�����Ω�ֳt����UTF8�s�X�����O���O�[�FBOM�A�åi�۰ʲ��� 
//By Bob Shen 

$basedir="."; //�ק惡�欰�ݭn�˴����ؿ��A�I���ܷ��e�ؿ� 
$auto=1; //�O�_�۰ʲ����o�{��BOM�H���C1���O�A0���_�C 

//�H�U���Χ�&#21160; 

if ($dh = opendir($basedir)) { 
while (($file = readdir($dh)) !== false) { 
if ($file!='.' && $file!='..' && !is_dir($basedir."/".$file)) echo "<br/>filename: $file ".checkBOM("$basedir/$file")." 
"; 
} 
closedir($dh); 
} 

function checkBOM ($filename) { 
global $auto; 
$contents=file_get_contents($filename); 
$charset[1]=substr($contents, 0, 1); 
$charset[2]=substr($contents, 1, 1); 
$charset[3]=substr($contents, 2, 1); 
if (ord($charset[1])==239 && ord($charset[2])==187 && ord($charset[3])==191) { 
if ($auto==1) { 
$rest=substr($contents, 3); 
rewrite ($filename, $rest); 
return ("BOM found, automatically removed."); 
} else { 
return ("BOM found."); 
} 
} 
else return ("BOM Not Found."); 
} 

function rewrite ($filename, $data) { 
$filenum=fopen($filename,"w"); 
flock($filenum,LOCK_EX); 
fwrite($filenum,$data); 
fclose($filenum); 
} 
?> 

<p>
-------------------
<p>
2005-11-1 �ץ�
<p>
�������յ��G�G
<p>
1. UltraEdit 10
���I�G�ӷ~�n��C
�u�I�G�����ŦX�ݨD�C
<p>
2. EditPlus
���I�G�L�k���� BOM �X�A�ɧU��L�覡�������ᤤ���ܦ��ýX�C�ӷ~�n��C
�u�I�G�i�ۭq�{���y�k�榡�B����ơC
<p>
2.1 EditPlus 2.20
���I�G�ӷ~�n��C
�u�I�G�����ŦX�ݨD�C
<p>
3. PSPad editor
���I�G�L�k���� BOM �X
�u�I�G�㦳 16 �i��s��Ҧ��B�����.....�p�G���O�n���� BOM �X�A�H��ڴN�|��ΤF�C
<p>
4. Zend Studio Client
���I�G�ӷ~�n��B�ܺC (���վ��������O)�C
�u�I�G���G�]�i�H�ŦX�ݨD�A���L�]���ӺC�F�A�S���J�Ӵ��չL�C
<p>
5. Notepad++
���I�G�L�k���� BOM �X�C
�u�I�G�㦳�P�|�h���\��B�i�ۭq�{���y�k�榡�B����ơC 
</html>