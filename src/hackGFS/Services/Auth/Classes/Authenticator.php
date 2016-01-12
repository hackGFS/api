<?php
namespace hackGFS\Services\Auth\Classes;

use \Sentry;
use \Citrus;
use \Exception;

class Authenticator {

    public static function register($input)
    {
    	try {

			$user = Sentry::register($input);

			$user->getActivationCode();

			$data = Citrus::response('data', $user);

		} catch (Exception $e) {

			$data = Citrus::response('error', $e);

		}

		return $data;
    }

    public static function login($input)
    {
    	try {

    		$user = Sentry::authenticate($input);

    		$data = Citrus::response('data', $user);

    	} catch (Exception $e) {

    		$data = Citrus::response('error', $e);
    		
    	}

    	return $data;
    }

    public static function activate($user)
    {
    	try {

			$activated = $user->attemptActivation($user->activation_code);

			$data = Citrus::response('data', 1);

		} catch (Exception $e) {

			$data = Citrus::response('error', $e);

		}

		return $data;
    }
    
}
