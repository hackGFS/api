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

    
    protected $school = null;

    protected $name = null;

    //Set the name of the company receiving the email
    public function setCompany($school)
    {
        $this->company = $school;
    }

    //Set the name of the PERSON receiving the email
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

        $school = $data['company'];

        $section = "My name is $user->first_name $user->last_name, and I am in grade $user->grade at Germantown Friends School (GFS). GFS is hosting Philadelphia’s first high school hackathon - hackGFS - and would love for your school’s students to participate! We’re a 12 hour hackathon on May 14th. Hackathons are invention marathons, a twelve hour flurry of creativity, teamwork and fun where all forms of technological innovation are welcome. Teams of up to four participants work together to build an app or website that solves a problem. At the end of the event, each team is able to present their creation to an audience of their peers as well as a panel of judges.<br><br>";

        return $section;
    }

    protected function end($data)
    {
        $user = $data['user'];

        $school = $data['company'];
        
        $section = "We hope that you will pass this information on to those who you think would be interested in attending. Anyone is able to come - we will be running workshops for beginners. The only thing that someone needs to participate is an open mind and a laptop! I've attached our formal information sheet, which has more detailed information. There are also some posters attached, which are meant to be printed and hung up around computer labs, if that is possible. 
            <br><br>
            Thanks for your time.";

        return $section;
    }

    
}
