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


require_once dirname(__FILE__) . '/InitSharemainEnv.php';

class TestSnakeSharemainV4 extends PHPUnit_Framework_TestCase {

	public function setUp (){
	
	}

	public function tearDown () {
	
	}


	public function data4TestCartListException () {
		global $objSnakeSharemainEnvConf;
		global $objSnakeSharemainV4Conf;

		$arrData = array();

		$arrData[] = array(
			'3433719669',
			1
		);

/*		$arrData[] = array(
			"&",
			1
		);
*/
		return $arrData;
	}

	/**
	 *
	 * @dataProvider data4TestCartListException
	 *
	 */
	public function testCartListException ($isHaiTao, $expect) {
//		global $objSnakeCartV4Conf;
//		global $objSnakeCartV4Conf;
		global $objSnakeSharemainEnvConf;
        global $objSnakeSharemainV4Conf;


		$arrCartListConf = $objSnakeSharemainV4Conf->cart_list;
		//print_r($arrCartListConf);
		//echo "\n";
		$param = $arrCartListConf['args'];

	//print_r($param);
	//echo "\n";

		$param['twitter_id'] = $isHaiTao;
		$ret = null;

	//	echo $arrCartListConf['url'];echo "\n";
		if ($arrCartListConf['isPost']) {
			$ret = Curl_class::curl_post($arrCartListConf['url'], $param, $arrCartListConf['host']);
		} else {
			$ret = Curl_class::curl_get($arrCartListConf['url'], $param, $arrCartListConf['host']);
		}
		

		//校验http_code
		$this->assertEquals(200, $ret['http_code']);
		$arrBody = json_decode($ret['body'], true);	
		#print_r($arrCartListConf);
//	print_r($ret);

		#print_r($arrBody);
		
		//echo $isHaiTao;
		//echo $arrBody['data']['twitter_id'];
		//校验返回结果的内容是否是传进去的twitter_id
		$this->assertEquals($isHaiTao, $arrBody['data']['twitter_id']);
		
		
		//检查是否有pic_url	
		$this->assertNotEmpty($arrBody['data']['pic_url']);
		//校验code
		//$this->assertEquals(0, $arrBody['data']['code']);
		//$this->assertEquals(101277, $arrBody['data']['info'][0]['shop_id']);
	}

}


















/* vim: set ts=4 sw=4 sts=4 tw=100 */
?>
