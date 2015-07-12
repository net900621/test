<?php
/***************************************************************************
 * 
 * Copyright (c) 2015 Baidu.com, Inc. All Rights Reserved
 * $Id$ 
 * 
 **************************************************************************/



/**
 * @file ColourMsg.php
 * @author work(zhangyouchang@baidu.com)
 * @date 2015/01/08 10:13:43
 * @version $Revision$ 
 * @brief 
 *  
 **/


class ColourMsg {

	public static $intDefaultLineLen = 100;
	public static $intDefaultContentLen = 80;
	public static $intDefaultTitleLen = 60;
	public static $strColourLineFormat = null;
	public static $strColourLineLast = null;
	public static $strColourPadUnit = null;

	public static $strTitleFontColour = null;
	public static $strTitleBackColour = null;
	public static $strContentFontColour = null;
	public static $strContentBackColour = null;
	public static $strFrameFontColour = null;
	public static $strFrameBackColour = null;

	public static $arrFontColourMap = array(
		'black'		=> '30m',		//黑色
		'red'		=> '31m',		//红色
		'green'		=> '32m',		//绿色
		'yellow'	=> '33m',		//黄色
		'blue'		=> '34m',		//蓝色
		'purple'	=> '35m',		//紫色
		'cerulean'	=> '36m',		//天蓝色
		'white'		=> '37m',		//白色
	);

	public static $arrBackColourMap = array(
		'black'		=> '40;',		//黑底
		'red'		=> '41;',		//红底
		'green'		=> '42;',		//绿底
		'yellow'	=> '43;',		//黄底
		'blue'		=> '44;',		//蓝底
		'purple'	=> '45;',		//紫底
		'cerulean'	=> '46;',		//天蓝色底
		'white'		=> '47;',		//白底
	);

	public static function setTitleColour ($strFontColour, $strBackColour) {
		if (empty($strFontColour) || !isset(self::$arrFontColourMap[$strFontColour])) {
			self::$strTitleFontColour = 'green';
		} else {
			self::$strTitleFontColour = $strFontColour;
		}
		if (empty($strBackColour) || !isset(self::$arrBackColourMap[$strBackColour])) {
			$strTitleBackColour = 'black';
		} else {
			self::$strTitleBackColour = $strBackColour;
		}

	}

	public static function setFrameColour ($strFontColour, $strBackColour) {
		if (empty($strFontColour) || !isset(self::$arrFontColourMap[$strFontColour])) {
			self::$strFrameFontColour = 'green';
		} else {
			self::$strFrameFontColour = $strFontColour;
		}
		if (empty($strBackColour) || !isset(self::$arrBackColourMap[$strBackColour])) {
			self::$strFrameBackColour = 'black';
		} else {
			self::$strFrameBackColour = $strBackColour;
		}
	}

	public static function setContentColour ($strFontColour, $strBackColour) {
		if (empty($strFontColour) || !isset(self::$arrFontColourMap[$strFontColour])) {
			self::$strContentFontColour = 'green';
		} else {
			self::$strContentFontColour = $strFontColour;
		}
		if (empty($strBackColour) || !isset(self::$arrBackColourMap[$strBackColour])) {
			self::$strContentBackColour = 'black';
		} else {
			self::$strContentBackColour = $strBackColour;
		}
	}


	public static function getColourMsg ($strMsg, $strFontColour, $strBackColour, $boolBlink = false, $boolRow = true) {
		if (empty($strMsg)) {
			return false;
		}

		if (empty($strFontColour)) {
			$strFontColour = self::$strContentFontColour;
		}
		if (empty($strFontColour) || empty(self::$arrFontColourMap[$strFontColour])) {
			$strFontColour = 'green';
		}
		if (empty(self::$strContentBackColour)) {
			self::$strContentFontColour = $strFontColour;
		}

		if (empty($strBackColour)) {
			$strBackColour = self::$strContentBackColour;
		}
		if (empty($strBackColour) || !isset(self::$arrBackColourMap[$strBackColour])) {
			$strBackColour = 'black';
		}
		if (empty(self::$strContentBackColour)) {
			self::$strContentBackColour = $strBackColour;
		}

		$strFontColour = self::$arrFontColourMap[$strFontColour];
		$strBackColour = self::$arrBackColourMap[$strBackColour];

		$strPre = "\033[";
		$strSuffix = "\033[m";
		if ($boolRow) {
			$strSuffix = $strSuffix . "\n";
		}
		$str = "";
		$str .= $strPre;
		if ($boolBlink) {
			$str .= "5;";
		}
		#$str = $str . $strBackColour . $strFontColour . ' ' . $strMsg . ' ' . $strSuffix;
		$str = $str . $strBackColour . $strFontColour .  $strMsg . $strSuffix;
		return $str;

	}

