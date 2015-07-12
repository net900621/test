<?php
/***************************************************************************
 * 
 * Copyright (c) 2015 Baidu.com, Inc. All Rights Reserved
 * $Id$ 
 * 
 **************************************************************************/



/**
 * @file Request.php
 * @author work(zhangyouchang@baidu.com)
 * @date 2015/01/08 09:54:14
 * @version $Revision$ 
 * @brief 
 *  
 **/

require_once dirname(__FILE__) . '/Init.php';

class Request {

	private static $objParamHandler;

	public function __Construct () {
		if (!is_object(self::$objParamHandler) || empty(self::$objParamHandler)) {
			self::$objParamHandler = new ParamHandler();
		}
	}


	public function getLocationFromHeader ($strHeader) {
		if (empty($strHeader)) {
			return '';
		}
		$strLocationTmp = preg_match("/Location:([^\r\n]*)/i", $strHeader, $matches);
		if (!isset($matches[1]) || empty($matches[1])) {
			$matches[1] = '';
		}
		return trim($matches[1]);
	}

	public function doRequest ($arrInterface, $arrUserInfo, $arrChange, $strAction, $boolShowLog) {

		if (empty($arrInterface)) {
			return -1;
		}
		$arrParam = self::$objParamHandler->genData($arrInterface['args'], $arrChange, $strAction);
		if ($arrInterface['needCookie']) {
			$arrInterface['host'][CURLOPT_COOKIE] = $arrUserInfo['cookie'];
		}

		if(empty($strAction)){
			$arrParam = array();
		}

		$boolLoopFlag = true;

		while($boolLoopFlag){

			if($arrInterface['isPost']){
				$ret = Curl_class::curl_post($arrInterface['url'], $arrParam, $arrInterface['host']);
			}else{
				$ret = Curl_class::curl_get($arrInterface['url'], $arrParam, $arrInterface['host']);
			}
			$mixBody = json_decode($ret['body'], true);
			if (!is_array($mixBody)) {
				$mixBody['body'] = $ret['body'];
			}

			
			$strHeader = $ret['header'];
			if ($boolShowLog) {
				ColourMsg::display("interface", $arrInterface);
				ColourMsg::display("arrChange", $arrChange);
				ColourMsg::display("param", $arrParam);
				ColourMsg::display("arrUserInfo", $arrUserInfo);
				ColourMsg::display("Cookie", $arrInterface['host']);
				unset($ret['header']);
				ColourMsg::display("request result", $ret);
			}

			if ($ret['http_code'] != 200){
				if (302 === $ret['http_code']) {
					$mixBody['http_code'] = 302;
					$mixBody['location'] = $this->getLocationFromHeader($strHeader);
					$boolLoopFlag = false;
				} else {
					$boolLoopFlag = true;
				}
			}else{
				$mixBody['http_code'] = 200;
				$mixBody['location'] = '';
				$boolLoopFlag = false;
			}
		}
		return $mixBody;
	}
	
	/*
	*@arrInterface 请求的接口
	*@strUrlPram url拼接的参数url
	*@arrUserInfo 用户信息
	*@boolShowLog 是否显示log
	*/
	public function doRequestParam ($arrInterface, $strUrlPram, $arrUserInfo, $boolShowLog) {
		
		if (empty($arrInterface)) {
			return -1;
		}
		if ($arrInterface['needCookie']) {
			$arrInterface['host'][CURLOPT_COOKIE] = $arrUserInfo['cookie'];
		}
	
		$boolLoopFlag = true;
		$strUrl = $arrInterface['url'].'/'.$strUrlPram;
		while($boolLoopFlag){
			if($arrInterface['isPost']){
				//$ret = Curl_class::curl_post($strUrl, NULL, $arrInterface['host']);
			}else{
				$ret = Curl_class::curl_get($strUrl, NULL,$arrInterface['host']);
			}
			$mixBody = json_decode($ret['body'], true);
			if (!is_array($mixBody)) {
				$mixBody['body'] = $ret['body'];
			}
	
	
			$strHeader = $ret['header'];
			if ($boolShowLog) {
				ColourMsg::display("interface", $arrInterface);
				ColourMsg::display("StrUrl", $strUrl);
				ColourMsg::display("arrUserInfo", $arrUserInfo);
				ColourMsg::display("Cookie", $arrInterface['host']);
				unset($ret['header']);
				ColourMsg::display("request result", $ret);
			}
	
			if ($ret['http_code'] != 200){
				if (302 === $ret['http_code']) {
					$mixBody['http_code'] = 302;
					$mixBody['location'] = $this->getLocationFromHeader($strHeader);
					$boolLoopFlag = false;
				} else {
					$boolLoopFlag = true;
				}
			}else{
				$mixBody['http_code'] = 200;
				$mixBody['location'] = '';
				$boolLoopFlag = false;
			}
		}
		return $mixBody;
	}

	/*
	*@arrInterface 请求的接口
	*@strUrlPram url拼接的参数url
	*@arrUserInfo 用户信息
	*@arrchange 传递的参数
	*@strAction 请求的动作
	*@boolShowLog 是否显示log
	*/
	public function doRequestParam2 ($arrInterface,$strUrlPram, $arrUserInfo, $arrChange, $strAction, $boolShowLog) {
		if (empty($arrInterface)) {
			return -1;
		}
		$arrParam = self::$objParamHandler->genData($arrInterface['args'], $arrChange, $strAction);
		if ($arrInterface['needCookie']) {
			$arrInterface['host'][CURLOPT_COOKIE] = $arrUserInfo['cookie'];
		}

		if(empty($strAction)){
			$arrParam = array();
		}
        $strUrl =  $arrInterface['url'].'?'.$strUrlPram;
		var_dump($arrParam);
		$boolLoopFlag = true;
		while($boolLoopFlag){

			if($arrInterface['isPost']){
				$ret = Curl_class::curl_post($strUrl, $arrParam, $arrInterface['host']);
			}else{
				$ret = Curl_class::curl_get($strUrl, $arrParam, $arrInterface['host']);
			}
			$mixBody = json_decode($ret['body'], true);
			if (!is_array($mixBody)) {
				$mixBody['body'] = $ret['body'];
			}

			
			$strHeader = $ret['header'];
			if ($boolShowLog) {
				ColourMsg::display("interface", $arrInterface);
				ColourMsg::display("strUrl", $strUrl);
				ColourMsg::display("arrChange", $arrChange);
				ColourMsg::display("param", $arrParam);
				ColourMsg::display("arrUserInfo", $arrUserInfo);
				ColourMsg::display("Cookie", $arrInterface['host']);
				unset($ret['header']);
				ColourMsg::display("request result", $ret);
			}

			if ($ret['http_code'] != 200){
				if (302 === $ret['http_code']) {
					$mixBody['http_code'] = 302;
					$mixBody['location'] = $this->getLocationFromHeader($strHeader);
					$boolLoopFlag = false;
				} else {
					$boolLoopFlag = true;
				}
			}else{
				$mixBody['http_code'] = 200;
				$mixBody['location'] = '';
				$boolLoopFlag = false;
			}
		}
		return $mixBody;
	}

}



















/* vim: set ts=4 sw=4 sts=4 tw=100 */
?>
