<?php
/*
  �{�� : big5 �r��B�z��ƶ�
  �ɦW : big5_func.inc
  �@�� : Pigo Chu<pigo@ms5.url.com.tw>
  ���� :
	�o�Ǩ�ƬO�H PHP4 �ӳB�z big5 �r��
	����H���i�H�ۥѴ��G���{��
	�g�o�ǵ{���O�ݨ� LinuxFab �W�Q�װϤW�ܦh�H��������D�~�g��
	�ڤ���O�ҷ|�o�ͤ�����D , �Y�� bug �ШӫH�Q�פ��n��|
	
  �ɶ� : 2005/8/20
  ���� : 0.24
  

  PS 1 : �ԲӦw�ˤ覡�P�ϥΤ覡�аѦ� readme.html 
  PS 2 : �������j�T��� iconv �ӳB�z�r�� , �@�̩|���ܸԲӪ�����, �Y�����D�� bug �� Email ����
  PS 3 : PHP �۱q 4.3.0 ����w�g�����䴩big5�r�� , �ĪG���� , ����ƶ��]�\���|�A���j�T��s�F
  	�]�����\�h��ƥi�H�� PHP 4.3.0 �Ӱ����ۦP�ĪG , ���L PHP 4.3.0 �|������ addslashes �B�z
  	���줸�r��...�O�i�����B
  	
  ���v���� :
  	���{�������K�O , ����H���i�H�ۥѭק�P���G
  	���O�Y���ק糧�{������{���X , �ЫO�d��l�@��(�N�O��)�����v�n��
  	
  
*/


define("BIG5_FILE_DIR" , dirname(__FILE__) );
# ���p CP950 �����D�i�H�令 BIG5
# define("BIG5_ENCODER" , "BIG5");
define("BIG5_ENCODER" , "CP950");

/* �{���}�l */

define("BIG5_UNICODE_START" , 0xa140);	// �ثe������ Unicocde �� BIG5 �r�_�l��
define("UTF16_FIRST_CHAR" ,chr(0xff).chr(0xfe));

// Big5 error handler function
function Big5ErrorHandler ($errno, $errstr, $errfile, $errline) {
  $debug = debug_backtrace();
  switch ($errno) {
  case E_USER_ERROR:
    echo "<br><b>Error: </b>$errstr in <b>".$debug[2][file] ."</b> on line " .$debug[2][line] ."<br>\n";
    exit(1);
    break;
  case E_USER_WARNING:
    echo "<br><b>Warring: </b>$errstr in <b>".$debug[2][file] ."</b> on line " .$debug[2][line] ."<br>\n";
    break;
  case E_USER_NOTICE:
    echo "<br><b>Notice: </b> [$errno] $errstr<br>\n";
    break;
    default:
    echo "Unkown error type: [$errno] $errstr<br>\n";
    break;
  }
}



if(function_exists("iconv"))
    include_once(BIG5_FILE_DIR . "/big5_func.iconv.php");
else
    include_once(BIG5_FILE_DIR . "/big5_func.default.php");

if(function_exists("mb_strlen"))
    define('BIG5_SUPPORT_MB',true);
else 
    define('BIG5_SUPPORT_MB',false);

function big5_isBig5($c="")
{

  $bc  = hexdec(bin2hex($c));
  if
  (
     ($bc>=0xa440 && $bc<= 0xc67e) ||
     ($bc>=0xc940 && $bc<= 0xf9fe) ||
     ($bc>=0xa140 && $bc<= 0xa3fe) ||
     ($bc>=0xc6a1 && $bc<= 0xc8fe)
  ) return true;

  return false;
}