	public static function formatFrame ($strFontColour = null, $strBackColour = null, $boolBlink = false) {
		if (empty($strFontColour)) {
			$strFontColour = self::$strFrameFontColour;
		}

		if (empty($strFontColour)) {
			$strFontColour = 'purple';
		}

		if (empty(self::$arrFontColourMap[$strFontColour])) {
			$strFontColour = 'purple';
			self::$strFrameFontColour = $strFontColour;
		}
		if (empty($strBackColour)) {
			$strBackColour = 'black';
		}
		if (empty(self::$arrBackColourMap[$strBackColour])) {
			$strBackColour = 'black';
			self::$strFrameBackColour = $strBackColour;
		}

		if (empty(self::$strColourLineFormat)) {
			$strLineFormat = '|';
			self::$strColourLineFormat = self::getColourMsg($strLineFormat,
				$strFontColour,
				$strBackColour,
				$boolBlink,
				false
			);
		}
		if (empty(self::$strColourLineLast)) {
			$strLineLast = '-';
			$strColourLast = str_pad($strLineLast, self::$intDefaultLineLen, '-', STR_PAD_BOTH);
			self::$strColourLineLast = self::getColourMsg($strColourLast, 
				$strFontColour, 
				$strBackColour,
				$boolBlink
			);
		}

		if (empty(self::$strPadUnit)) {
			$strLinePadUnit = '-';
			self::$strColourPadUnit = self::getColourMsg($strLinePadUnit, 
				$strFontColour,
				$strBackColour, 
				false,
				false
			);
		}	

		#echo self::$strColourPadUnit;
		#echo self::$strColourLineLast;
		#echo self::$strColourLineFormat;
	}

	public static function formatTitle ($strTitle, $strFontColour, $strBackColour, $boolBlink = false) {

		if (empty($strFontColour)) {
			$strFontColour = self::$strTitleFontColour;
		}

		if (empty($strFontColour)) {
			$strFontColour = 'blue';
		}

		if (empty(self::$arrFontColourMap[$strFontColour])) {
			$strFontColour = 'blue';
		}
		if (empty(self::$strTitleFontColour)) {
			self::$strTitleFontColour = $strFontColour;
		}

		if (empty($strBackColour)) {
			$strBackColour = 'black';
		}
		if (empty(self::$arrBackColourMap[$strBackColour])) {
			$strBackColour = 'black';
		}
		if (empty(self::$strTitleBackColour)) {
			self::$strTitleBackColour = $strBackColour;
		}


		$intTitleLen = strlen($strTitle);
		$i = 0;
		$intContentLen = (self::$intDefaultLineLen - self::$intDefaultTitleLen) / 2;
		$strMiddle = '';
		for ($i = 0; $i < self::$intDefaultLineLen; $i++) {
			if ($intContentLen > $i || (self::$intDefaultLineLen - $intContentLen) < $i) {
				$strPadTmp = ' ';
			} else {
				$strPadTmp = self::$strColourPadUnit;	
			}
			$strMiddle .= $strPadTmp;
		}
		echo $strMiddle."\n";

		$intStartIndex = 0;
		$intCur = 0;
		$signleLineLen = self::$intDefaultTitleLen - 6;
		$i = 0;
		$intLineNum = $intTitleLen / self::$intDefaultTitleLen;
		while ($intTitleLen > $intStartIndex) {
				$str = ' ';
			$strTmp = substr($strTitle, $intStartIndex, $signleLineLen);
			$strTmp = str_pad($strTmp, self::$intDefaultTitleLen, ' ', STR_PAD_BOTH);
			$strTmp = self::getColourMsg($strTmp, $strFontColour, $strBackColour, $boolBlink, false);
			$strPadTmp = ' ';
			for ($j = 0; $j < $intContentLen - 1; $j++) {
				$str .= $strPadTmp;
			}
			$str .= self::$strColourLineFormat;
			$str .= $strTmp;
			$str .= self::$strColourLineFormat;

			for ($j = self::$intDefaultTitleLen + 1; $j < self::$intDefaultLineLen - $intContentLen; $j++) {
				$str .= $strPadTmp;
			}
			echo $str."\n";
			$intStartIndex += $signleLineLen;
			$i++;
		}
		echo self::$strColourLineLast;
	}

	
	public static function formatSingleLine ($strLine, $strFontColour, $strBackColour, $boolBlink = false) {
		if (empty($strFontColour)) {
			$strFontColour = self::$strContentFontColour;
		}

		if (empty($strFontColour)) {
			$strFontColour = 'blue';
		}

		if (empty(self::$arrFontColourMap[$strFontColour])) {
			$strFontColour = 'blue';
		}
		if (empty(self::$strContentFontColour)) {
			self::$strContentFontColour = $strFontColour;
		}

		if (empty($strBackColour)) {
			$strBackColour = 'black';
		}
		if (empty(self::$arrBackColourMap[$strBackColour])) {
			$strBackColour = 'black';
		}
		if (empty(self::$strContentBackColour)) {
			self::$strContentBackColour = $strBackColour;
		}

		$intLineLen = strlen($strLine);
		$i = 0;
		
		$intStartIndex = 0;
		$intCur = 0;
		if (self::$intDefaultContentLen >= self::$intDefaultLineLen) {
			self::$intDefaultContentLen = self::$intDefaultLineLen - 2;
		}
		$signleLineLen = self::$intDefaultContentLen;
		$i = 0;
		while ($intLineLen > $intStartIndex) {
			$str = self::$strColourLineFormat;
			$strTmp = substr($strLine, $intStartIndex, $signleLineLen);
			$strTmp = str_pad($strTmp, self::$intDefaultLineLen - 2, ' ', STR_PAD_RIGHT);
			$strTmp = self::getColourMsg($strTmp, $strFontColour, $strBackColour, $boolBlink, false);
			$str .= $strTmp;
			$str .= self::$strColourLineFormat;
			$intStartIndex += $signleLineLen;
			$i++;
			echo $str."\n";
		}
	}

