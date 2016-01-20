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
			'company' => $input['name']
			);

		$body = $email->getBody('intro', $data);

		foreach($input['section'] as $key => $section)
		{
			if($section == 'true')
			{
				$body = $body.$email->getBody($key, $input['name']);
			}
		}

		$body = $body.$email->getBody('end', $data);

		$email->setBody($body);

		$email->setName($input['name']);

		$email->setReceiver($input['email']);

		$email->setSubject('Sponsorship Opportunity');

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

}
