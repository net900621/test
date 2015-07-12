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


require_once dirname(__FILE__) . '/InitAccountloginEnv.php';

class TestSnakeAccountLoginV4 extends PHPUnit_Framework_TestCase {

	public function setUp (){
	
	}

	public function tearDown () {
	
	}


	public function data4TestCartListException () {
        global $objSnakeAccountloginEnvConf;
        global $objSnakeAccountloginV4Conf ;
		$arrData = array();

		$arrData[] = array(
			'121291833',  //参数
			'like',       //参数
			200,            //预期结果
			1			//预期结果
		);

		//异常参数，返回400
	$arrData[] = array(
			"发的发发",
	        "aaa",
			400,
			1
		);

		return $arrData;
	}

	/**
	 *
	 * @dataProvider data4TestCartListException
	 *
	 */
	public function testCartListException ($userid,$type,$expect1,$expect2) {
		global $objSnakeAccountloginEnvConf;
		global $objSnakeAccountloginV4Conf ;
		$arrCartListConf = $objSnakeAccountloginV4Conf->cart_list;
		
		$param = $arrCartListConf['args'];
		$param['userid'] = $userid;
       $param['type'] = $type;
		$ret = null;
		if ($arrCartListConf['isPost']) {
			$ret = Curl_class::curl_post($arrCartListConf['url'], $param, $arrCartListConf['host']);
		} else {
			$ret = Curl_class::curl_get($arrCartListConf['url'], $param, $arrCartListConf['host']);
		}

		//print_r($arrCartListConf);
	//	print_r($ret);

		//校验http_code
		$this->assertEquals($expect1, $ret['http_code']);
		$arrBody = json_decode($ret['body'], true);	
		//$this->assertEquals($expect2, $ret['http_code']);

		//判断data不为空
		//$this->assertNotEmpty($arrBody['data']);
		
		
		//校验返回结果内容,购物车里面只有1个商品
		//$this->assertEquals(1, count($arrBody['data']['info']));
		//校验code
	}

}


















/* vim: set ts=4 sw=4 sts=4 tw=100 */
?>
