<?php

namespace app\cmwn\Services;

class ImageManagement
{
	private static function setKey(){
		\Cloudinary::config(array(
			"cloud_name" => "change-my-world-now",
			"api_key" => "125692255259728",
			"api_secret" => "xTgojKXezGKFAd6v2aGQ_7mvmdM"
		));
	}

	public static function uploader($file){
		self::setKey();
		return \Cloudinary\Uploader::upload($file);
	}

}
