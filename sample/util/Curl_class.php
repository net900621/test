<?php
/***************************************************************************
 * 
 * Copyright (c) 2011 Baidu.com, Inc. All Rights Reserved
 * 
 **************************************************************************/
/**             
 * @file curl.php
 * @author jinerhui(jinerhui@baidu.com)
 * @date 2012/09/23 15:57:50
 * @version $Revision$ 
 * @brief       
 *  
 **/
final class Curl_class
{
	/**
	 * 
	 * 对 curl get 请求的常用设置的封装
	 * @param string $url
	 * @param array $arr_get optional
	 * 	get请求参数数组 
	 * @param array $arr_opt optional
	 * 	设置 php_curl 的 CURLOPT_XXX 数组
	 * 
	 * @return 请求结果数组，包含 url/http_code/header/body
	 */

	static function curl_get($url,$arr_get=array(),$arr_opt = array(), $encode = true)
	{
		$arr_ret = array();
		$queryString = "";
		if(!empty($arr_get)){
			foreach($arr_get as $key => $value){
				$queryString .= $key."=".$value."&";
			}
			$queryString = substr($queryString, 0, strlen($queryString) - 1);
		}

		$defaults = array(
				CURLOPT_URL => empty($arr_get) ? $url : ($url. (strpos($url, '?') === FALSE ? '?' : '&'). http_build_query($arr_get)), 
				CURLOPT_HEADER =>1,
				CURLOPT_USERAGENT =>'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2; SV1; .NET CLR 1.1.4322)',
				CURLOPT_TIMEOUT => 10,
				CURLOPT_HEADER =>1,
				CURLOPT_RETURNTRANSFER => TRUE,
				);
		if(!$encode){
			$defaults[CURLOPT_URL] = empty($arr_get) ? $url : ($url. (strpos($url, '?') === FALSE ? '?' : '&'). $queryString);
		}
		$ch = curl_init();
		curl_setopt_array($ch, $defaults + $arr_opt);
		$content = curl_exec($ch);
		$arr = curl_getinfo($ch);
		$arr_ret["url"]			= $arr["url"];
		$arr_ret["http_code"] 	= $arr["http_code"];
		$arr_ret["header"]	 	= substr($content,0,$arr["header_size"]);
		$arr_ret["body"]	  	= substr($content,$arr["header_size"]);
		$res_sta = stripos($arr_ret["body"],'request_id')-2;
		$arr_ret["response"]    = substr($arr_ret["body"],$res_sta);
		$arr_ret["size"]	 	= $arr["download_content_length"];
		if(302 == $arr_ret["http_code"]){
			$tmp = explode("\r", $arr_ret["header"]);
			foreach($tmp as $t){
				if(false !== stripos($t, "Location:")){
					$arr_ret['redirect_url'] = substr(rtrim(trim($t)), strlen("Location:") + 1);
				}
			}
		}
		curl_close($ch);
		return $arr_ret;
	}

	/**
	 * 
	 * 对 curl post 请求的常用设置的封装
	 * @param string $url
	 * @param array $arr_post
	 * 	post请求参数数组 
	 * @param array $arr_opt optional
	 * 	设置 php_curl 的 CURLOPT_XXX 数组
	 * 
	 * @return 请求结果数组，包含 url/http_code/header/body
	 */
	static function curl_post($url,$arr_post,$arr_opt = array(), $encode = true)
	{
		$arr_ret = array();
		$defaults = array(
				CURLOPT_URL => $url, 
				CURLOPT_HEADER =>1,
				CURLOPT_USERAGENT =>'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2; SV1; .NET CLR 1.1.4322)',
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_TIMEOUT => 10,
				CURLOPT_HEADER =>1,
				CURLOPT_POST => 1,
				CURLOPT_POSTFIELDS => http_build_query($arr_post),
				);     
		$queryString = "";
		if(!empty($arr_post)){ 
			foreach($arr_post as $key => $value){
				$queryString .= $key."=".$value."&";
			}
			$queryString = substr($queryString, 0, strlen($queryString) - 1);
		}
		if(!$encode){
			$defaults[CURLOPT_POSTFIELDS] = $queryString;
		}
		$ch = curl_init();
		foreach ($arr_opt as $key => $value) {
			$defaults[$key] = $value;
		}
		var_export($defaults);
		echo "\n";
		curl_setopt_array($ch, $defaults);
		//curl_setopt_array($ch,$defaults);
		$content = curl_exec($ch);
		//print_r($content);
		$arr = curl_getinfo($ch);
		$arr_ret["url"]         = $arr["url"];
		$arr_ret["http_code"]   = $arr["http_code"];
		$arr_ret["header"]      = substr($content,0,$arr["header_size"]);
		$arr_ret["body"]        = substr($content,$arr["header_size"]);
		$res_sta = stripos($arr_ret["body"],'request_id')-2;
		$arr_ret["response"]    = substr($arr_ret["body"],$res_sta);
		//print_r($arr_ret);
		curl_close($ch);
		return $arr_ret;
	}

