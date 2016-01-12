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

}
