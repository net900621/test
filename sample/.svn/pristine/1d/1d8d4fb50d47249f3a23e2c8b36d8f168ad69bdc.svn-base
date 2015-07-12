<?php		  /**<        */
/***************************************************************************
 * 
 * Copyright (c) 2015 Meilishuo.com, Inc. All Rights Reserved
 * $Id$ 
 * 
 **************************************************************************/



/**
 * @file SnakeCartV4.conf.php
 * @author MLS(zhangyouchang@meilishuo.com)
 * @date 2015/05/21 14:21:20
 * @version $Revision$ 
 * @brief 
 *  
 **/


class SnakeAccountloginV4Conf {

	public $cart_list;				//用户购物车详情
//	public $cart_update;			//更新购物车商品数量
//	public $cart_remove;			//移除购物车商品

	public function __construct($arrInitConf) {
		if (empty($arrInitConf)) {
			die('init error!!!!!!!!!!!!!!\n');
		}

		//public $cart_list;             //用户购物车详情
		$this->cart_list['needCookie']   = true;			//cookie信息即登陆信息，需要cookie表示需要登陆
		$this->cart_list['needToken']   = true;				//需要携带access_token信息
		$this->cart_list['needHeader']   = false;			//virus接口需要携带header信息
		$this->cart_list['isPost']       = false;
		$this->cart_list['isHttps']      = false;
		$this->cart_list['suffix']       = '/2.0/profile/feed';
		$this->cart_list['args']         = array(
            'userid'	=> 1,			//1表示请求userid数据
            'type'      =>1,
		);
/*
		//public $cart_update;             //更新购物车商品数量
		$this->cart_update['needCookie']   = true;			//cookie信息即登陆信息，需要cookie表示需要登陆
		$this->cart_update['needToken']   = true;			//需要携带access_token信息
		$this->cart_update['needHeader']   = false;			//virus接口需要携带header信息
		$this->cart_update['isPost']       = false;
		$this->cart_update['isHttps']      = false;
		$this->cart_update['suffix']       = '/2.0/cart/list';
		$this->cart_update['args']         = array(
			'param'	=> 'sid_amount,sid_amount',				
		);

*/

		$arrFilter = array(
			);

		$arrApis = get_class_vars(get_class($this));

		foreach ($arrApis as $strApi => $mixValue) {
			if (!in_array($strApi, $arrFilter)) {

				$tmp = $this->$strApi;

				if (!is_array($tmp)) {
					continue;
				}
				if ($tmp['needCookie']) {
					$tmp['host'][CURLOPT_COOKIE] = 'MEILISHUO_MM=' . $arrInitConf['arrDefaultUserInfo']['cookie'];
				}
				$tmp['ip'] = $arrInitConf['ip'];
				$tmp['port'] = $arrInitConf['port'];
				$tmp['host'][CURLOPT_HTTPHEADER][] = 'Host:' . $arrInitConf['host'];
				if ($tmp['needHeader']) {
					$tmp['host'][CURLOPT_HTTPHEADER][]= 'Meilishuo:ip:'.gethostbyname('jxq-qatest-09').';v:0;uid:' . $arrInitConf['arrDefaultUserInfo']['uid'];
				}
				if (null !== $tmp['port']) {
					if ($tmp['isHttps']) {
							$tmp['url'] = 'https://' . $tmp['ip'] . ':' . $tmp['port'] . $tmp['suffix'];
					} else {
						$tmp['url'] = 'http://' . $tmp['ip'] . ':' . $tmp['port'] . $tmp['suffix'];
					}
				} else {
					if ($tmp['isHttps']) {
						$tmp['url'] = 'https://' . $tmp['ip'] . $tmp['suffix'];
					} else {
						$tmp['url'] = 'http://' . $tmp['ip'] . $tmp['suffix'];
					}
				}
				if ($tmp['needToken']) {
					$tmp['url'] .= '?access_token=' . $arrInitConf['arrDefaultUserInfo']['access_token'];
				}
				$this->$strApi = $tmp;
			}
		}
	}



}


















/* vim: set ts=4 sw=4 sts=4 tw=100 */
?>
