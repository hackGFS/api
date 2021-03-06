<?php

class AuthController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| AuthController - authentication, registration, activation
	|--------------------------------------------------------------------------
	|
	| The controller that handles all user authentication, registration and 
	| activation. 
	|
	|
	*/

	public function register()
	{
		$input = Input::all();

		$data = Authenticator::register($input);

		$parse = json_decode($data);

		if($parse->success == 'data')
		{

			$email = new UtilityMailman;

			$email->setReceiver($parse->data->email);

			$email->setSubject('Activate Your Account');

			$user = Sentry::findUserById($parse->data->id);

			$body = $email->getBody('thanks', $user);

			$email->setBody($body);

			$data = $email->send();

		}

		return $data;
	}

	public function activate($code)
	{
		$user = User::where('activation_code', '=', $code)->first();

		try {

			if(is_null($user))
			{
				throw new Exception("There is no user with that activation code");
				
			}

			$user = Sentry::findUserById($user->id);

			$data = Authenticator::activate($user);

			if ($user->activated) {

				$email = new UtilityMailman;

				$email->setReceiver($user->email);

				$email->setSubject('You are now Activated!');

				$body = $email->getBody('activated');

				$email->setBody($body);

				$data = $email->send($user);

			}
			
		} catch (Exception $e) {

			$data = Citrus::response('error', $e);
			
		}


		return $data;
	}

	public function login()
	{
		$input = Input::all();

		$data = Authenticator::login($input);

		return $data;
	}

	public function check()
	{

		if(Sentry::check())
		{

			$data = Citrus::response('data', 1);

		} else{

			$data = Citrus::response('data', 0);

		}

		return $data;

	}

	public function logout()
	{

		try {

			Sentry::logout();

			$data = Citrus::response('success', 1);
			
		} catch (Exception $e) {

			$data = Citrus::response('error', $e);
			
		}

		return $data;
	}

	public function subscribe(){

		$email = Input::get('email');

		$subscribe = new Subscribe;

		$subscribe->email = $email;

		try {

			$subscribe->save();

			$data = Citrus::response('data', 'You have been successfully subscribed');
			
		} catch (Exception $e) {

			//$e->setMessage('You are already subscribed!');

			$data = Citrus::response('error', $e);
			
		}

		return $data;

		

	}

}
