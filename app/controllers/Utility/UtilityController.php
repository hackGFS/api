<?php

class UtilityController extends BaseController {

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

	public function leaderboard()
	{
		$users = User::all();

		$data = array();

		try {

			/*foreach ($users as $user) {
				$data[$user->id] = $user->email()->count();
			}
			ksort($data);

			//dd($user->email()->count());

			$counter = 1;*/

			foreach ($users as $user) {


				$emails = $user->email()->count();

				$data[$user->id] = array(
					'emails' => $emails,
					'user' => Sentry::findUserById($user->id),
					);

			}

			//Unset Noah
			unset($data[1]);

			//Unset James
			unset($data[12]);

			array_multisort($data, SORT_DESC);

			$response = Citrus::response('data', $data);
			
		} catch (Exception $e) {

			$response = Citrus::response('error', $e);
			
		}

		return $response;
		
	}

	public function alert()
	{

		$email = new UtilityMailman;

		$email->setSubject("We're Back - Compete for a free Xbox One");

		$link = "http://club.hackgfs.io/";

		$body = "hackGFS is back and better than ever! Instead of giving away an iPad, we are now offering an <b>Xbox One</b> to whoever sends the most sponsorship emails, according to the leaderboard on our site! Since you had an original account with us, we are letting you know about the competition reopening a week before the rest of the GFS community! <br><br>If you are not interested in the Xbox One, don't fret. Although we are not able to give away <b>$400</b> in cash, we can award you a device of your choice that is of equal or lesser value!<br><br>Check us out at <a href='".$link."'>".$link."</a>";

		$email->setBody($body);

		$users = User::all();

		foreach($users as $user)
		{
			$email->setReceiver($user->email);
			$email->send($user);
		}

	}

}