// �p�⤤��r����
function big5_stroke($str="")
{

    $tab=@File(BIG5_FILE_DIR  ."/big5_stroke.tab");
    if(!$tab)
    {
        $error_handler = set_error_handler("Big5ErrorHandler");
        trigger_error ("big5_stroke() : Can not open file '" . BIG5_FILE_DIR . "/big5_stroke.tab'", E_USER_ERROR );
        restore_error_handler();

    }

    /* Ū���ഫ���ܰ}�C $StrokeMapping */
    $i=0;
    while(list($key,$val)=Each($tab))
    {
        $StrokeMapping[$i] = split(" ",$val);
        $StrokeMapping[$i][1] = HexDec($StrokeMapping[$i][1]);
        $StrokeMapping[$i][2] = HexDec($StrokeMapping[$i][2]);
        $i++;
    }

    $s1 = substr($str,0,1);
    $s2 = substr($str,1,1);
    $s  = Hexdec(Bin2hex($s1.$s2));

    if( big5_isBig5($s1.$s2) )
    {
        for($i=0;$i<count($StrokeMapping);$i++)
             if($StrokeMapping[$i][1] <= $s && $StrokeMapping[$i][2] >= $s)
                 return $StrokeMapping[$i][0];
    }
    else

        return false;

}

function big5_chunk_split($str, $chunklen=76 , $end="\r\n")
{
   $len = big5_strlen($str);
   $tmp = array();
   for($i=0 ; $i<$len ; $i+=$chunklen)
      $tmp[] = big5_substr($str,$i,$chunklen) ;

   return implode( $end , $tmp);
}

function big5_strpos($haystack ,$needle ,$offset=0) 
{
    if($offset < 0 || !is_int($offset))
    {
        $error_handler = set_error_handler("Big5ErrorHandler");
        trigger_error ("big5_strpos(string haystack,string needle,int <b>offset=0</b>) : offset must >= 0 or ignore", E_USER_WARNING );
        restore_error_handler();
        return false;
    }
    $needle_len = big5_strlen($needle);
    $len =big5_strlen($haystack);
    for($i=$offset ; $i<$len ; $i++)
    {
        if(big5_substr($haystack,$i,$needle_len) == $needle)
            return $i;
    }
    return false;
}

function big5_strrpos($haystack , $needle)
{
    $first_char = "";
    if( is_int($needle) )
    {
        $hex = dechex($needle);
        $first_char = chr(hexdec(substr($hex,0,2)));
        if(strlen($hex)>2)
            $first_char .= chr(hexdec(substr($hex,2,2)));
    }
    else
        $first_char = big5_substr($needle,0,1);

    $len =big5_strlen($haystack);
    for($i=$len ; $i>-1 ; $i--)
    {
         if(big5_substr($haystack,$i,1) == $first_char)
            return $i;
    }
    return false;
}

$_big5_slashchars = array();
$_big5_addslasheschars = array();

function _big5_init_slashchars() {
    global $_big5_slashchars,$_big5_addslasheschars;
    if(!count($_big5_slashchars)) {
    	$i=0;
    	
        for($j=0xa1; $j<0xc7 ; $j++)
        {
            $_big5_slashchars[$i++] = chr($j) . '\\';
            $_big5_addslasheschars[$i++] = chr($j) . "\\\\";
        }
        for($j=0xc1; $j<0xfa ; $j++)
        {
            $_big5_slashchars[$i++] = chr($j) . '\\';
            $_big5_addslasheschars[$i++] = chr($j) . "\\\\";
        }
    }
}


function big5_addslashes($str) {
    global $_big5_addslasheschars,$_big5_slashchars;
    _big5_init_slashchars();
    $ret_str = "";
    $ret_str = addslashes($str);
    $ret_str = str_replace( $_big5_addslasheschars , $_big5_slashchars ,$ret_str);
    return $ret_str;
}

function big5_stripslashes($str) {
    global $_big5_addslasheschars,$_big5_slashchars;
    _big5_init_slashchars();
    $ret_str = "";
    $ret_str = str_replace( $_big5_slashchars , $_big5_addslasheschars ,$str);
    $ret_str = stripslashes( $ret_str );
    return $ret_str;
}

?>