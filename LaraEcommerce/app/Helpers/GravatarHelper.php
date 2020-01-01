<?php
namespace App\Helpers;

/**
 * Gravatar Helper class
 * Check if this email has any gravatar  image or not
 * if it has any image then true otherwise false
 */
class GravatarHelper
{
	public static function validate_gravatar($email){

		// at first email ta k md5 korbo

		$hash = md5($email);
		$url = 'http://www.gravatar.com/avatar/' . $hash . '?d=404';
		$headers = @get_headers($url);

		if(!preg_match("|200|", $headers[0])){

			$has_valid_avatar = FALSE;
		}else{
			$has_valid_avatar = TRUE;
		}

		return $has_valid_avatar;

	}

	/*
 	$email = user email
 	$size = size of image
 	$d = type of image if not gravatar image
	$image_url =gravatar image url

	*/

	public static function gravatar_image($email,$size=0,$d=""){

	$hash = md5($email);
	$image_url = 'http://www.gravatar.com/avatar/' . $hash . '?s='.$size. '&d='.$d;
	return $image_url;

	}



}


