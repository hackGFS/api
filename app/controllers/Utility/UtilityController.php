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

			array_multisort($data, SORT_DESC);

			//dd($data)

			$response = Citrus::response('data', $data);
			
		} catch (Exception $e) {

			$response = Citrus::response('error', $e);
			
		}

		return $response;
		
	}

}
