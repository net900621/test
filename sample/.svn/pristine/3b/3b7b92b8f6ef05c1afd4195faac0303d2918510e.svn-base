<?php
/***************************************************************************
 * 
 * Copyright (c) 2014 Baidu.com, Inc. All Rights Reserved
 * $Id$ 
 * 
 **************************************************************************/
 
/**
 * @file Init.php
 * @author zhangyouchang(zhangyouchang@baidu.com)
 * @date 2014/01/06 10:42:40
 * @version $Revision$ 
 * @brief 
 *  
 **/

$shortOpts = "d::o::";
$longOpts = array(
	"DEBUG::",
	"ONLINE::",
	"debug::",
	"online::",
);

$options = @getopt($shortOpts, $longOpts);

/****************************************************************************************/
/**
 *
 * debug 宏定义，定义debug宏，作为判断依据
 *
 **/
defined("DEBUG")  ? DEBUG  : define("DEBUG",
			(isset($options["d"])) ||
			(isset($options["DEBUG"]) && !empty($options["DEBUG"]))	||
			(isset($options["debug"]) && !empty($options["debug"])));

/****************************************************************************************/
/**
 *
 * debug 宏定义，定义debug宏，作为判断依据
 *
 **/
defined("ONLINE") ? ONLINE : define("ONLINE",
			(isset($options["o"])) ||
			(isset($options["ONLINE"]) && !empty($options["ONLINE"])) ||
			(isset($options["ONLINE"]) && !empty($options["ONLINE"])));

require_once(dirname(__FILE__).'/Curl_class.php');
require_once(dirname(__FILE__).'/ParamsHandler.class.php');
require_once(dirname(__FILE__).'/DB.php');
require_once(dirname(__FILE__).'/ColourMsg.php');
require_once(dirname(__FILE__).'/Request.php');

/* vim: set ts=4 sw=4 sts=4 tw=100 */
?>
