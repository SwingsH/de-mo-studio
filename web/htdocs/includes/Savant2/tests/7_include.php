<?php

/**
* 
* Tests default plugins
*
* @version $Id: 7_include.php,v 1.1 2004/10/04 01:52:24 pmjones Exp $
* 
*/

error_reporting(E_ALL);

require_once 'Savant2.php';

$conf = array(
	'template_path' => 'templates',
	'resource_path' => 'resources'
);

$savant = new Savant2($conf);

$array = array(
	'key0' => 'val0',
	'key1' => 'val1',
	'key2' => 'val2',
);

$var1 = 'variable1';
$var2 = 'variable2';
$var3 = 'variable3';

$ref1 = 'reference1';
$ref2 = 'reference2';
$ref3 = 'reference3';

// assign vars
$savant->assign($var1, $var1);
$savant->assign($var2, $var2);
$savant->assign($var3, $var3);

// assigns $array to a variable $set
$savant->assign('set', $array);

// assigns the keys and values of array
$savant->assign($array);

// assign references
$savant->assignRef($ref1, $ref1);
$savant->assignRef($ref2, $ref2);
$savant->assignRef($ref3, $ref3);

// load the cycle plugin with preset cycle values
$savant->loadPlugin(
	'cycle',
	array(
		'values' => array(
			'lightdark' => array('light', 'dark')
		)
	)
);

// run through the template
$savant->display('main.tpl.php');

?>