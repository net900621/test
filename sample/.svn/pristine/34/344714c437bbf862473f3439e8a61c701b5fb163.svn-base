<?php
/***************************************************************************
 * 
 * Copyright (c) 2014 Baidu.com, Inc. All Rights Reserved
 * $Id$ 
 * 
 **************************************************************************/
 
/**
 *
 * @file PrintLog.class.php
 * @author liyajie(liyajie01@baidu.com)
 * @date 2014/08/13 10:34
 * @version $Revision$ 
 * @brief 
 *  
 **/

require_once(dirname(__FILE__).'/Init.php');

defined('DEBUG') ? DEBUG : define('DEBUG', false);

class PrintLog {

	/**
	 *  函数名: PrintLog_Array 
	 *  描述：  作为调试信息打印函数，通过各种参数来对打印信息进行调整，便于调试。
	 *  参数：  $curlget_ret ：外部调用curl_get或curl_post返回的结果，也可以在外部再次
	 *                         调用json_decode，配合$json_array数组下标来使用。
	 *          $input_string: 是一个字符串类型，里面含有3个参数，分别为调用此函数的行号，
	 *                         标示开头，函数名。使用","进行分隔。
	 *          $json_flag:    表示该打印函数内部是是否需要再次调用json_decode，true为使能。
	 *	    $print_flag：   是否打印使能标示，如需打印则置为true
	 *
	 **/

	static function PrintLog_Array($curlget_ret, $input_string, $json_flag, $json_array, $print_flag) 
	{ 
		if($print_flag == false) {
			return 0;
		}

		if($curlget_ret === null) {
			echo "curlget_ret 为空！！！错误返回\n";
			return -1;
		}

		list($line_num, $head_string, $function_name) = split('[,]', $input_string);

		/**
		 *  通过json_flag来判断是否对curlget_reg进行格式转换，
		 *  如果不进行格式转换，则打印整个curl_get返回的结果，
		 *  如果进行格转则打印curl_get返回的body里面的内容。
		**/
		if($json_flag == true) {
			$json_ret = json_decode($curlget_ret[$json_array]);
		} else {
			$json_ret = $curlget_ret;
		}

		$log_array = array(
			"function_name" => $function_name,
			"line_num"	=> $line_num,
			"body_log" 	=> $json_ret,
		);

		echo "\n##############\t".$head_string." start   ####################\n";
		print_r($log_array);
		echo "\n##############\t".$head_string." end     ####################\n";

		return 0;
	}

	static function SaveLog_Arr(){
		return 0;
	}
}

/* vim: set ts=4 sw=4 sts=4 tw=100 */
?>
