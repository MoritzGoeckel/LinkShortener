#Link Shortener in PHP

This is a little link shortener webservice. It is possible to create an account by connecting it to facebook via the Facebook-API. A logged in user is able to manage her links. She can see the click statistics, edit and delete them. Also there is a API for the service.

![alt tag](https://github.com/MoritzGoeckel/PHP-Link-Shortener/blob/master/screenshot.PNG?raw=true)

##Is your service for free?
Yes.

##May I see the statistics of my link?
Yes. You have to be logged in. Then you can view your stats here.

##May I change the destination of my links later on?
Yes. But you have to be logged in. Then you can change your links here.

##Who are you?
Im a student from Germany.

##Why should I shorten links?
There are multiple reasons: It makes your link short. You can see how many people have clicked your link. You can change the destination of your link afterwards.
Where is the server of this website located?
In Germany, Frankfurt

##How long will my link be saved on this website?
Probably forever.

#API
You can use our API for verious actions:

##List links
http://minutus.de/api.php?auth=<your auth code>&action=list
Returns the list of all your links.

##Submit a new link
http://minutus.de/api.php?auth=<your auth code>&action=new&url=<encoded url>
Be aware that the url has to be encoded in order to survive this GET command.
Returns the id of the new link.

##Get stats
http://minutus.de/api.php?auth=<your auth code>&action=stats&id=<link id>
Returns the ammount of views.

##Update link
http://minutus.de/api.php?auth=<your auth code>&action=update&id=<link id>&url=<new url>
Returns whether the action was sucessful or not.

##Delete link
http://minutus.de/api.php?auth=<your auth code>&action=del&id=<link id>
Returns whether the action was sucessful or not.

For these actions you just have to call the urls with the belonging GET variables.