	/**
	 * 
	 * 对 curl put 请求的常用设置的封装
	 * @param string $url
	 * @param array $arr_opt optional
	 * 	设置 php_curl 的 CURLOPT_XXX 数组
	 * 	必须设置 CURLOPT_INFILE 和 CURLOPT_INFILESIZE
	 * 
	 * @return 请求结果数组，包含 url/http_code/header/body
	 */
	static function curl_put($url, $arr_opt )
	{
		$arr_ret = array();
		$defaults = array(
				CURLOPT_URL => $url,
				CURLOPT_PUT => 1,
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_HEADER => 1,
				CURLOPT_TIMEOUT => 10,
				CURLOPT_HEADER =>1,
				);
		$ch = curl_init();
		curl_setopt_array($ch,$defaults+$arr_opt);
		$content = curl_exec($ch);
		$arr = curl_getinfo($ch);
		$arr_ret["url"]         = $arr["url"];
		$arr_ret["http_code"]   = $arr["http_code"];
		$arr_ret["header"]      = substr($content,0,$arr["header_size"]);
		$arr_ret["body"]        = substr($content,$arr["header_size"]);
		curl_close($ch);
		return $arr_ret;
	}

	static function curl_head($url, $arr_get = array(), $arr_opt = array()){
		$arr_ret = array();
		$defaults = array(
				CURLOPT_URL => empty($arr_get) ? $url : ($url. (strpos($url, '?') === FALSE ? '?' : '&'). http_build_query($arr_get)), 
				CURLOPT_HEADER =>1,
				CURLOPT_USERAGENT =>'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2; SV1; .NET CLR 1.1.4322)',
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_NOBODY => true,
				CURLOPT_TIMEOUT => 10,
				CURLOPT_HEADER =>1,
				);
		$ch = curl_init();
		curl_setopt_array($ch, $defaults + $arr_opt);
		$content = curl_exec($ch);
		$arr = curl_getinfo($ch);
		$arr_ret["url"]			= $arr["url"];
		$arr_ret["http_code"] 	= $arr["http_code"];
		$arr_ret["header"]	 	= substr($content,0,$arr["header_size"]);
		$arr_ret["size"]	 	= $arr["download_content_length"];
		if(302 == $arr_ret["http_code"]){
			$tmp = explode("\r", $arr_ret["header"]);
			foreach($tmp as $t){
				if(false !== stripos($t, "Location:")){
					$arr_ret['redirect_url'] = substr(rtrim(trim($t)), strlen("Location:") + 1);
				}
			}
		}
		curl_close($ch);
		return $arr_ret;

	}

	static function curl_download($url, $arr_get, $arr_opt){
		$arr_ret = array();
		$defaults = array(
				CURLOPT_URL => empty($arr_get) ? $url : ($url. (strpos($url, '?') === FALSE ? '?' : '&'). http_build_query($arr_get)), 
				CURLOPT_HEADER =>1,
				CURLOPT_USERAGENT =>'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2; SV1; .NET CLR 1.1.4322)',
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_TIMEOUT => 10,
				CURLOPT_HEADER =>1,
				);
		$ch = curl_init();
		curl_setopt_array($ch, $defaults + $arr_opt);
		$content = curl_exec($ch);
		$arr = curl_getinfo($ch);
		$arr_ret["url"]			= $arr["url"];
		$arr_ret["http_code"] 	= $arr["http_code"];
		$arr_ret["header"]      = substr($content,0,$arr["header_size"]);
		$arr_ret["body"]        = substr($content,$arr["header_size"]);
		$res_sta = stripos($arr_ret["body"],'request_id')-2;
		$arr_ret["response"]    = substr($arr_ret["body"],$res_sta);

		if(!curl_errno($ch)){
			$nameArr = explode("/", $url);
			$last_index = count($nameArr) - 1;
			$file_name = $nameArr[$last_index];
			$localFile = dirname(__FILE__)."/../data/".$file_name;
			$fp = fopen($localFile, "w");
			if(false !== fwrite($fp, $arr_ret["body"])){
				$arr_ret["file_error"] = false;
				$arr_ret["size"] = $arr["download_content_length"];
				$arr_ret["response"]    = $localFile;
			}else{
				$arr_ret["file_error"] = true;
			}
			$arr_ret["body"]	  	= true;
			fclose($fp);
		}
		curl_close($ch);
		return $arr_ret;
	}
}


?>
