<?php
/***************************************************************************
 * 
 * Copyright (c) 2014 MeiLiShuo.com, Inc. All Rights Reserved
 * $Id$ 
 * 
 **************************************************************************/

/**
 * @file InitTestEnv.php
 * @author work(zhangyouchang@MeiLiShuo.com)
 * @date 2014/03/10 12:47:57
 * @version $Revision$ 
 * @brief 
 *  
 **/

require_once (dirname(__FILE__) . '/util/Init.php');
class InitSnakeCartTestEnv{

	/********************************************************/
	/*	环境配置信息										*/
	/********************************************************/

	public $arrOdpEnv = array(
		array(
			'ip' => '10.6.4.82',
			'port' => 80,
			'host' => 'doota.youchangzhang.qalab.meilishuo.com',
/*			
			'mysql' => array(
				'dolphin' => array(
					'ip'		=> '192.168.128.18',
					'port'		=> 3306,
					'database'	=> 'dolphin',
					'username'	=> 'dolphin',
					'password'	=> 'dolphin'
				),
				'shark' => array(
					'ip'		=> '192.168.128.18',
					'port'		=> 3306,
					'database'	=> 'dolphin',
					'username'	=> 'dolphin',
					'password'	=> 'dolphin'
				),
			), 
			'redis' => array(
				'writeHost' => 'http://192.168.128.12/write',
				'xwriteHost' => 'http://192.168.128.12/xwrite',
				'readHosts' => array(
					'http://192.168.128.12:8080/read',
				)	
			),
			'memcache' => array(
				'unixsock' => array(
					array('host' => '192.168.128.13', 'port' => 11211),
				)
			),
*/			
		),
	);

	/********************************************************/
	/*	账号配置信息				*/
	/********************************************************/
	public $arrDefaultUser = array(
		'username' => 'g_developer',
		'uid' => 210937065,
		'cookie' => '2e0792efb44e77b64a47d78ac96a2abe',
		'access_token' => '40e9e3d129808d758a83fc19113fd51e',
		'addr_id' => 57813836,
	);

	public $arrConf = array();

	/**
	 *  函数名: __construct 
	 *  描述：  构造函数，用来初始化odp环境、
	 *  参数：  无
	 *
	 **/
	public function __construct($index = 0){

		$arrInfo = $this->arrOdpEnv[$index];

		// 数据库初始化
		if (!empty($arrInfo['mysql'])) {
			foreach ($arrInfo['mysql'] as $index => $conf) {
				$this->objDB[$index] = new Bd_DB();
				$this->objDB[$index]->connect(
					$conf['ip'], 
					$conf['username'], 
					$conf['password'], 
					$conf['database'], 
					$conf['port']
				);
			}
		} else {
			$this->objDB = null;
		}
		$this->objReq = new Request();
		$arrInfo['objDB'] = $this->objDB;
		$arrInfo['arrDefaultUserInfo'] = $this->arrDefaultUser;
		$arrInfo['objRequest'] = $this->objReq;
		$this->arrConf = $arrInfo;
	}
}


require_once dirname(__FILE__) . '/conf/SnakeCartV4.conf.php';
//require_once dirname(__FILE__) . '/conf/SnakeAccountloginV4.conf.php';
$objSnakeCartEnvConf = new InitSnakeCartTestEnv();
$objSnakeCartV4Conf = new SnakeCartV4Conf($objSnakeCartEnvConf->arrConf);


/* vim: set ts=4 sw=4 sts=4 tw=100 */
?>
