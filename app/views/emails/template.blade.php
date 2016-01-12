<p>

@if(is_null($user))
Dear {{$name}}
@else
{{$user->first_name}}
@endif

, <br /><br />

{{$body}}

<br /><br /><br>
Sincerely, <br />
The hackGFS Team <br /><br>
Contact us: <a href="mailto:hackgfs.2015@gmail.com">hackgfs.2015@gmail.com</a><br><br>
Check us out: <a href="http://bit.ly/hackgfs">http://bit.ly/hackgfs</a> <br><br>
Register Now!!!: <a href="http://bit.ly/hackgfsregister">http://bit.ly/hackgfsregister</a>

</p>