	public static function display ($strTitle, $mixMsg, $boolBlink = false) {
		
		if (empty(self::$strFrameBackColour) || empty(self::$strFrameFontColour)) {
			self::setFrameColour('cerulean', 'black');
		}
		if (empty(self::$strTitleBackColour) || empty(self::$strTitleFontColour)) {
			self::setTitleColour('blue', 'black');
		}
		if (empty(self::$strContentBackColour) || empty(self::$strContentFontColour)) {
			self::setContentColour('yellow', 'black');
		}

		ColourMsg::formatFrame(null, null);
		ColourMsg::formatTitle($strTitle, null, null);

		if (is_string($mixMsg) || is_numeric($mixMsg)) {
			$strMsg = $mixMsg;
		} else {
			$jsonMsg = json_encode($mixMsg);
			$arrMsg = json_decode($jsonMsg, true);
			#$strMsg = var_export($arrMsg, true);
			$strMsg = print_r($arrMsg, true);
		}

		$arrMsg = explode("\n", $strMsg);

		foreach ($arrMsg as $strLine) {
			self::formatSingleLine ($strLine, null, null, $boolBlink);
		}

		echo self::$strColourLineLast;
	}

	public static function show ($strTitle, $mixMsg, $strFontColour, $strBackColour, $boolBlink = false) {

		if (is_string($mixMsg) || is_numeric($mixMsg)) {
			$strMsg = $mixMsg;
		} else {
			$jsonMsg = json_encode($mixMsg);
			$arrMsg = json_decode($jsonMsg, true);
			$strMsg = var_export($arrMsg, true);
		}

		$arrMsg = explode("\n", $strMsg);
		$intMaxLen = 0;

		$intMaxLen += 6;

		if (100 >= $intMaxLen) {
			$intMaxLen = 80;
		}

		//打印表头
		$strTitle = str_pad($strTitle, $intMaxLen, '-', STR_PAD_BOTH);
		$strColorTitle = self::getColourMsg($strTitle, 'purple', 'black', false);
		echo $strColorTitle;

		//设置格式
		$strLineFormat = '|';
		$strColourLineFormat = self::getColourMsg($strLineFormat, 'purple', 'black', false, false);
		$strLineLast = '-';
		$strColourLast = str_pad($strLineLast, $intMaxLen, '-', STR_PAD_BOTH);
		$strColourLineLast = self::getColourMsg($strColourLast, 'purple', 'black', false);
		foreach ($arrMsg as $strLine) {
			var_dump($strLine);
			echo $strColourLineFormat;
			$strLine = str_pad($strLine, $intMaxLen - 6, ' ', STR_PAD_RIGHT);
			$strColourLine = self::getColourMsg($strLine, $strFontColour, $strBackColour, $boolBlink, false);
			echo $strColourLine;
			echo $strColourLineFormat;
			echo "\n";
		}
		echo $strColourLineLast;
	}

}

/*
$arrTest = array(
	"aaa" => "aaaa",
	"bb"	=> 'dddddd',
	"c" => array(
		"xx" => array(
			'ee' => array(
				'fff1' => 'ddddd',
				'fff2' => 'ddddd',
				'fff3' => 'ddddd',
				'fff4' => 'dddddaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa',
			),
		),
	),
);


ColourMsg::setContentColour('red', 'blue');
ColourMsg::display('aaaaaaa4', $arrTest);
 */







/* vim: set ts=4 sw=4 sts=4 tw=100 */
?>
