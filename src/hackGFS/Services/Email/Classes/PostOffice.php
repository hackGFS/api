<?php
namespace hackGFS\Services\Email\Classes;

use \Sentry;
use \Citrus;
use \Exception;
use \Mail;
use \Email;

	/*
	|--------------------------------------------------------------------------
	| PostOffice - All our mail comes through the PostOffice, pun intended
	|--------------------------------------------------------------------------
	|
	| This is really a builder, but I like the idea of having a post office and a mail man
	| Basically, the highest level of our custom email. Creates an instance of the object,
	| that will then be manipulated by the subclasses UtilityMailman and SponsorMailman.
	| However, PostOffice can also send off basic emails on its own as well.
	|
	| The properties are pretty self-explanatory.
	|
	*/

class PostOffice {

	private $from = 'hackgfs.2015@gmail.com';

	protected $to = null;

	protected $subject = null;

	protected $body = null;


    public function setReceiver($to)
    {
    	$this->to = $to;
    }

    public function setSubject($subject)
    {
    	$subject = 'hackGFS - '.$subject;

    	$this->subject = $subject;
    }

    public function setBody($body)
    {
    	$this->body = $body;
    }

    //Determine which body to use
    public function getBody($name, $data = null)
    {
        $body = $this->$name($data);

        return $body;
    }

    public function send()
    {

        //$data = $this->sendMail();

    	try {
    		
    		$data = $this->sendMail();

    	} catch (Exception $e) {
    		
    		$data = Citrus::response('error', $e);

    	}

    	return $data;
    
    }

    private function sendMail()
    {
        $user = Sentry::getUser();

    	if(is_null($this->to))
    	{
            throw new Exception("Please set a valid receiving email address for the email");
    		
    	}

    	if(is_null($this->subject))
    	{
    		throw new Exception("Please set a valid subject for the email");
    		
    	}

    	if (is_null($this->body)) 
        {
    		throw new Exception("Please have valid content for the email. You cannot send an empty email");	
    	}

        if (!is_null(Email::where('to', '=', $this->to)->first()))
        {
            throw new Exception("This email has already received a sponsorhip email");
            
        } else {

            $email = new Email;

            $email->to = $this->to;

            $email->from = $this->from;

            $email->subject = $this->subject;

            $email->company = $this->company;

            if(isset($this->name))
            {
                
                $email->name = $this->name;

            }

            $email->body = $this->body;

            $email->user_id = $user->id;

        }

    	$data = array(
    		'from' => $this->from,
    		'to' => $this->to,
    		'subject' => $this->subject,
    		'body' => $this->body,
    		'user' => $user,
    	);

    	if(isset($this->company))
    	{
            if(isset($this->name))
            {
                $data['name'] = $this->name;
            } else {

                $data['name'] = $this->company;

            }

            $data['user'] = null;
    	
        }

    	Mail::send('emails.template', $data, function($message) use ($data)
		{
			$message
				->to($data['to'])
				->subject($data['subject'])
				->from($data['from'], 'The hackGFS Community');
		});

        if(isset($email))
        {
            $email->save();
        }

		$data = Citrus::response('data', 1);

    	return $data;
    }
    
}
