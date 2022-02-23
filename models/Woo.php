<?php
namespace app\models;

use Yii;
use Automattic\WooCommerce\Client;

/**
 * woocommerce model
 */
 
class Woo
{
   
    /**
     * @inheritdoc
     */
    
	// Conexión WooCommerce API destino
	// ================================
	public static function init(){
		$url_API_woo = Yii::$app->params['urlServeWoo'].'/';
		$ck_API_woo = 'ck_7afdde12110919e20e0d0062ca83379cb4977c23';
		$cs_API_woo = 'cs_ee49e7cf551e219cc5215eec566ebc7ddd566f96';
	
		$woocommerce = new Client(
			$url_API_woo,
			$ck_API_woo,
			$cs_API_woo,
			[
				'wp_api' => true,
				'version' => 'wc/v3',
				'verify_ssl' => false,
			]
		);
		return $woocommerce;
	}
}