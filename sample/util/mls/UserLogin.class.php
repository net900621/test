<?php
/***************************************************************************
 * 
 * Copyright (c) 2015 Meilishuo.com, Inc. All Rights Reserved
 * $Id$ 
 * 
 **************************************************************************/
 
 
 
/**
 * @file UserLogin.class.php
 * @author MLS(zhangyouchang@meilishuo.com)
 * @date 2015/05/25 09:28:34
 * @version $Revision$ 
 * @brief 
 *  
 **/

class UserLogin {

	private static $objInstance = null;

	private static $strEnv = null;

	public static $arrEnvConf = null;

	private function __construct ($strEnv = 'lab7') {
		self::$strEnv = $strEnv;
		self::$arrEnvConf[self::$strEnv] = array();
		if (null === $objInstance) {
			self::$objInstance = new UserLogin (self::$strEnv);
		}
		if (!is_object(self::$objInstance)) {
			self::$objInstance = new UserLogin (self::$strEnv);
		}
		self::$arrEnvConf[self::$strEnv]['obj'] = self::$objInstance;
	}

	public static function getInstance ($strEnv = 'lab7') {
		$strEnv = 'lab7';
		$strUrl = 'http://www.';
		switch ($strEnv) {
			case 'lab1'		:	$strEnv = 'lab7';
			case 'lab2'		:	$strEnv = 'lab7';
			case 'lab3'		:	$strEnv = 'lab7';
			case 'lab4'		:	$strEnv = 'lab7';
			case 'lab5'		:	$strEnv = 'lab7';
			case 'lab6'		:	$strEnv = 'lab7';
			case 'lab7'		:	$strEnv = 'lab7';
			case 'lab8'		:	$strEnv = 'lab7';
			case 'lab9'		:	$strEnv = 'lab7';
			case 'lab10'	:	$strEnv = 'lab7';
			case 'lab11'	:	$strEnv = 'lab7';
			case 'newlab'	:	$strEnv = 'lab7';
			default			:	$strEnv = 'lab7'; $strUrl .= $strEnv . '.qalab' ; break;
		}
		$strUrl .= '.meilishuo.com';
		$
	}

}




















/* vim: set ts=4 sw=4 sts=4 tw=100 */
?>
