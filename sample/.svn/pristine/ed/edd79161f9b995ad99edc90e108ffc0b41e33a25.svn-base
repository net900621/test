<?php
/***************************************************************************
 * 
 * Copyright (c) 2013 Baidu.com, Inc. All Rights Reserved
 * $Id$ 
 * 
 **************************************************************************/
 
 
 
/**
 * @file ParamsHandler.class.php
 * @author zhangyouchang(zhangyouchang@baidu.com)
 * @date 2013/11/06 16:52:23
 * @version $Revision$ 
 * @brief 
 *  
 **/




defined('DEBUG') ? DEBUG : define('DEBUG', false);

class ParamHandler{
	/**
	 *
	 * 检查arrChanged数组中的key是否存在于默认的数组中
	 * $arrSrc必须是数组，
	 * $arrChanged如果是数组，则得出到的结果为$ret['exist']为存在的key，$ret['nonexist']为不存在的key
	 * $arrChanged不是数组，则返回结果为$ret['exist'] NULL, $ret['nonexist']为$arrSrc的key
	 **/
	private function checkModfiyKeys($arrSrc, $arrChanged){
		$ret = array();
		if(!is_array($arrSrc)){
			if(DEBUG){
				echo "arrSrc must be an array\n";
			}	
			return false;
		}
		$default_keys = array_keys($arrSrc);
		if(!is_array($arrChanged)){
			$ret['exist'] = NULL;
			$ret['nonexist'] = $default_keys;
			return $ret;
		}
		$changed_keys = array_keys($arrChanged);
		foreach($changed_keys as $key){
			if(in_array($key, $default_keys, true)){
				$ret['exist'][] = $key; 
			}else{
				$ret['nonexist'][] = $key;
			}
		}
		if(isset($ret['nonexist'])){
			if(DEBUG){
				echo "those key donot exist in configured :".print_r($ret['nonexist'],true);
			}
		}
		return $ret;
	}

	public function genData($arrSrc, $arrModify, $action){
		$keyExistInfo = $this->checkModfiyKeys($arrSrc, $arrModify);
		if(DEBUG){
			echo "keyExistInfo--------------".print_r($keyExistInfo,true);
			echo "arrSrc---init-------------".print_r($arrSrc,true);
			echo "arrModify-----------------".print_r($arrModify,true);
		}

		if(!isset($arrModify)){
			return $arrSrc;
		}
		
		if('modify' == $action || 'unset' == $action){
			if(isset($keyExistInfo['exist']) && is_array($keyExistInfo['exist']) && !isset($keyExistInfo['nonexist'])){
				if('unset' == $action){
					foreach($keyExistInfo['exist'] as $key){
						unset($arrSrc[$key]);
					}
				}else{
					if(DEBUG){
						echo "keyExistInfo['exist']-----------".print_r($keyExistInfo['exist'], true);
					}
					foreach($keyExistInfo['exist'] as $k){
						if(DEBUG){
							echo "keyExistInfo['exist']-----------$k\n";
						}
						$arrSrc[$k] = $arrModify[$k];
					}
				}
			}else{
				return false;
			}
		}elseif('modify&unset' == $action){
			if(isset($keyExistInfo['exist']) && is_array($keyExistInfo['exist'])){
				foreach($keyExistInfo['exist'] as $k){
					if(is_null($arrModify[$k]) || 
					   !isset($arrModify[$k]) ||
					   ("" == $arrModify[$k])
				    ){
						unset($arrSrc[$k]);
					}else{
						$arrSrc[$k] = $arrModify[$k];
					}
				}
			}else{
				return false;
			}
		}elseif('modify&add' == $action){
			foreach($arrModify as $k=>$v){
				$arrSrc[$k] = $arrModify[$k];
			}
		}else{
			if(isset($keyExistInfo['exist']) && !isset($keyExistInfo['nonexist'])){
				return false;
			}else{
				foreach($arrModify as $k=>$v){
					$arrSrc[$k] = $v;
				}
			}
		}
		if(DEBUG){
			echo "generateData-----last------------".print_r($arrSrc,true);
		}
		return $arrSrc;
	}
}

















/* vim: set ts=4 sw=4 sts=4 tw=100 */
?>
