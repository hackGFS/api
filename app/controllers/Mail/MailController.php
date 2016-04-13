<?php

class MailController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| MailController - handles sending of emails for sponsors and judges
	|--------------------------------------------------------------------------
	|
	| 
	| 
	|
	|
	*/

	public function sponsor()
	{

		$input = Input::all();

		$email = new SponsorMailman;

		$user = Sentry::getUser();

		$data = array(
			'user' => $user,
			'company' => $input['company']
			);

		if(isset($input['name']))
		{
			if(!is_null($input['name']))
			{
				$email->setName($input['name']);
			}	
		}

		$body = $email->getBody('intro', $data);

		foreach($input['section'] as $key => $section)
		{
			if($section == 'true')
			{
				$body = $body.$email->getBody($key, $input['company']);
			}
		}

		$body = $body.$email->getBody('end', $data);

		$email->setBody($body);

		$email->setCompany($input['company']);

		$email->setReceiver($input['email']);

		$email->setSubject('Participants Needed');

		$data = $email->send();

		return $data;

	}

	public function all()
	{
		try {

			$emails = Email::all()->reverse();

			foreach ($emails as $email) {
				
				$user = Sentry::findUserById($email->user_id);

				$email->user = $user;

			}

			$data = Citrus::response('data', $emails);
			
		} catch (Exception $e) {

			$data = Citrus::response('error', $e);
			
		}

		return $data;

	}

	public function section()
	{
		$input = Input::all();

		$email = new SponsorMailman;

		try {

			$body = $email->getBody($input['section'], $input['name']);

			$data = Citrus::response('data', $body);			

		} catch (Exception $e) {

			$data = Citrus::response('error', $e);
			
		}

		return $data;
	}

	public function delete($id){

		$user = Sentry::getUser();

		try {

			if($user->id != 1 and $user->id != 12){

				throw new Exception("You do not have the permission to perform this action");

			}

			$email = Email::find($id);

			$email->delete();

			$data = Citrus::response('data', 'Email successfully deleted');
			
		} catch (Exception $e) {

			$data = Citrus::response('error', $e);
			
		}

		return $data;

	}

	public function search(){

		$q = Input::get('q');

		try {

			$emails = Email::where('company', 'like', "%$q%")->get();

			foreach ($emails as $email) {
				
				$user = Sentry::findUserById($email->user_id);

				$email->user = $user;

			}

			$data = Citrus::response('data', $emails);
			
		} catch (Exception $e) {

			$data = Citrus::response('error', $e);
			
		}


		return $data;

	}

	public function detail($id)
	{

		try {

			$email = Email::find($id);

			if(is_null($email)){

				throw new Exception("This email could not be found.");

			}

			$data = Citrus::response('data', $email);
			
		} catch (Exception $e) {

			$data = Citrus::response('error', $e);
			
		}

		return $data;

	}

}
