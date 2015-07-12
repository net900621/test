<?php
/***************************************************************************
 * 
 * Copyright (c) 2015 Meilishuo.com, Inc. All Rights Reserved
 * $Id$ 
 * 
 **************************************************************************/
 
 
 
/**
 * @file Test_Snake_Cart_List_V4.php
 * @author youchangzhang(zhangyouchang@meilishuo.com)
 * @date 2015/06/25 17:01:48
 * @version $Revision$ 
 * @brief 
 *  
 **/


require_once dirname(__FILE__) . '/InitTestEnv.php';

class TestSnakeCartListV4 extends PHPUnit_Framework_TestCase {

	public function setUp (){
	
	}

	public function tearDown () {
	
	}


	public function data4TestCartListException () {
		global $objSnakeCartEnvConf;
		global $objSnakeCartV4Conf;

		$arrData = array();

		$arrData[] = array(
			'&',
			1
		);

		$arrData[] = array(
			"&",
			1
		);

		return $arrData;
	}

	/**
	 *
	 * @dataProvider data4TestCartListException
	 *
	 */
	public function testCartListException ($isHaiTao, $expect) {
		global $objSnakeCartV4Conf;
		global $objSnakeCartV4Conf;

		$arrCartListConf = $objSnakeCartV4Conf->cart_list;
		
		$param = $arrCartListConf['args'];
		$param['is_haitao'] = $isHaiTao;
		$ret = null;
		if ($arrCartListConf['isPost']) {
			$ret = Curl_class::curl_post($arrCartListConf['url'], $param, $arrCartListConf['host']);
		} else {
			$ret = Curl_class::curl_get($arrCartListConf['url'], $param, $arrCartListConf['host']);
		}
		

		//校验http_code
		$this->assertEquals(200, $ret['http_code']);
		$arrBody = json_decode($ret['body'], true);	
		#print_r($arrCartListConf);
		#print_r($ret);
		#print_r($arrBody);

		//校验返回结果内容,购物车里面只有1个商品
		$this->assertEquals(1, count($arrBody['data']['info']));
		//校验code
		$this->assertEquals(0, $arrBody['data']['code']);
		$this->assertEquals(101277, $arrBody['data']['info'][0]['shop_id']);
	}

}


















/* vim: set ts=4 sw=4 sts=4 tw=100 */
?>
