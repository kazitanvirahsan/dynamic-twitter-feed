Dynamic Twitter Feeds for Website  
=================================

Problem Statement
-----------------
Write a web application that dynamically feeds 10 Twitter Tweets that contains a particular keywrod (ex- "engineering").


list of technologies
--------------------
    AngualrJS 1.4.2
    PHP 5.4
    Memcached 1.4 (http://downloads.northscale.com/memcached-win64-1.4.4-14.zip)
    Composer (https://getcomposer.org/)
    Twitter Rest Api (https://dev.twitter.com/oauth/overview/single-user)
    oAuth 1.1 ( Using @abraham’s PHP twitteroauth Library)

Features
------------------
Seach tweets based on keywords
Set tweet count
Convert twitter hashtag, alias, and links into hyperlinks.
Stores Tweets in temporary cache

How to Run
------------------

1. Make you have up and running php 5.3+ in order to compatible with PSR4 namespace resolution.

2. Install and run Memcached server:
     Based on your operating system and file system download and install Memcached server from the following link:
        https://memcached.org/
     For windows operating system, download it from and follow the instruction to run.
        https://commaster.net/content/installing-memcached-windows
     
     In order to flush/clear it use telnet localhost 11211

3. Integrating Twitter Rest api to local server:

    In order to integrate with Twitter Rest api we need to authenticate first. We need to modify the follwing 
    parameters from api/config files.

    // Consumer Key
    define('CONSUMER_KEY', 'xxxx');
    define('CONSUMER_SECRET', 'xxxx');

    // User Access Token
    define('ACCESS_TOKEN', 'xxxx');
    define('ACCESS_SECRET', 'xxxx');

    Create a twitter account and create a single user application using oAuth from https://apps.twitter.com/ to generate consumer key , consumer secret , access token and access secret.

    It will also give us Callback URL http://127.0.0.1/twitter/index.php which enable us to access twitter rest api from local server.

    *** You must need a directory on web-root called twitter according to callback url setting. In summary,the call back url must align your local web directory.

    From your web browser http://localhost/twitter/ and if everything is okey you should see similar to following:


4. Composer Configuration:
    Twitter recommends any oAuth connection (https://dev.twitter.com/oauth/overview/single-user) to get tweets. in order to have secure connection this application has the following composer configuration up and running. so we don't need to do anything.
    {
    
    "require": 
    {
        "abraham/twitteroauth": "0.5.*"
    },
    "autoload": 
    {
        "psr-4": 
        {
            "Twitter\\":"src/"
        }
    }
}

Future Imporvements 
-------------------

1. Cache policy improvement:
      There is no gurantee that twitter rest api will return result set which may break our application. 
      In addition, no gurantee can be ensure from memcached server. As a result,we need to use alternative persistent cache like file cache to store our tweets to implement the fail over.

2. Cancel the ajax time interval from client side:
      When the angualrJS controller will be out of scope we need to cancel the interval to stop the ajax call. This cancellation will ensure we do not run asynchronous call to fetch tweets forever.
