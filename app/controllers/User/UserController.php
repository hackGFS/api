<?php

class UserController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| UtilityController - leaderboard
	|--------------------------------------------------------------------------
	|
	| Controller that handles utilities
	| 
	|
	|
	*/

	public function requestReset(){

		$email = Input::get('email');

		try {

			$user = User::where('email', '=', $email)->first();

			$user = Sentry::findUserById($user->id);

			$code = $user->getResetPasswordCode();

			$email = new UtilityMailman;

			$email->setReceiver($user->email);

			$email->setSubject('Password Reset');

			$body = $email->getBody('reset', $user);

			$email->setBody($body);

			$data = $email->send($user);
			
		} catch (Exception $e) {

			$data = Citrus::response('error', $e);
			
		}

		return $data;
	}

	public function resetPassword(){

		$input = Input::all();

		$user = User::where('email', '=', $input['email'])->first();

		$user = Sentry::findUserById($user->id);

		try {

			if ($user->checkResetPasswordCode($input['code'])){

		        if ($user->attemptResetPassword($input['code'], $input['password'])){

		            $data = Citrus::response('data', 1);

		           	$email = new UtilityMailman;

					$email->setReceiver($user->email);

					$email->setSubject('Successful Password Reset');

					$body = $email->getBody('sreset', $user);

					$email->setBody($body);

					$data = $email->send($user);
		        
		        }
		        else{

		            throw new Exception("Something is not right - please request another reset password link.");
		            
		        }
		    } else {

		    	throw new Exception("Your reset code has expired. Please request another one.");
		    	
		    }
			
		} catch (Exception $e) {

			$data = Citrus::response('error', $e);
			
		}


	    return $data;
	}

	public function detail($id){

		$user = User::find($id);

		try {

			if (!is_null($user)) {

				$user->count = $user->email()->count();

				$user->emails = $user->email()->get();

				$data = Citrus::response('data', $user);
				
			} else {

				throw new Exception('User not found');

			}
			
		} catch (Exception $e) {

			$data = Citrus::response('error', $e);
			
		}


		return $data;

	}


}
