<?php
namespace App\Helpers;

/**
 * ImageHelper
 */


use App\Models\User;

use App\Helpers\GravatarHelper;

class ImageHelper
{
	public static function getUserImage($id){

		$user = User::find($id);
		$avatar_url = "";

		if(!is_null($user)){

			if($user->avatar == NULL){
				/*jodi avatar field empty takhe tahole gravatar image ta return korbo. static function howai class ta avabe access korte partechi 
				 nahole object create kore access korte hoto */

				if(GravatarHelper::validate_gravatar($user->email)){

					$avatar_url = GravatarHelper::gravatar_image($user->email,100);

				}else{
					//jodi gravatar image na takhe

					$avatar_url = url('images/defaults/user.png');
				}


			}else{
				// r jodi empty na takhe tahole j image ta ache oita show korabo
				$avatar_url = url('images/users/' .$user->avatar);
			}

		}else{
			//return redirect('/');
		}

		return $avatar_url;
	}
}




