<?php
namespace hackGFS\Services\Email\Classes;

use \Sentry;
use User;
use \Exception;

    /*
    |--------------------------------------------------------------------------
    | UtilityMailman - Sends out emails that are to our users
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

class UtilityMailman extends PostOffice {

    //A thanks for registering email that also sends out an activation link
    protected function thanks($user)
    {
        $link = "http://club.hackgfs.io/#/activate/$user->activation_code";

        $data = "Thank you for registering to be a part of the hackGFS club as well as the Sponsorship Competition! As you may know, we are giving away an <b>Xbox One</b> to the person who sends out the most emails. You are soooo close to entering the competion. The only thing standing in your way is account activation, which can be completed by clicking the link below! Good luck and let the games begin! <br><br>Activate Account: <a href='".$link."'>".$link."</a>";

        return $data;

    }

    //The email that sends when activation is completed
    protected function activated()
    {
        $link = "http://club.hackgfs.io/";

        $data = "Your account has been registered!!! Start sending emails now to get ahead, and win that <b>Xbox One</b><br><br>Start Sending: <a href='".$link."'>".$link."</a>";

        return $data;

    }

    
}
