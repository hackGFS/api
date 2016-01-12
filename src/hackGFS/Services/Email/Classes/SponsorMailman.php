<?php
namespace hackGFS\Services\Email\Classes;

use \Sentry;
use User;
use \Exception;

    /*
    |--------------------------------------------------------------------------
    | SponsorMailman - Sends out sponsorhsip emails
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

class SponsorMailman extends PostOffice {

    
    protected $name = null;

    //Set the name of the person receiving the email
    public function setName($name)
    {
        $this->name = $name;
    }

    protected function experimenting($name)
    {
        $section = "If you have never sponsored a hackathon before, we believe that hackGFS is a great place to start as it is an opportunity to show your everyday customers that you are progressive and care about the innovators of tomorrow. hackGFS may also offer the chance to enhance your brand as a whole.<br><br>";

        return $section;
    }

    protected function marketing($name)
    {
        $section = "Some students will be attending their first hackathon and they will be eager to meet and interact with $name. hackGFS offers a great opportunity to market  to a young audience. Handing out swag or goodies, such as laptop stickers, custom t-shirts and sunglasses is a great way to gain visibility with teenagers. Kids also have an influence on what their parents buy, so we encourage you to leave a lasting impression that may lead them to promote your product and not someone else’s.<br><br>";

        return $section;
    }

    protected function api($name)
    {
        $section = "By attending hackGFS, $name will have the opportunity to promote the use of its API platform and to build personal relationships with a new generation of hackers, while providing on site help and instruction, which we believe will be invaluable. You will be able to encourage the use of your API in the projects created at hackGFS and in turn, see new and creative ways it is put to use by inventive and talented young developers.<br><br>";

        return $section;
    }

    protected function vc($name)
    {
        $section = "hackGFS is a great place to raise awareness for $name. It is an opportunity for you to let young hackers know you are there should they want to start a business while your portfolio companies can grow their audience and introduce hackers to their products and services. What more could you ask for than a room full of motivated developers with potential million dollar ideas? It would be as if Christmas came early!<br><br>";

        return $section;
    }

    protected function charity($name)
    {
        $section = "Hackathons are changing the world by inspiring technological innovation in young people. As technology plays a more integral role in our world, it becomes more and more important for companies to keep up with this change. Participating at this early stage by encouraging innovation will help make $name a prominent catalyst in this technological advancement.<br><br>";

        return $section;
    }

    protected function exposure($name)
    {
        $section = "The brightest high school minds in computer science in the Greater Philadelphia area will be at hackGFS. If $name donates to, or better yet sends a representative to attend hackGFS, students will be familiar with and remember you when they are looking to use a certain service or product while developing their skills in the future. Because of this exposure, we believe that sponsoring hackGFS now may result in huge benefits for $name down the road.<br><br>";

        return $section;
    }

    protected function intro($data)
    {
        $user = $data['user'];

        $company = $data['company'];

        $section = "My name is $user->first_name $user->last_name, and I am in grade $user->grade at Germantown Friends School in Philadelphia, PA. My team and I are passionate about technology and the education that surrounds it, which is why we are hosting our school and city’s first high school hackathon, hackGFS. We would love for you to be a part of a groundbreaking experience by joining us as a sponsor, bringing mutual benefit to both hackGFS and $company.<br><br>A hackathon is an invention marathon, a twenty-four hour flurry full of creativity, teamwork and fun where all forms of technological innovation are welcome. Teams of up to four participants work together using technology to build an app or website that solves a problem. At the end of the event, each team presents their creation to an audience of their peers and a panel of judges. Those teams with the most creative ideas are then awarded prizes.<br><br>hackGFS will be hosted at Germantown Friends School on April 9-10, 2016. We expect to have roughly 200 high school hackers from in and around the Greater Philadelphia area. Because hackGFS will be Philadelphia’s first high school hackathon, we want to make it memorable for everyone who participates, and that is why we are asking you to help sponsor the event. All donations will be used to provide food, drink and prizes. In return, we encourage sponsors to interact and form relationships with some of the possible leaders and innovators of tomorrow from the Philadelphia area. As a sponsor, you have the chance and the opportunity to leave a lasting impression on hackGFS participants by introducing them to your brands and educating them on your products or services.<br><br>";

        return $section;
    }

    protected function end($data)
    {
        $user = $data['user'];

        $company = $data['company'];
        
        $section = "We started hackGFS to allow students who may feel boxed in by core curriculums to realize what they are capable of doing with technology. Who knows - this exposure might result in someone finding their passion, as we clearly have. If we ignite at least one spark, we will know that we have succeeded in our mission!<br><br>We have presented you with our vision, but we also realize that we cannot reach it without partnering with many others. We hope that we have ignited a desire in you to join us in this endeavor. Attached is a link to our sponsorship tiers so that you can see what is available. Please feel free to email us if you have any questions or would like to know more. If you are not the right person to contact about this matter, we would be grateful if you would forward it to the appropriate person. Thank you for your time.<br><br>";

        return $section;
    }

    
}
